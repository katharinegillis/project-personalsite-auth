FROM nginxinc/nginx-unprivileged:1.21

COPY .docker/templates /etc/nginx/templates

COPY public /var/www/html/public