#!/bin/bash

# Verifica se le dipendenze di Composer sono già installate
if [ ! -f "vendor/autoload.php" ]; then
    echo "Installing Composer dependencies..."
    composer install --no-progress --no-interaction
fi

# Verifica se il file .env esiste, altrimenti crea un nuovo file .env
if [ ! -f ".env" ]; then
    if [ -z "$APP_ENV" ]; then
        echo "APP_ENV not set, setting to default 'local'"
        APP_ENV=local
    fi
    echo "Creating .env file for environment $APP_ENV"
    cp .env.example .env
else
    echo ".env file already exists"
fi

# Assicurati che i permessi siano corretti su storage e cache
echo "Setting permissions for storage and cache directories..."
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Esegui le migrazioni (assicurati che la chiave sia generata prima)
php artisan key:generate

# Esegui le migrazioni
php artisan migrate --force

# Pulizia della cache e delle configurazioni
php artisan config:clear
php artisan route:clear
php artisan cache:clear

# Avvia il server Laravel (assicurati che la porta sia configurata correttamente)
echo "Starting Laravel server on port $PORT..."
php artisan serve --host=0.0.0.0 --port=$PORT
