<?php
session_start();

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
	$db = new PDO('mysql:host=localhost;dbname=onlinecourses', 'root', '');
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

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


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
			<div class="container-fluid" id="accordion" style="background-color: #DEE4E7;">
				<div class="row">
					<div class="col-12 rounded border border-black" style="border-width: 2px!important; border-color: black!important">
						<div class="row bg-info rounded-top card-header" style="color: white;">
							<a class="card-link col-12" data-toggle="collapse" href="#collapseOne"><button type="button" class="btn btn-info col-12"><legend>Chat</legend></button></a>
						</div>
						<div class="collapse show" id="collapseOne" data-parent="#accordion">
							<div class="card-body">
								<br />
								<form action="" method="POST" role="form">
									<div class="row chatBox" id="chatBoxContent">

									</div>
									<br />
									<div class="row">
										<button type="button" class="btn btn-primary" style="height: 50px;" onclick="writeDoc()">Enviar mensaje</button>
										<textarea class="col" maxlength="100" style="height: 100px;" id="myChatMsg">
										</textarea>
									</div>
								</form>
								<br />
							</div>
						</div>
					</div>
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
</body>
</html>
