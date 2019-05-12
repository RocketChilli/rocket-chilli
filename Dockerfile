FROM httpd:2.4-alpine

RUN apk add --update nodejs-npm

WORKDIR /opt/app
RUN mkdir ./public && \
    rm -rf /usr/local/apache2/htdocs && \
    ln -sf /opt/app/public /usr/local/apache2/htdocs

COPY web/package*.json ./
RUN npm install --prod

COPY web/ ../app/
RUN npm run build
