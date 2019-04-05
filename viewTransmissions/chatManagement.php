<?php
session_start();

if(!isset($_SESSION['userIdentification']))
{
	Header("Location: ../index.php");
	exit();
}

if($_SERVER['REQUEST_METHOD'] == "GET")
{
	if(file_exists($_SESSION['fileName']) && isset($_SESSION['count']))
	{
		if(isset($_GET['action']))
		{
			/*
			$file = file_get_contents($_SESSION['fileName']);
			$file = str_replace("\n", "<br />", $file);
			print $file;
			*/
			foreach(file($_SESSION['fileName']) as $line)
			{
				$pos1 = strpos($line, ",");
				$pos2 = strpos($line, "-");

				$username = substr($line, 0, $pos1);
				$date = substr($line, $pos1 + 1, $pos2 - 1 - $pos1);
				$msg = substr($line, $pos2 + 1);
				//enr,03/02/1992 12:12 am-asdoajdiojadaj
				//3
				//23
				print "
				<div class='direct-chat-msg'>
                  <div class='direct-chat-info clearfix'>
                    <span class='direct-chat-name pull-left'>$username</span>
                    <span class='direct-chat-timestamp pull-right'>$date</span>
                  </div>
                  <div class='direct-chat-text'>
                    $msg
                  </div>

                </div>
				";
			}
		}
	}
}
elseif($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['data']))
	{
		date_default_timezone_set("America/Mexico_City");
		//$data = "<b>".$_SESSION['userIdentification']['nombreUsuario']."</b>: ";
		$date = date("d/m/Y h:i a", time());

		$data = $_SESSION['userIdentification']['nombreUsuario'].",".$date."-";
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
