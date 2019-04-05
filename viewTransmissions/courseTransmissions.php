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

$db = false;
$transmissionLimit = 5;
$offset = 0;

try
{
	$db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	/*
	$_SESSION['message'] = "Error de conexion a base de datos";
	Header("Location: index.php");
	exit();
	*/
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="../resources/bootstrap-4.3.1/css/bootstrap.min.css">
	<script src="../resources/jQuery/jquery-3.3.1.min.js"></script>
	<script src="../resources/bootstrap-4.3.1/js/bootstrap.min.js"></script>

	<title>Diseno</title>
</head>
<body style="padding-top: 70px;">


<?php
require '../navigationBar.php';
?>

<div class="container">
	<div class="row">
	<h1 style="margin-top: 10px;">Transmisiones en cursos inscritos.</h1>

	<table class="table table-striped" style="margin-top: 10px;">
		<thead class="thead-dark">
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
		if($db !== false)
		{
			try{
				if(isset($_GET["page"]))
				{
					$offset = $transmissionLimit * ($_GET["page"] - 1);
				}

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
				order by transmision.ID
				limit ? offset ?
				");

				/*
				select curso.nombre as nombreCurso, usuario.nombreCompleto as nombreProfesor, transmision.nombre as nombreTransmision, transmision.fechaAgendada, transmision.estatus, transmision.ID as idTransmision
				from curso
				inner join usuario_curso
					on usuario_curso.id_curso = curso.ID
				inner join usuario
					on curso.id_profesor = usuario.ID
				inner join transmision
					on transmision.id_curso = curso.ID
				where usuario_curso.id_usuario = 1
				order by transmision.ID
				limit 3 offset 2
				//use something like this
				*/

				//$stmt->execute(array($_SESSION['userIdentification']['ID'], $transmissionLimit, $offset));
				//necessary since above code makes $transmissionLimit and $offset be a string which conflicts with sql instruction since limit and offset must be integers
				$stmt->bindParam(1, $_SESSION['userIdentification']['ID'], PDO::PARAM_STR);
				$stmt->bindParam(2, $transmissionLimit, PDO::PARAM_INT);
				$stmt->bindParam(3, $offset, PDO::PARAM_INT);
				$stmt->execute();

				while($result = $stmt->fetch()){
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
				}
			}
			catch(PDOException $e){
				print "
				<tr>
				<td>dude</td>
				<td>dude</td>
				<td>dude</td>
				<td>dude</td>
				<td>dude</td>
				</tr>";
				/*
				$_SESSION['message'] = "Error de conexion a base de datos";
				Header("Location: index.php");
				exit();
				*/
			}
		}
		else
		{
			print "
				<tr>
				<td>dude2</td>
				<td>dude2</td>
				<td>dude2</td>
				<td>dude2</td>
				<td>dude2</td>
				</tr>";
		}
		//*/
		?>
		</tbody>
	</table>
	</div>
	<div class="row">
	<?php

	if($db !== false)
	{
		try{
			$selectedPage = 1;
			if(isset($_GET["page"]))
			{
				$selectedPage = $_GET["page"];
			}

			$stmt = $db->prepare("
			select COUNT(*)
			from curso
			inner join usuario_curso
				on usuario_curso.id_curso = curso.ID
			inner join usuario
				on curso.id_profesor = usuario.ID
			inner join transmision
				on transmision.id_curso = curso.ID
			where usuario_curso.id_usuario = ?
			");

			/*
			select curso.nombre as nombreCurso, usuario.nombreCompleto as nombreProfesor, transmision.nombre as nombreTransmision, transmision.fechaAgendada, transmision.estatus, transmision.ID as idTransmision
			from curso
			inner join usuario_curso
				on usuario_curso.id_curso = curso.ID
			inner join usuario
				on curso.id_profesor = usuario.ID
			inner join transmision
				on transmision.id_curso = curso.ID
			where usuario_curso.id_usuario = 1
			order by transmision.ID
			limit 3 offset 2
			//use something like this
			*/

			$stmt->execute(array($_SESSION['userIdentification']['ID']));
			$result = $stmt->fetch();
			$total_pages = ceil($result[0] / $transmissionLimit);

			if($total_pages)
			{
				$minPage = $selectedPage - 3;
				$maxPage = $selectedPage + 3;
				if($minPage < 1)
					$minPage = 1;
				if($maxPage > $total_pages)
					$maxPage = $total_pages;

				print '<ul class="pagination">';
				if($total_pages > 7)
					print "<li class='page-item'><a class='page-link' href='{$_SERVER["PHP_SELF"]}?page=1'>Primera</a></li>";
				for($p = $minPage; $p <= $maxPage; $p++)
				{
					if($p != $selectedPage)
						print "<li class='page-item'><a class='page-link' href='{$_SERVER["PHP_SELF"]}?page=$p'>$p</a></li>";
					else
						print "<li class='page-item active'><a class='page-link' href='{$_SERVER["PHP_SELF"]}?page=$p'>$p</a></li>";
				}
				if($total_pages > 7)
					print "<li class='page-item'><a class='page-link' href='{$_SERVER["PHP_SELF"]}?page=$total_pages'>Ultima</a></li>";
				print "</ul>";
			}
		}
		catch(PDOException $e){

		}
	}

	//*/
	?>
	</div>
</div>

</body>
</html>
