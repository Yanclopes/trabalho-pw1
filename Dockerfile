FROM php:8.2-apache
LABEL authors="Yan"

# Instalação de dependências
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    libicu-dev \
    g++ \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Instalação do Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Habilitar mod_rewrite do Apache
RUN a2enmod rewrite

# Definir o diretório do documento do Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copiar o código-fonte para o diretório do container
COPY . ${APACHE_DOCUMENT_ROOT}

# Instalação de dependências PHP via Composer
RUN composer install

# Iniciar o Apache
CMD ["/usr/sbin/apache2ctl", "-DFOREGROUND"]