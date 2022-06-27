# Payment API

Para rodar o projeto: 

```bash
git clone git@github.com:jrnunes1993/payment-api.git
cd payment-api
cp .env.example .env
docker-compose up -d
php artisan db:seed
```

php artisan db:seed => Vai gerar 2 registros para a tabela User e 33 para a tabela Students

API PagSeguro
  https://dev.pagseguro.uol.com.br/reference/pagseguro-reference-intro

Bootstrap
  https://getbootstrap.com/docs/5.2/components/navbar/