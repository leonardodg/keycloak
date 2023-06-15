#!/bin/bash
#
# sdebug.sh - Fazer Instalação do modulo xdebug no container php:8.2-apache nano apache_web
#
# Autor: Leonardo Della Giustina <leonardo.giustina@qisat.com.br>
#
# ---------------------------------------------------------------
# Este Script recebe como paramentro variavel DEBUG 
# 
#  Parametros:
#       - DEDUG
#           > Valores: 0 = False OR 1 = True
#
#  Resultado:
#       - Modulo xdebug habilidate para utilizar no PHP
#       - Arquivos de configurações
#            - php.ini 
#            - xdebug.ini
#
# Licença: MIT
# ---------------------------------------------------------------
echo " > START SCRIPT XDEBUG - ENV DEBUG: $DEBUG"

# CHECK ENV FOLDER DEBUG
if [ ! -n "$DEBUG" ] ; then
    # exit 0 - STOP SCRIPT 
    >&2 echo '[x] ERROR: Config environment $DEBUG in File .env'
    exit 0
elif test "$DEBUG" = 1; then
    echo "[i] RUN SCRIPT ENABLE!"
else
    echo '[x] ERROR: Value environment $DEBUG incorrect!'
    exit 0
fi

apt-get update -y
cd /tmp 
curl -O https://xdebug.org/files/xdebug-3.2.1.tgz
tar -xzf xdebug-3.2.1.tgz
cd xdebug-3.2.1
phpize 
./configure --enable-xdebug 
make && make install
apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*