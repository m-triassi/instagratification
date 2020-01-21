FROM nginx:1.10

# Move VHOST Configuration into image
ADD ./vm/web/nginx.vhost.conf /etc/nginx/conf.d/default.conf

# Load web server application here
WORKDIR /var/www