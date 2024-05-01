FROM nginx:stable-alpine

COPY ./infrastructure/docker/nginx/config/vhost.conf /etc/nginx/conf.d/default.conf
COPY ./public /app/public

EXPOSE 8080