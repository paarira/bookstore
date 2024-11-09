FROM mysql:8

ADD docker/mysql/init/01.sql /docker-entrypoint-initdb.d/01.sql

RUN chmod -R 777 /docker-entrypoint-initdb.d