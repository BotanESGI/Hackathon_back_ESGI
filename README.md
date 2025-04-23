1. Lancer `docker compose build --no-cache` pour construire le docker
2. Lancer `docker compose up --pull always -d --wait` pour lancer le docker
3. Lancer `composer install` pour installer composer
4. Lancer `docker-compose exec php php bin/console doctrine:migrations:migrate` pour créer les tables dans la bdd
5. Lancer `docker-compose exec php php bin/console doctrine:fixtures:load` pour lancer les fixtures
6. Lancer `http://localhost:8000/`
