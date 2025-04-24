FROM chialab/php-dev:8.3-fpm-alpine

# Installer Symfony CLI et Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN apk update && apk add bash wget

# Installer Symfony CLI
RUN wget https://get.symfony.com/cli/installer -O - | bash && \
    mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# Set working directory
WORKDIR /app

# Copier le contenu de l'application, y compris le répertoire public
COPY . .

# Copier le script d'initialisation
COPY render-build.sh /usr/local/bin/render-build.sh
RUN chmod +x /usr/local/bin/render-build.sh

# Exposer le port
EXPOSE 8000

# Exécuter composer install
RUN composer install --no-scripts

# Commande pour démarrer le serveur Symfony
CMD ["/usr/local/bin/render-build.sh"]