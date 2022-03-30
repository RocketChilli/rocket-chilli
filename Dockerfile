FROM httpd:2.4-alpine

RUN apk add --update nodejs npm

# Create symlink for public server root
WORKDIR /opt/app
RUN mkdir ./public && \
    rm -rf /usr/local/apache2/htdocs && \
    ln -sf /opt/app/public /usr/local/apache2/htdocs

# Install Node modules
COPY web/package*.json ./
RUN npm install --prod

# Copy source and build assets
COPY web/ ../app/
RUN npm run build

# Configure Apache server
RUN echo 'IncludeOptional conf/conf.d/*.conf' >> /usr/local/apache2/conf/httpd.conf
COPY config/httpd.conf /usr/local/apache2/conf/conf.d/custom.conf
