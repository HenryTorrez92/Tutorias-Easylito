<?php
session_start();

if(!isset($_SESSION['userIdentification']))
{
	Header("Location: index.php");
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">	

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

	<title>Diseno</title>
</head>
<body style="padding-top: 70px;">


<?php
require 'navigationBar.php';
?>

<div class="container">
	<h1>Transmisiones en cursos inscritos.</h1>		
	
	<table class="table">
		<thead>
			<tr>
			
				<th>Curso</th>
				<th>Nombre de transmision</th>
				<th>Fecha agendada de transmision</th>			
				<th>Profesor</th>
				<th>Estatus</th>
			</tr>
		</thead>
		<tbody>
		<?php
		//*
		try{
			$db = new PDO('mysql:host=localhost;dbname=onlinecourses', 'root', '');
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $db->prepare("
			select curso.nombre as nombreCurso, usuario.nombreCompleto as nombreProfesor, transmision.nombre as nombreTransmision, transmision.fechaAgendada, transmision.estatus, transmision.ID as idTransmision
			from curso
			inner join usuario_curso 
				on usuario_curso.id_curso = curso.ID
			inner join usuario
				on curso.id_profesor = usuario.ID
			inner join transmision
				on transmision.id_curso = curso.ID
			where usuario_curso.id_usuario = ?
			");
			
			$stmt->execute(array($_SESSION['userIdentification']['ID']));
			
			//erase counter and dude and queryRes latter
			$counter = 0;
			$dude = "ñola";
			while($result = $stmt->fetch()){
				$counter++;
				
				$queryRes = array(
				"nombreCurso" => utf8_decode($result["nombreCurso"]),
				"nombreTransmision" => utf8_decode($result["nombreTransmision"]),
				"nombreProfesor" => utf8_decode($result["nombreProfesor"]),
				);
				
				
				print "
				<tr>
					<td>$result[nombreCurso]</td>
					<td>";
					
				print "<a href=\"liveStream.php?idTransmision=".$result["idTransmision"]."\"> $result[nombreTransmision] </a>";
				
				print "</td>
					<td>$result[fechaAgendada]</td>
					<td>$result[nombreProfesor]</td>
					<td>";
				if($result["estatus"] == 1)
				{
					print "transmitiendo";
				}
				elseif($result["estatus"] == 2)
				{
					print "finalizada";
				}
				else
				{
					print "pendiente";
				}
				print "</td></tr>";				
				/*
				print "
				<tr>
					<td>$result[nombreCurso]</td>
					<td>$result[nombreTransmision]</td>
					<td>$result[fechaAgendada]</td>
					<td>$result[nombreProfesor]</td>
					<td>";
				//*/	
				
				
				
			}
		}
		catch(PDOException $e){
			/*
			$_SESSION['message'] = "Error de conexion a base de datos";
			Header("Location: index.php");
			exit();
			*/
		}
		//*/
		?>
		</tbody>
	</div>
</div>

</body>
</html>