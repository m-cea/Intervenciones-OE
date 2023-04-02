<?php include("..\db.php"); 

$docente = '';
$nombre = '';
$grado = '';

if  (isset($_GET['ID'])) {
  $id = $_GET['ID'];
  $query = "SELECT * FROM Docentes WHERE ID=$id";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $docente = $row['ID'];
    $nombre = $row['Nombre'];
    $grado = $row['Grado'];
  }
}?>

<?php include('..\Includes\header.php'); ?>

<!-- ADD TASK FORM -->
<div class="row d-flex justify-content-center">
  <div class="col-md-12">
    <form action="guardar-intervencion-docente.php" method="POST">

      <div class="row justify-content-center">     
        <div class="col-md-3">    
          <h2>Añadir intervención</h2>
        </div>
      </div>

      <div class="row d-flex justify-content-center">
        <div class="col-md-5">
          <div class="form-group">
            <input type="number" name="id" class="form-control" placeholder="id" value = "<?php echo $docente ?>" hidden autofocus> <p><br></p>
          </div>
          <div class="form-group">
            Docente:<input type="text" name="docente" class="form-control" value = "<?php echo $nombre ?>" readonly autofocus> <p><br></p>
          </div>
          <div class="form-group">
            Grado:<input type="text" name="grado" class="form-control" value = "<?php echo $grado ?>" readonly autofocus> <p><br></p>
          </div>
          <div class="form-group">
            Fecha: <input type="date" name="fecha" class="form-control" placeholder="Fecha" autofocus><p><br></p>
          </div>
        </div>

        <div class="col-md-5">
          <p><br></p>
          <div class= "form-group">
            Intervención: <textarea name="intervencion" rows="5" cols="100" placeholder="Escribir aquí" autofocus></textarea><p><br></p>
          </div>
        </div>
        <div class="col-md-1"></div>
      </div>

      <div class="row d-flex justify-content-center">
        <div class="col-md-2">
          <input type="submit" name="guardar_intervencion_docente" class="btn btn-success btn-block" value="Guardar Intervención"><p><br></p>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="row d-flex justify-content-center"><br><br>
  <div class="col-md-3">  
    <h2>Listado de Intervenciones</h2>
  </div>
  <div class="col-md-10">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Fecha</th>
          <th>Intervención</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>

      <?php
      $query = "SELECT * FROM `intervenciones-docentes` AS i INNER JOIN Docentes AS d ON i.Docente = d.ID WHERE d.ID = $id ORDER BY i.Fecha DESC";
      $result_tasks = mysqli_query($conn, $query);

      while($row = mysqli_fetch_array($result_tasks)) { ?>
      <tr>
        <td><?php echo $row['Fecha']; ?></td>
        <td><?php echo $row['Intervención']; ?></td>
        <td>
          <a href="editar-intervencion-docente.php?ID=<?php echo $row['Codigo']?>" class="btn btn-secondary">
            <i class="fas fa-marker"></i> Editar
          </a>
          <a href="eliminar-intervencion-docente.php?ID=<?php echo $row['Codigo']?>" class="btn btn-danger" onclick='return confirmar()'>
            <i class="far fa-trash-alt"></i> Eliminar
          </a>
        </td>
            </tr>
            <?php } ?>
          </tbody>
    </table>
    <a href="..\index.php" class="btn btn-dark">Volver</a>
  </div>
</div>


<?php include('..\Includes\footer.php'); ?>