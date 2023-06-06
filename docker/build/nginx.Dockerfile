FROM nginx:stable-alpine
RUN apk add bash npm
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/nginx/conf.d/ /etc/nginx/conf.d/
COPY ./frontend/ /usr/share/nginx/html/

WORKDIR /usr/share/nginx/html

RUN npm install && npm run build