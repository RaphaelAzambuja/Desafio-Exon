# Desafio Exon

Desafio técnico para a empresa [Exon Sistemas e Consultoria](https://www.linkedin.com/company/exon-sistemas-e-consultoria/).

![](./imagens-app/produtos.jpeg)

![](./imagens-app/cadastrar-produto.jpeg)

![](./imagens-app/estruturas.jpeg)

![](./imagens-app/materia.jpeg)

## Requisitos

- PHP
- Composer
- Laravel
- Banco de dados relacional

## Configuração do Ambiente

1. Clone o repositório:
        
- git clone https://github.com/RaphaelAzambuja/Desafio-Exon.git

- Instale as dependências do Composer:
 
- `composer install`
- Copie o arquivo de configuração do ambiente:
    
- `cp .env.example .env`

- Configure o arquivo `.env` com as informações do seu banco de dados.

- Gere a chave de aplicativo Laravel:
    
- `php artisan key:generate`

- Execute as migrações do banco de dados:
    
1. `php artisan migrate`

## Uso

Execute o servidor embutido do Laravel:

```
php artisan serve
```

Acesse o projeto no navegador: [http://localhost:8000](http://localhost:8000/)
