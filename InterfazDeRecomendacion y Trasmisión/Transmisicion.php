<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">	

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	
    <title>Recomendaciones</title>    
</head>
<body>
<br>
 <div class="container">
     <div class="row">
         <h1>Transmisión</h1>
         <div class="card" style="width: 100rem;">
  <img class="card-img-top" src="img/transmicion.jpg" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Titulo De la Transmisión</h5>
    <p class="card-text">Introducción a C++.</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">En esta primera parte tocaremos los tipos de variablesque se pueden manejar con C++</li>
    <li class="list-group-item">La Clase Empezará a las 12:00 pm</li>
    <li class="list-group-item">Bienvenidos!!!!!!</li>
    <li class="list-group-item"><button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal">Editar Información de Trasnmisión</button></li>  
  </ul>
  <div class="card-body">
    <button type="button" class="btn btn-success">Iniciar Transmisión</button>
    <button type="button" class="btn btn-danger">Finalizar Transmisión</button>
    <button type="button" class="btn btn-warning">Detener Transmisión</button>
  </div>
</div>
         
         
         
     </div>
 </div>

  
    
</body>
</html>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Datos De Transmición</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <!-- contenido -->
        <form>
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputEmail4">Título</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="Ingrese el título..!">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Descripción Primaria </label>
    <input type="text" class="form-control" id="inputAddress" placeholder="Ingrese descripción..!">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Descripción Secundaria</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Ingrese descripción..!">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Descripción Adicional</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Ingrese descripción..!">
  </div>

</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Modificar</button>
      </div>
    </div>
  </div>
</div>
