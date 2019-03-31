<?php
session_start();

if(!isset($_SESSION['userIdentification']))
{
	Header("Location: index.php");
	exit();
}
else
{
	unset($_SESSION['userIdentification']);
	Header("Location: index.php");
	exit();
}
?>
