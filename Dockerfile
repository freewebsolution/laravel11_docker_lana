FROM php:8.3 as php

# Aggiorniamo il gestore pacchetti e installiamo le dipendenze necessarie
RUN apt-get update -y && \
    apt-get install -y \
        unzip \
        libpq-dev \
        libcurl4-gnutls-dev && \
    docker-php-ext-install pdo pdo_mysql bcmath && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    # Puliamo la cache di apt per ridurre la dimensione dell'immagine
    rm -rf /var/lib/apt/lists/*

# Impostiamo la directory di lavoro
WORKDIR /var/www

# Copia i file di configurazione e il codice sorgente
COPY . .

# Installa Composer dal container ufficiale di Composer
COPY --from=composer:2.7.6 /usr/bin/composer /usr/bin/composer

# Comando per avviare il server PHP
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]

# Esporre la porta per il server PHP
EXPOSE 8000
