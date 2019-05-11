FROM httpd:2.4-alpine

RUN apk add --update nodejs-npm

WORKDIR /usr/local/apache2/htdocs
COPY package*.json ./
RUN npm install --prod && npm run build

COPY * ./
