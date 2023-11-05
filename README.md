<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Sobre o PeoplePro

O PeoplePro está sendo projetado para ser um software de gestão voltado para empresas, por isso contém gerenciamento de colaboradores, benefícios, cargos e um dashboard ilustrativo. Além disso, o sistema funciona em modelo SaaS, o que possibilita múltiplos usuários, cada um com seus respectivos dados.

Confira as tecnologias utilizadas no projeto

- PHP 8.2.4 e Framework Laravel 10.21.0.
- HTML5, CSS3, Bootstrap 5, JavaScript Vanilla, ChartJS, DataTables.
- Banco de dados relacional MySQL (PHP MyAdmin).

Sobre o desevolvimento

- Laravel Blade foi utilizado no desenvolvimento da camada de visualização.
- As rotas foram, em sua maioria, definidas no arquivo routes/web.php, por exceção da rota de alimentação dos gráficos no dashboard. Neste caso, foi criado um endpoint em routes/api.php, tendo em vista que os gráficos foram populados via Api Fetch, com JS.
- Foi utilizado o padrão MVC e estrutura tradicional de um projeto monolítico, por questão da praticidade.
- O sistema está em fase de desenvolvimento, necessitando de correções em poucos detalhes e de melhorias a serem observadas, mas já está apto para demonstrações.
- Para autenticação e limitação de níveis de acesso foi utilizado Breeze em conjunto com Spatie Permissions.
- Utilizei, no front-end, o template free [SB-ADMIN-2](https://startbootstrap.com/theme/sb-admin-2) e fui implementando as modificações necessárias.
- Validações de formulário foram feitas com o FormRequest do Laravel e comandos artisan personalizados foram criados.

## Objetivo

O objetivo do projeto é a fixação de conhecimentos como padrão MVC, lógica de programação, PHP, MySQL e etc. Portanto, projetei o sistema para uma pequena carga de informações, priorizando a segurança e relacionamentos adequados entre os dados do banco e o usuário responsável, para que nenhum user acesse itens de outro, e para isso foi utilizado métodos como hasOne e hasMany, através do Eloquent do Laravel.

## Conferindo o funcionamento

Inicialmente, devemos configurar o .env com a nossa conexão de banco de dados e smtp, após isso devemos rodar os comandos:

- composer install / composer update -> para instalar/atualizar todas as dependências e pacotes laravel.
- php artisan migrate -> migrará todas tabelas necessárias para seu banco de dados.
- php artisan app:reproduzir-spatie-no-banco-de-dados (personalizado) -> populando tabelas relacionadas ao Access Control List.
- php artisan app:gerar-beneficios-no-banco-de-dados (personalizado) -> populando tabela de benefícios disponíveis.
- php artisan db:seed -> roda as sementes para popularem especificamente (neste caso) a tabela de usuários.
- php artisan serve -> servindo a aplicação, tornando-a disponível em seu navegador.


No gif abaixo podemos ver o processo de cadastro - onde o usuário preenche o cnpj que será, posteriormente, conferido na api cnpj.ws para preencher os dados na tabela "empresa" - e, após isso, acessando as informações de perfil:


<p align="center">
    <img width="400" height="300" src="/public/readme-docs/login-e-exibicao-do-perfil.gif">
</p>

A seguir, confira a funcionalidade relacionada aos benefícios, onde podemos vincular e desvincular os benefícios e o usuário. Como mencionado, o sistema está projetado para pequenas cargas de informações (ou até cargas medianas), portanto utilizei o datatable do próprio template, ao invés de configurá-lo para população com base em API. Desta forma, retornei as informações da forma convencional com Laravel, utilizando foreach nos `"<tr>"` de nossa tabela. Além disso, acho interessante ressaltar que os benefícios e o id do usuário responsável são enviados para uma tabela que relaciona os dois.


<p align="center">
    <img width="400" height="300" src="/public/readme-docs/beneficios.gif">
</p>


Na parte de "Empresa" dentro do sistema, podemos atualizar as informações da empresa em que estamos relacionados. Faz-se uso de duas APIs, sendo o cnpj.ws e o viacep, de forma que o usuário tenha mais facilidade e perca menos tempo preenchendo os campos do formulário. Quando estas informações são atualizadas com sucesso, elas são salvas no banco de dados, alterando dinamicamente o restante do sistema.


<p align="center">
    <img width="400" height="300" src="/public/readme-docs/empresa.gif">
</p>



## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
