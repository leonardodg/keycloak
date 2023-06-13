# Project Example - Keycloak in PHP
Repositório do código Frontend em Javascript e Backend em PHP com um exemplo de projeto utilizando o sistema Keycloak.


## 📋 Pré-requisitos
Para a execução do projeto é necessário a plataforma de virtualização Docker e o sistema de controle de versão. verificaque se tem o Git e o Docker instalados e configurados em sua máquina ambiente de desenvolvimento. 

- Documentação da Ferramenta do [Docker](https://docs.docker.com/)
- Documentação da Ferramenta do [Git](https://git-scm.com/doc)


## 🚀 Começando

1 - Para obter o projeto de ser feito o clone do repositório.

obs.: chave ssh do git deve ser configurada.

```
git clone git@github.com:leonardodg/keycloak.git
```

2 - Acesse a pasta do projeto via terminal
3 - Alterar branch do projeto para develop

```
git checkout develop
```

## 🔧 Run Projeto

Certifique-se que suas ferramentas de desenvolvimento estão instaladas, configuradas e executando sem problemas em seu ambiente de desenvolvimento.

- **Check GIT**
```
git --version
```

- **Check Docker**
```
docker version
```

- **Build Docker**
Entrar na pasta do projeto pelo terminal e executar o comando:
```
docker-compose up -d --build
```

Entrar no container do Projeto
```
docker exec -it CONTAINER_NAME bash
```

- **PHP Code Sniffer** 
Utilizar a biblioteca php_codesniffer para corrigir codigo automático em ambiente DEV - Deixar no padrão PSR-12
```
vendor/bin/phpcbf --standard=psr12 index.php
```

Utilizar a biblioteca php_codesniffer em ambiente DEV - Retorna um Relatórios das correção fora do padrão PSR-12
```
vendor/bin/phpcs --standard=psr12 index.php
```


### LINK IN CONTAINERS
Container backend faz requisição HTTP CLIENT para o container SERVER keycloak WEB, por isso precisa ser configurado o IP no host na máquina backend server apache.

**Run commandos após containers rodando:**

```
echo $(docker inspect -f '{{range.NetworkSettings.Networks}}{{.IPAddress}}{{end}}' keycloak_web) app.keycloak.com >> docker/apache/ips-copy-hosts
docker cp docker/apache/ips-copy-hosts apache_web:/etc/ips-copy-hosts
docker exec apache_web bash -c "cat /etc/ips-copy-hosts >> /etc/hosts"
```



## ✒️ Autor
* [**Leonardo Della Giustina**](https://github.com/leonardodg)
