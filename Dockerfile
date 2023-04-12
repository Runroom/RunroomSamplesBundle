FROM php:8.2-cli-alpine

ARG UID=1000
ARG GID=1000

# Configure non-root user and group
RUN addgroup -g $GID appgroup
RUN adduser -u $UID -G appgroup -s /bin/sh -D appuser

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instala las dependencias necesarias
RUN apk add --no-cache libpng-dev libjpeg-turbo-dev freetype-dev libzip-dev icu-dev

ENV PATH="/usr/app/vendor/bin:/usr/app/bin:${PATH}"

# Habilita las extensiones
RUN docker-php-ext-install gd zip intl opcache

USER appuser

# Define el directorio de trabajo
WORKDIR /usr/app

# Define el comando de inicio para mantener el contenedor en ejecución
CMD ["tail", "-f", "/dev/null"]
