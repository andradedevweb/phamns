# Phamns
Um projeto de rede social para meu portifólio! 

<h2> Descrição </h2>

O projeto foi desenvolvido com padrão MVC e tem funcionalidades simples de uma rede social tais como sistema de posts, sistema de amizades, sistema de login e usuario, comunidade, feed e etc...

<h2>Estrtura das pastas</h2>

Com execeção do arquivo <b>index.php</b> todos os arquivos referentes ao programa estão contidos na pastas <b>App</b> por uma questão simples de organizaão. Dentro da pastas <b>App</b> teremos algumas classes que serão responsaveis por manter o funcionamento geral do nosso sistema como:

<ul>
<li>MySql.php:</b> que sera responsavel por manter nossa conexão com o banco de dados</li>
<li><b>Ultilidades.php:</b> que será responsavel por efetuar as trocas de pagina atraves do metodo redirect() e emitir alertas ao usuario atraves do metodo alerta()</li>
<li><b>Bycript.php:</b> classe nativa do PHP que ajudara a encripitar a senha do usuario</li>
<li><b>Application.php:</b> classe que responsavel porrenderizar os controllers da aplicaão </li>
</ul>

Fora estas classes ainda teremos dentro da pasta App as pastas Controllers, Models e Views onde a pasta Controller será responsavel por armazenar os arquivos que irão realizar toda a logica da aplicação, a pasta Models será responsavel por realizar as Querys com o banco de dados da aplicão, e a pasta Views sera responsavel por armazenar os arquivos que serão renderizados na tela do usuario

<h2>Banco de dados</h2>

Para ultilizar as tabelas e o banco de dados ultilizados no projeto você deve executar as querys presentes no arquivo querys.sql 
