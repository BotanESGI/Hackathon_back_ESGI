#!/bin/sh

# Générer les clés si elles n'existent pas
# Définir la paraphrase (remplace-la par ta propre paraphrase si nécessaire)
JWT_PASSPHRASE="16a1417682d1ad62b39f5e48c81dc665a94c3f43031fd8fd8c6d45f5a6078332"

# Vérifier si les fichiers de clés existent, sinon les générer
if [ ! -f config/jwt/private.pem ]; then
  mkdir -p config/jwt
  openssl genrsa -out config/jwt/private.pem -aes256 -passout pass:$JWT_PASSPHRASE 4096
  openssl rsa -pubout -in config/jwt/private.pem -passin pass:$JWT_PASSPHRASE -out config/jwt/public.pem
fi

# Continue with Symfony build
composer install --no-interaction --optimize-autoloader
php bin/console cache:clear

# Wait for database to be ready
echo "Database is ready"

# Create database and run migrations
php bin/console doctrine:database:create --if-not-exists
echo "Database created"

php bin/console doctrine:migrations:migrate --no-interaction
echo "Migrations done"

# Load fixtures
php bin/console doctrine:fixtures:load --no-interaction
echo "Fixtures loaded"

# Start PHP server with explicit binding
php -S 0.0.0.0:8000 -t public &
SERVER_PID=$!

# Keep the container running
wait $SERVER_PID
