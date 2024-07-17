FROM php:7-alpine

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY . /var/www

WORKDIR /var/www

EXPOSE 8080

CMD [ "php","-S","0.0.0.0:8080","index.php" ]

