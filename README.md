
## Sobre o PeoplePro

O PeoplePro está sendo projetado para ser um software de gestão voltado para empresas, por isso contém gerenciamento de colaboradores, benefícios, cargos e um dashboard ilustrativo. Além disso, o sistema funciona em modelo SaaS, o que possibilita múltiplos usuários, cada um com seus respectivos dados.

Confira as tecnologias utilizadas no projeto

- PHP 8.2.4 e Framework Laravel 10.21.0.
- HTML5, CSS3, Bootstrap 5, JavaScript Vanilla, JQuery, ChartJS, DataTables.
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

Na parte de setores e cargos, há uma relação entre esses dois itens definidos pelo que chamamos de Chave Estrangeira (foreign key), tendo em vista que ambos se completam. Essas duas informações serão utilizadas para cadastrar colaboradores e para os gráficosa analíticos do dashboard. Confira a seguir um CRUD dessas informações e suas respectivas exbições por meio do JQuery DataTables:

<p align="center">
    <img width="400" height="300" src="/public/readme-docs/setores-e-cargos.gif">
</p>

Sabe-se que, em uma gestão profissional, existem diversas documentações - muitas vezes financeiras - que precisam ser guardadas (como .pdfs ou arquivos de imagem). Pensando nessa possibilidade, foi desenvolvida a funcionalidade "Financeiros" que funciona como um crud de documentações - as quais são armazenadas em uma pasta no projeto e seus nomes são codificados e enviados ao banco de dados.

<p align="center">
    <img width="400" height="300" src="/public/readme-docs/financeiros.gif">
</p>

Por fim, destas funcionalidades padrão de User comum, temos o CRUD completo de colaboradores, o qual consiste numa gama de informações próprias e relacionadas, contando também com o viacep. Essas informações compõem o perfil do profissional de forma visualmente simples dentro da tabela.

<p align="center">
    <img width="400" height="300" src="/public/readme-docs/colaboradores.gif">
</p>

Ao retornarmos em "Geral", podemos ver um dashboard muito mais completo, com gráficos e cards. Temos a contagem de colaboradores cadastrados ativos x inativos, temos cards ilustrando todos os benefícios aderidos pela empresa e gráficos ilustrando as informações relacionadas à nossa empresa, como a quantidade de colaboradores por setor/cargo, ou estimativas de salário:

<p align="center">
    <img width="400" height="300" src="/public/readme-docs/geral.gif">
</p>

Saindo dessas rotas de user comum, caso você tenha rodado o db:seed como instruído, pode-se efetuar o login como Administrador com o email "test@example.com" e a senha "password". Ao logar como usuário administrador, temos um controle privilegiado de quem pode acessar qualquer informação, apenas não podemos alterar os cargos padrão do sistema (adm e user comum) e nem modificar o cargo de outros possíveis administradores. Nesta demonstração a seguir, faço o login como usuário admin, crio um perfil de acesso que só possui as permissões para corporação > empresa e o atribuo ao nosso primeiro usuário (comum). A partir daí, o usuário que antes era comum, agora se limita ao acesso que associamos a ele:

<p align="center">
    <img width="400" height="300" src="/public/readme-docs/admin.gif">
</p>

## Considerações

Apesar de ainda haverem coisas a se resolverem, como monitorar o consumo na api de cnpj's, ou até melhorias como uma melhor validação para páginas de erros, este projeto me proporcionou uma boa experiência com a fixação de conhecimentos intermediários (porém, sólidos e completos) de PHP e Framework Laravel, permitindo-me ter o contato com funcionalidades múltiplas e explorar regras de negócio da maneira que melhor se aplicassem ao software.
