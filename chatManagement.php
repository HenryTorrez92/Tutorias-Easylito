<?php
session_start();

if(!isset($_SESSION['userIdentification']))
{
	Header("Location: index.php");
	exit();
}

if($_SERVER['REQUEST_METHOD'] == "GET")
{
	if(file_exists($_SESSION['fileName']) && isset($_SESSION['count']))
	{
		if(isset($_GET['action']))
		{				
			$file = file_get_contents($_SESSION['fileName']);
			$file = str_replace("\n", "<br />", $file);
			print $file;			
		}	
	}
}
elseif($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['data']))
	{					
		//$data = "<b>".$_SESSION['userIdentification']['nombreUsuario']."</b>: ";
		$data = $_SESSION['userIdentification']['nombreUsuario'].": ";
		$msg = $_POST['data'];
		$msg = trim($msg);
		$msg = htmlentities($msg);
		$data .= $msg;
		$file = fopen($_SESSION['fileName'], 'ab');
		fwrite($file, $data."\n");
		fclose($file);
	}	
}


?>