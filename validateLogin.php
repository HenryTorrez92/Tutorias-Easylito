<?php
session_start();

$db_name = "onlinecourses";
$db_host = "localhost";
$db_user = "root";
$db_password = "";

if(!isset($_POST["password"]) || !isset($_POST["username"])){
	Header("Location: index.php");
	exit();
}

$username = trim($_POST['username']);

/*
if(!strlen($usename)){
	$_SESSION['message'] = "nombre de usuario o contraseña invalido";
	Header("Location: index.php");
	exit();
}
*/

try{
	$db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db->prepare("select ID, nombreUsuario from usuario where nombreUsuario = ? and pass = ?");

	$stmt->execute(array($username, $_POST['password']));
	$result = $stmt->fetch();

	if($result){
		$_SESSION['userIdentification'] = $result;
		Header("Location: viewTransmissions/courseTransmissions.php");
		exit();
	}
	else{
		$_SESSION['message'] = "nombre de usuario o contraseña invalido";
		Header("Location: index.php");
		exit();
	}
}
catch(PDOException $e){
	$_SESSION['message'] = "Error de conexion a base de datos";
	Header("Location: index.php");
	exit();
}


?>
