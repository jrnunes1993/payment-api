# Payment API

Para rodar o projeto: 

```bash
git clone git@github.com:jrnunes1993/payment-api.git
cd payment-api
cp .env.example .env
docker-compose up -d
```

php artisan db:seed 
 - Gera 2 registros para a tabela User
 - Gera 33 registros para a tabela Students
 - Gera 50 registros para a tabela Charges

API PagSeguro
  https://dev.pagseguro.uol.com.br/reference/pagseguro-reference-intro

Bootstrap
  https://getbootstrap.com/docs/4.6/components/alerts/
