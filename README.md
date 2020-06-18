<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

## Como usar

- Ter instalado o [composer](https://getcomposer.org/);
- Utilizar o comando "composer install" que irá instalar os pacotes adicionais utilizados neste projeto:
    - Utilizado: Maatwebsite/Laravel-Excel [doc link](https://docs.laravel-excel.com/3.1/getting-started/upgrade.html).

- Alterar nome do arquivo env.example da raiz do projeto para .env
- Alterar as seguintes informações neste arquivo:
    - Informações de banco de dados (host, user, password, database);
    - Informação da Key do Google API no campo "GOOGLE_KEY";
    - Caso deseje alterar o ponto inicial do cálculo da rota, alterar as variáveis INITIAL_LAT e INITIAL_LNG inserindo os valores desejados;
   
- Rodar o comando "php artisan key:generate" para gerar a chave da aplicação Laravel;
- Rodar o comando "php artisan migrate" para gerar o banco de dados da aplicação;