FROM ubuntu:22.04

ARG DEBIAN_FRONTEND=noninteractive

# Atualizando servidor
RUN apt-get update

# Adicionando repositórios necessários
RUN apt-get install -y software-properties-common
RUN apt-get install -y locales && rm -rf /var/lib/apt/lists/* \
    && localedef -i en_US -c -f UTF-8 -A /usr/share/locale/locale.alias en_US.UTF-8
RUN add-apt-repository -y ppa:ondrej/php
RUN apt-get install nano

# Atualizando servidor
RUN apt-get update

# Instalando apache
RUN apt-get install -y apache2

# Instalando Brotli
RUN apt-get install -y brotli

# Instalando PHP
RUN apt-get install -y php8.1 php8.1-common php8.1-dev libapache2-mod-php8.1 php8.1-sqlite3 php8.1-pgsql php8.1-mysql php8.1-redis php8.1-mongodb php8.1-gd php8.1-mbstring php8.1-curl php8.1-soap php8.1-zip php8.1-fpm php8.1-bcmath php8.1-xml php8.1-intl php8.1-ldap php8.1-xmlrpc
RUN apt-get install -y libapache2-mod-log-sql-mysql
RUN apt-get install -y php-pear php-php-gettext libpq-dev unzip
RUN apt-get install -y php8.1-dev
RUN update-alternatives --set php /usr/bin/php8.1

# Instalando o Composer"
RUN curl -sS https://getcomposer.org/installer | php

RUN chmod +x composer.phar
RUN mv composer.phar /usr/local/bin/composer

# Instalando npm
RUN curl -sL https://deb.nodesource.com/setup_16.x -o nodesource_setup.sh
RUN bash nodesource_setup.sh
RUN apt install -y nodejs

# Configuração do apache
# Habilitando mods do Apache2
RUN a2enmod rewrite
# Extensão apache
RUN phpenmod mbstring
# Permissão
RUN chmod -R 757 /var/www/html/
# Config Variaveis apache
ADD ./.gitlab/apache/php.ini /etc/php/8.1/apache2/php.ini
# Config Variaveis php cli
ADD ./.gitlab/php/php.ini /etc/php/8.1/cli/php.ini

# Virtual Host
ADD ./.gitlab/apache/000-default.conf /etc/apache2/sites-available/wendelulhoa.conf
RUN a2ensite wendelulhoa.conf
RUN a2dissite 000-default.conf

RUN echo "ServerName wendelulhoa" >> /etc/apache2/apache2.conf

ENV LANG en_US.utf8
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid

RUN service apache2 restart

RUN mkdir /var/www/html/wendelulhoa
WORKDIR /var/www/html/wendelulhoa
COPY . /var/www/html/wendelulhoa

EXPOSE 80
CMD /usr/sbin/apache2ctl -D FOREGROUND
