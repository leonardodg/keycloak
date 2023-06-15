#!/bin/bash
echo "|> RUN SCRIPT INSTALL XDEBUG <|"
/xdebug.sh
echo "|> RUN SCRIPT BUILD ENTRYPOINT CONTAINER APACHE <|"
/usr/local/bin/docker-php-entrypoint
echo "|> RESTART APACHE <|"
apache2-foreground