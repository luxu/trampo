<?php
require_once('pdo.class.php');

if(isset($_GET["query"])){
	$query = strtolower($_GET["query"]);

	$sql = "SELECT comercio FROM pecas WHERE comercio LIKE ?";
	$dbh = Database::conexao();
	$stmt = $dbh->prepare($sql);
	$stmt->bindValue(1, "$query%", PDO::PARAM_STR);
	$stmt->execute();

	$array = array();
	while ($results = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$array[] = $results['comercio'];
	}
	echo json_encode($array);
}
