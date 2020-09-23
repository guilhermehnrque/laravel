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

## Motivação

A escolha pela utilização do Laravel para a construção da API se deve a facilidade na utilização dos comandos Artisan e utilização do FormRequest para validação dos campos permitindo a criação de Controllers mais limpos.

## Instruções para execução

Na pasta raiz execute o comando `docker-compose up --build -d` para a construção do serviços do banco de dados, servidor web e o serviço php.


Em seguida acesse o diretório do laravel `brochini` e instale o composer `docker-compose run --rm composer install`


Em seguida renomeie o arquivo `.env.example` para `.env`. As váriaveis de ambiente já estão configuradas mas ainda resta o `APP_KEY`, para isso executa o comando `docker-compose run --rm artisan key:generate` para criação da chave de aplicativo.


Para finalizar, execute o comando `docker-compose run --rm artisan migrate` para criação das tabelas no banco de dados.

## Endpoints

Para a listagem no Laravel das rotas, utilizar o comando `docker-compose run --rm artisan route:list`. Assim como um arquivo contendo as rotas está no respositório para utilização no Postman

### Users

POST/user/create

```
{
   "full_name": "Nome completo",
   "cpf_cnpj": "CPF ou CNPJ",
   "email": "email@email.com",
   "password": "123456",
   "type": "lojista|comun"
}
```

### Wallets

POST/wallet/create

```
{
    "current_balance": "0.00",
    "status": "active",
    "user_id": ""
}
```

### Income

PATCH/wallet/income/{wallet_id}

```
{
    "income": "value",
    "user_id": ""
}
```

### Transaction

POST/transaction

```
{
    "value": "35",
    "payer": "2",
    "payee": "1"
}
```
