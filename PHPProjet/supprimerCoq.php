<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>SupprimerCoq</title>
</head>
<body>
<?php 
	require 'classes/DB.php';
	require 'classes/COQ.php';
	$db = new DB();
	$pdo = $db->getPDO();
	session_start();

	COQ::supprimerCoq($_GET['nomcoq']);
?>
</body>
</html>