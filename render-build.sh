#!/bin/sh

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