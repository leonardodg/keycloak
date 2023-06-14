FROM node:alpine AS build-stage
WORKDIR /app
COPY ./frontend /app
RUN npm install && npm run build

FROM nginx:stable-alpine
RUN apk add bash
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/nginx/conf.d/ /etc/nginx/conf.d/
COPY ./docker/ssl/ /etc/ssl/

# Install NODE e NPM in NGINX
COPY --from=build-stage /usr/lib /usr/lib
COPY --from=build-stage /usr/local/lib /usr/local/lib
COPY --from=build-stage /usr/local/include /usr/local/include
COPY --from=build-stage /usr/local/bin /usr/local/bin

COPY --from=build-stage /app/node_modules /usr/share/nginx/html/node_modules
COPY --from=build-stage /app/dist /usr/share/nginx/html/dist

WORKDIR /usr/share/nginx/html