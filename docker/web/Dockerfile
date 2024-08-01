FROM nginx:stable-alpine as web

COPY docker/web/default.conf /etc/nginx/conf.d/

CMD ["nginx", "-g", "daemon off;"]

FROM web as local
RUN sed -i 's/fastcgi_pass localhost/fastcgi_pass emms/g' /etc/nginx/conf.d/default.conf

FROM web as nonlocal
