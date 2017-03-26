<?php 
	
	require_once('../config.php');
	require_once(DBAPI);

	$customers=null; //variavel customers conterá o conjunto de registros
	$customer=null; //variável customer conterá um único cliente para casos de inserção.

	// LISTAGEM DE CLIENTES

/*
index() é a função que será chamada na tela principal de clientes, e ela fará a
consulta pelos registros no banco de dados, e depois colocará tudo na variável
$customers, para que possamos exibir. Observe que tem uma função find_all()
sendo usada, é ela que traz os dados.
*/
	function index(){
		global $customers;
		$customers=find_all('customers');
	}

?>

<?php
/**
 *  Cadastro de Clientes
 */
	function add() {
	  if (!empty($_POST['customer'])) {
	    
	    $today = date_create('now', new DateTimeZone('America/Sao_Paulo'));
	    $customer = $_POST['customer'];
	    $customer['modified'] = $customer['created'] = $today->format("Y-m-d H:i:s");
	    
	    save('customers', $customer);
	    header('location: index.php');
	  }
	}
?>

<?php
/**
 *	Atualizacao/Edicao de Cliente
 */
	function edit() {
	  $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));
	  if (isset($_GET['id'])) {
	    $id = $_GET['id'];
	    if (isset($_POST['customer'])) {
	      $customer = $_POST['customer'];
	      $customer['modified'] = $now->format("Y-m-d H:i:s");
	      update('customers', $id, $customer);
	      header('location: index.php');
	    } else {
	      global $customer;
	      $customer = find('customers', $id);
	    } 
	  } else {
	    header('location: index.php');
	  }
	}

?>