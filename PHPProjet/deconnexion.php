<!DOCTYPE html>
<html>
<head>
	<title>Déconnexion</title>
</head>
<body>
<?php
	session_start();
	session_destroy();
	header('Location: http://tp.local/PHPProjet/index.php');
?>
</body>
</html>