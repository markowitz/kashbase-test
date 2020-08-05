FROM creativitykills/nginx-php-server:latest
MAINTAINER Neo Ighodaro <neo@hotels.ng>
ADD custom_start.sh /custom_start.sh
RUN chmod 755 /custom_start.sh
ENV TZ=Africa/Lagos
CMD ["/custom_start.sh"]