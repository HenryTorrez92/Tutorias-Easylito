<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">	

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	
    <title>inicio sesion</title>    
</head>
<body>	
	<!--
	<div class="col-12 bg-warning">
		<div class="row bg-success"> dude </div>
	</div>
	
	-->
	<div class="container-fluid">
		<div class="row">
			<div class="mx-auto mt-5 col-5 rounded border border-black">
				<div class="row bg-info rounded-top" style="color: white;">
					<div class="col-12">
						<legend>Tutorias Easylito</legend>
					</div>
				</div>
				<br />
				
				<form action="validateLogin.php" method="POST" role="form">					
					<?php
					
					//*
					if(isset($_SESSION['message'])){
						print "<div class='alert alert-warning alert-dismissible fade show'>\n";
						print "<button type='button' class='close' data-dismiss='alert'>&times;</button>\n";
						print "<strong>Aviso!</strong> $_SESSION[message]\n";
						print "</div>\n";
						unset($_SESSION['message']);
					}
					//*/
					?>
					
					<div class="form-group row">
						<label class="col-lg-2 col-form-label" for="inputUserName">usuario</label>
						<div class="col-lg-10">
							<input name="username" type="text" class="form-control" placeholder="nombre de usuario" id="inputUserName">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-2 col-form-label" for="inputPassword">contraseña</label>
						<div class="col-lg-10">
							<input name="password" type="password" class="form-control" placeholder="contraseña" id="inputPassword">
						</div>
					</div>
					<br />
					<button type="submit" class="btn btn-primary">Iniciar sesion</button>
				</form>                  
				<br />
			</div>
		</div>
	</div>	
    
</body>
</html>














