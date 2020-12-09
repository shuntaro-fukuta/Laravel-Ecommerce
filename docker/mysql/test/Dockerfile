FROM mysql:8.0

ENV MYSQL_DATABASE=laravel_ecommerce_test \
    MYSQL_USER=laravel_ecommerce \
    MYSQL_PASSWORD=password \
    MYSQL_ROOT_PASSWORD=root \
    TZ=Aziz/Tokyo

COPY ./my.cnf /etc/mysql/conf.d/my.cnf
RUN chmod 644 /etc/mysql/conf.d/my.cnf
