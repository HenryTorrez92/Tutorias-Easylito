<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
	<div class="col-2">
		<a class="navbar-brand" href="#">Easylito</a>
	</div>

	<div class="col-8">
		<form class = "form-horizontal" action="">
			<div class="form-group row" style="margin-bottom: 0px;">
				<div class="col-10">
					<input class="form-control mr-sm-2" type="text" placeholder="Buscar curso">
				</div>
				<div class="col-2">
					<div class="row">
					<button class="btn btn-success float-left" type="submit">Search</button>
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="col-2 text-center">
		<ul class="navbar-nav float-right">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
					<?= $_SESSION["userIdentification"]["nombreUsuario"]?>
				</a>
				<div class="dropdown-menu dropdown-menu-right">
					<a class="dropdown-item" href="#">Mis datos</a>
					<a class="dropdown-item" href="#">Mis cursos</a>
					<a class="dropdown-item" href="/Tutorias-Easylito/VisualizarTransmisiones/courseTransmissions.php">Transmisiones</a>
					<a class="dropdown-item" href= <?= "/Tutorias-Easylito/logout.php" ?>>Cerrar session</a>
				</div>
			</li>
		</ul>
	</div>
</nav>
