<?php
session_start();

$db_name = "onlinecourses";
$db_host = "localhost";
$db_user = "root";
$db_password = "";

if(!isset($_SESSION['userIdentification']))
{
	Header("Location: ../index.php");
	exit();
}
try{
	if(isset($_SESSION['count']))
	{
		unset($_SESSION['count']);
	}
	$_SESSION['count'] = 0;


	$fileName = "chatData".$_GET['idTransmision'].".txt";
	if(!file_exists($fileName)){
		fclose(fopen($fileName, 'w'));
	}
	$_SESSION['fileName'] = $fileName;


	$result = false;
	$db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db->prepare("select * from transmision where ID=?");

	$stmt->execute(array($_GET['idTransmision']));
	$result = $stmt->fetch();
}
catch(PDOException $e){
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<style>
		.chatBox{
			height: 200px;
			overflow-y: scroll;
			border-style: solid;
			border-width: 1px;
			background-color: #FFFFFF;
		}
	</style>


	<link rel="stylesheet" href="../resources/bootstrap-4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/chatStyle.css">

	<script src="../resources/jQuery/jquery-3.3.1.min.js"></script>
	<script src="../resources/bootstrap-4.3.1/js/bootstrap.min.js"></script>


	<title>Transmision</title>
</head>
<body style="padding-top: 70px;" onload="setInterval('loadDoc()', 300)">

<?php
require '../navigationBar.php';
?>

<div class="container-fluid">
	<div = class="row mt-4">
		<div class="col">
			<div class = "row mx-3">
				<?php
					if($result)
					{
						/*print '
						<iframe width="560" height="315" src="';
						*/

						print '
						<iframe width="711" height="400" src="';

						print $result["ubicacion"]."?autoplay=1&mute=1";
						print'" frameborder="0
						allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
					}
					else
					{
						print "Error. Se produjo un error al intentar obtener el video.";
					}
				?>
			</div>
			<div class="row mx-3">
				<?php
				if($result)
				{
					print "<h4>".$result["nombre"]."</h4>";
				}
				?>
			</div>
		</div>
		<div class="col" id="page-wrap">
			<div class="box box-primary direct-chat direct-chat-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Chat</h3>

					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				  <!-- Conversations are loaded here -->
					<div class="direct-chat-messages" id="chatBoxContent">
					</div>
				</div>

				<div class="box-footer">
					<form>
						<div class="input-group">
							<input type="text" name="message" placeholder="Escribir mensaje ..." class="form-control" maxlength="100" id="myChatMsg">
							<span class="input-group-btn">
								<button type="button" class="btn btn-primary btn-flat" onclick="writeDoc()">Enviar</button>
							</span>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

let numLines = 0;

function loadDoc() {
	let xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("chatBoxContent").innerHTML = this.responseText;
		}
	};
	//xhttp.open("GET", "chatdata.txt", true);
	xhttp.open("GET", "chatManagement.php?action=read", true);
	xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhttp.send();
}

function writeDoc(){
	let xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("myChatMsg").innerHTML = "";
		}
	};
	xhttp.open("POST", "chatManagement.php", true);
	xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhttp.send("data=" + document.getElementById("myChatMsg").value);
}
</script>

<script src="scripts/jquery.min.js"></script>
<script src="scripts/adminlte.min.js"></script>

</body>
</html>
