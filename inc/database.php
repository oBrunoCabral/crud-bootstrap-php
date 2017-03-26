<?php 
/*
Primeiramente, na linha 7, configuramos o MySQL para avisar sobre erros
graves, usando a função mysqli_report().
*/

	mysqli_report(MYSQLI_REPORT_STRICT);


/*
função – open_database() – abre a conexão com a base de dados, e retorna a
conexão realizada, se der tudo certo. Se houver algum erro ($e), a função
dispara uma exceção, que pode ser exibida ao usuário.
*/

	function open_database(){
		try{
			$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			return $conn;
		}
		catch (Exception $e){
			echo $e->getMessage();
			return null;
		}
	}
/*
função – close_database($conn) – fecha a conexão que for passada.
Se houver qualquer erro, a função dispara uma exceção ($e), também.
*/

	function close_database($conn){
		try {
			mysqli_close($conn);
		}
		catch (Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}
?>

<?php 
/*
Pesquisando registros no banco de dados.
Se for passado algum id, nos parâmetros, a pesquisa será feita por esse id, que
é a chave primária da tabela. Se não for passado o id, a consulta retornará
todos os registros da tabela. Nos dois casos, a consulta retornará dados 
associativos (usando o fetch_assoc e MYSQLI_ASSOC), ou seja, são arrays com o
nome da coluna e o valor dela.
Caso aconteça algum problema na consulta e for disparada uma Exceção, nós 
devemos exibir o que aconteceu em forma de mensagem. Para isso, eu criei duas
variáveis de sessão, do PHP, que vão guardar a mensagem da exception, e assim
poderemos exibir na tela.

*/
	function find($table=null,$id=null) {
		$database = open_database();
		$found = null;

		try {
			if($id){
				$sql= "SELECT * FROM " . $table . "WHERE id = " . $id;
				$result = $database->query($sql);

				if($result->num_rows > 0){
					$found = $result->fetch_assoc();
				}
			}
			else {
				$sql = "SELECT * FROM " . $table;
				$result = $database->query($sql);

				if($result){
					$found = $result->fetch_all(MYSQLI_ASSOC);
				}
			}
		}
		catch (Exception $e){
			$_SESSION['message'] = $e->getMessage();
			$_SESSION['type'] = 'danger';
		}

		close_database($database);
		return $found;
	}
?>


<?php 
/*
pesquisando todos os registros de uma tabela.
Essa função é só um "alias" para a função find, ou seja, uma outra forma mais
prática de chamar a função sem precisar do parâmetro.
*/
	function find_all( $table ) {
		return find($table);
	}
?>

<?php
/**
*  Insere um registro no BD
*/
	function save($table = null, $data = null) {
	  $database = open_database();
	  $columns = null;
	  $values = null;
	  //print_r($data);
	  foreach ($data as $key => $value) {
	    $columns .= trim($key, "'") . ",";
	    $values .= "'$value',";
	  }
	  // remove a ultima virgula
	  $columns = rtrim($columns, ',');
	  $values = rtrim($values, ',');
	  
	  $sql = "INSERT INTO " . $table . "($columns)" . " VALUES " . "($values);";
	  try {
	    $database->query($sql);
	    $_SESSION['message'] = 'Registro cadastrado com sucesso.';
	    $_SESSION['type'] = 'success';
	  
	  } catch (Exception $e) { 
	  
	    $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
	    $_SESSION['type'] = 'danger';
	  } 
	  close_database($database);
	}
?>

<?php
/**
 *  Atualiza um registro em uma tabela, por ID
 */
	function update($table = null, $id = 0, $data = null) {
	  $database = open_database();
	  $items = null;
	  foreach ($data as $key => $value) {
	    $items .= trim($key, "'") . "='$value',";
	  }
	  // remove a ultima virgula
	  $items = rtrim($items, ',');
	  $sql  = "UPDATE " . $table;
	  $sql .= " SET $items";
	  $sql .= " WHERE id=" . $id . ";";
	  try {
	    $database->query($sql);
	    $_SESSION['message'] = 'Registro atualizado com sucesso.';
	    $_SESSION['type'] = 'success';
	  } catch (Exception $e) { 
	    $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
	    $_SESSION['type'] = 'danger';
	  } 
	  close_database($database);
	}
?>