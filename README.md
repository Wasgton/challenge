#API Pharma Manger Client
Api busca ajudar na administração, da base de clientes da empresa, a mesma tem como objetivo alimentar, alterar, listar y eliminar los usuários presentes na base de clientes da empresa

## Pré-requisito.

* Docker e Docker-compose
    Download e instalação  [https://docs.docker.com/engine/install/](https://docs.docker.com/engine/install/)

## Instalação da API no Linux - Makefile
1. Clonar o repositório :

    `git clone git@lab.coodesh.com:challenges/backend/challenge-20201209.git lastlink/`

2. Ingressar no diretório 

    `
        cd lastlink/
    `

3. criar e iniciar as imagens do Docker

    `
        make build-docker
    `

4. Configuração da aplicação, atualização do Composer, criação das tabelas do banco de dado, y configuração da cron do sistema 

    `
        make build-app
    `


## Instalação da API pelo Docker
1. Clonar o repositório :

    `
        git clone git@lab.coodesh.com:challenges/backend/challenge-20201209.git lastlink/
    `

2. Ingressar no diretório 

    `
        cd lastlink/
    `

3. criar e iniciar as imagens do Docker

    `
        docker-compose build 
        docker-compose up -d
    `

4. Mover o arquivo de configurações : 

    `
        docker exec -i -t laravel-app /bin/mv /var/www/html/config-app/.env-config /var/www/html/.env
    `

5. Instalando e atualizando as dependências do framework

    `
        docker exec -i -t laravel-app /usr/local/bin/php /usr/bin/composer install
        docker exec -i -t laravel-app /usr/local/bin/php /usr/bin/composer update
    `

6. Criando as tabelas do banco de dados da API : 

    `
        docker exec -i -t laravel-app /usr/local/bin/php /var/www/html/artisan migrate.env
    `

7. Configurando a CRON e correção de permissões dos diretórios do framework 

    `
        docker exec -i -t laravel-app /var/www/html/config-app/cron-laravel
    `

## Criando o token de acesso da API - Makefile 
### Comando 

`
make api-token username=lastlink
`

### output

`
User : lastlink
`

`
Token : yQgYcNOysX87HX8KuK4Dy8Yiyk3pcEfEC5Wud3Baf9Kdu5q6AeaYL4on2VKm
`

## Criando o token de acesso da API - Comando Docker 

### Comando 

`
docker exec -i -t laravel-app  /usr/local/bin/php /var/www/html/artisan CreateTokenApi lastlink
`

### output

`
User : lastlink
`

`
Token : Fi6AxPZxDpfgpYkeOTAu65IzC9e9QRYuQvQiDpNL8nCjEo3lpg5TeWcfbmas
`

## Utilizando a API 

### Importação manual dos usuários -  Makefile

`
make users-imports  url='https://randomuser.me/api/?results=' num=5
`

### Importação manual dos usuários -  Comando Docker

`
docker exec -i -t laravel-app  /usr/local/bin/php /var/www/html/artisan importuserdata:cron 'https://randomuser.me/api/?results=' 5
`

### Consultando todos os usuários importados

`
curl --location --request GET 'http://localhost:9595/api/users/' --header 'token-access: yQgYcNOysX87HX8KuK4Dy8Yiyk3pcEfEC5Wud3Baf9Kdu5q6AeaYL4on2VKm'
    `

### Consultando um usuário pela ID

`
curl --location --request GET 'http://localhost:9595/api/users/1' --header 'token-access: yQgYcNOysX87HX8KuK4Dy8Yiyk3pcEfEC5Wud3Baf9Kdu5q6AeaYL4on2VKm'
`

### Alterando o registro de um usuário
    
`
curl --location --request PUT 'http://localhost:9595/api/users/1' --header 'token-access: yQgYcNOysX87HX8KuK4Dy8Yiyk3pcEfEC5Wud3Baf9Kdu5q6AeaYL4on2VKm' --data-urlencode 'userDob=1981-03-20'
`

#### Dados que podem ser alterados : 


    userAddressNumber : int
    userAddressId : int(id tabela user_address)
    userGender : string
    userFirstName : string
    userLastName : string
    userUuid : string
    userEmail : string-mail
    userUsername : string
    userDob : date
    userPass : string(md5)
    userPhone : string
    userCell : string
    userPictureLarge : URL-string
    userPictureMedium : URL-string
    userPictureThunb : URL-string
    userStatus : string (draft, trash e published) 
    userRegister : datatime


### Deletando um registro de usuário 
    
`
curl --location --request DELETE 'http://localhost:9595/api/users/1' --header 'token-access: yQgYcNOysX87HX8KuK4Dy8Yiyk3pcEfEC5Wud3Baf9Kdu5q6AeaYL4on2VKm'
`

### Mostrando a mensagem "Back-end Challenge 20201209 Running"

`
curl --location --request GET 'http://localhost:9595/api/' --header 'token-access: yQgYcNOysX87HX8KuK4Dy8Yiyk3pcEfEC5Wud3Baf9Kdu5q6AeaYL4on2VKm'
`
