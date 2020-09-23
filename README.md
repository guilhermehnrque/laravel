# Projeto de transações

## Proposta
Este repositório tem como propósito o desenvolvimento de uma API RESTful para transferências de dinheiro entre usuários utilizando o Framework Laravel
- Permitir o cadastro de usuários 
- Permitir a criação de carteiras virtuais
- Permitir a recarga da carteira virtual
- Permitir a transferência de saldo entre usuários

## Depedências
- Docker
- MySQL 5.7
- PHP 7.3
- NGINX stable-alpine
- Composer
- Artisan

## Instruções para execução
 Na pasta raiz execute o comando ```docker-compose up --build -d``` para a construção do serviços do banco de dados, servidor web e o serviço php.


 Após acesse o diretório ```brochini```, renomeie o arquivo ```.env.example``` para ```.env```. As váriaveis de ambiente já estão configuradas mas ainda resta o ```APP_KEY```, para isso executa o comando ```php artisan key:generate``` para criação da chave de aplicativo.


 Para finalizar, execute o comando ```docker-compose run --rm artisan migrate``` para criação das tabelas no banco de dados.
