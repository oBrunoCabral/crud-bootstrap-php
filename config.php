<?php
/*
*Os quatro primeiros itens são as constantes que vão guardar as credenciais para acessar o banco de dados:
*o DB_NAME define o nome do seu banco de dados;
*o DB_USER é o usuário para acessar o banco de dados;
*o DB_PASSWORD é a senha deste usuário (no XAMPP, este usuário root não tem senha);
*e o DB_HOST é endereço do servidor do banco de dados;
*
*O  ABSPATH, na linha 17, define o caminho absoluto da pasta deste webapp no sistema de arquivos.
*Ela vai ser usada para chamar os outros arquivos  e templates via PHP (usando o include_once),
*já que ela guarda o caminho físico da pasta.
*
*E o BASEURL, na linha 21, define o caminho deste webapp no servidor web.
*Esse valor deve ser igual ao nome da pasta que você criou no começo do projeto.
*Ela será usada para montar os links da aplicação, já que ela guarda a URL inicial.
*/

	
	/* O nome do banco de dados */
	define ('DB_NAME', 'clientes');

	/* Usuário do banco de dados MySQL */
	define ('DB_USER', 'root');

	/* Senha do banco de dados MySQL*/
	define ('DB_PASSWORD', '');

	/* nome do host do MySQL*/
	define ('DB_HOST', 'localhost');

	/* caminho absoluto para a pasta do sistema*/
	if (!defined('ABSPATH'))
		define('ABSPATH', dirname(__FILE__) . '/');

	/* caminho no server para o sistema*/
	if(!defined('BASEURL'))
		define('BASEURL', '/crud-boostrap-php/');

	/* caminho do arquivo de banco de dados*/
	if (!defined('DBAPI')) 
		define('DBAPI', ABSPATH . 'inc/database.php');

	// define os caminhos para HEADER e FOOTER
	define('HEADER_FRONT_TEMPLATE', ABSPATH . 'inc/front-header.php');
	define('FOOTER_FRONT_TEMPLATE', ABSPATH . 'inc/front-footer.php');
	define('HEADER_TEMPLATE', ABSPATH . 'inc/header.php');
	define('FOOTER_TEMPLATE', ABSPATH . 'inc/footer.php');
?>