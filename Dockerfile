FROM php:7.4-cli

# Installer les dépendances nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Copier le code source dans le conteneur
COPY . /app

# Définir le répertoire de travail
WORKDIR /app

# Vérifier la syntaxe des fichiers PHP
CMD ["php", "-l", "**/*.php"]
