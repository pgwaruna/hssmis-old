FROM httpd:2.4.33-alpine
RUN echo "LoadModule rewrite_module modules/mod_rewrite.so" \
    >> /usr/local/apache2/conf/httpd.conf
RUN echo "LoadModule proxy_module modules/mod_proxy.so" \
    >> /usr/local/apache2/conf/httpd.conf
RUN echo "LoadModule proxy_http_module modules/mod_proxy_http.so" \
    >> /usr/local/apache2/conf/httpd.conf
RUN echo "LoadModule socache_shmcb_module modules/mod_socache_shmcb.so" \
    >> /usr/local/apache2/conf/httpd.conf
RUN echo "LoadModule ssl_module modules/mod_ssl.so" \
    >> /usr/local/apache2/conf/httpd.conf
RUN echo "Include /usr/local/apache2/conf/apache.conf" \
    >> /usr/local/apache2/conf/httpd.conf

