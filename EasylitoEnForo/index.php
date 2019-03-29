<?php include("db.php"); ?>

<?php include('includes/header.php'); ?>

<main class="container p-5">
  <div class="row">
    <div class="col-md-12">
      <!-- MESSAGES -->

      <?php if (isset($_SESSION['message'])) { ?>
      <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php session_unset(); } ?>

      <!-- ADD TASK FORM -->
      <div class="card card-body">
        <form action="save_task.php" method="POST">
          <div class="form-group">
            <input type="text" name="title" class="form-control" placeholder="Introducir Titulo de Publicación.." autofocus>
          </div>
          <div class="form-group">
            <textarea name="description" rows="2" class="form-control" placeholder="Introducir Descripción.."></textarea>
          </div>
          <input type="submit" name="save_task" class="btn btn-info btn-block" value="Publicar">
        </form>
      </div>
    </div>
    <div class="col-md-12">
      <table class="table table-info">
        <thead>
          <tr>
            <th><h4><strong>Título</h4></strong></th>
            <th><h4><strong>Mensaje</h4></strong></dt></th>
            <th><h4><strong>Fecha de Publicación</strong></h4></th>
            <th><h4><strong>Acción</h4></strong></th>
          </tr>
        </thead>
        <tbody>

          <?php
          $query = "SELECT * FROM task";
          $result_tasks = mysqli_query($conn, $query);    

          while($row = mysqli_fetch_assoc($result_tasks)) { ?>
          <tr>
            <td><h3><?php echo $row['title']; ?></h3></td>
            <td><p class="lead"><?php echo $row['description']; ?></p></td>
            <td><?php echo $row['created_at']; ?></td>
            <td>
              <a href="edit.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
                <i class="fas fa-marker"></i>
              </a>
              <a href="delete_task.php?id=<?php echo $row['id']?>" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
              </a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<?php include('includes/footer.php'); ?>
