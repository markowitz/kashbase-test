FROM ceetny/ubuntu-php-nginx:latest
MAINTAINER Friday Godswill <friday@hotels.ng>
RUN apt-get -y update && apt-get -y upgrade
ADD custom_start.sh /custom_start.sh
RUN chmod 755 /custom_start.sh
ENV TZ=Africa/Lagos
CMD ["/custom_start.sh"]
