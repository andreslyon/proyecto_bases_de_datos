<?php include('../../templates/header.php');   ?>

<?php
if(isset($_GET["search"]))
{
  $nameToSearch = $_GET["nameToSearch"];
  $typeOfProyectToSearch = $_GET["typeOfProyectToSearch"];

  $query = "SELECT * FROM proyectos";
  if ($typeOfProyectToSearch != "")
    {
      if($typeOfProyectToSearch == "Central")
      {
        $query = $query." NATURAL JOIN proyectoscentrales";
      }
      if($typeOfProyectToSearch == "Minera")
      {
        $query = $query." NATURAL JOIN proyectosmineras";
      }
      if($typeOfProyectToSearch == "Vertedero")
      {
        $query = $query." NATURAL JOIN proyectosvertederos";
      }
    }
  $query = $query." WHERE LOWER(nombre) LIKE LOWER('%".$nameToSearch."%')";

  $search_result = filterTable($query) -> fetchALL();
}
else {
  $query = "SELECT * FROM proyectos";
  $search_result = filterTable($query) -> fetchALL();
}

function filterTable($query)
{
  require("../../config/conexion_impar.php");
  $result = $db -> prepare($query);
	$result -> execute();
  return $result;
}

$_SESSION["current_page_url"] = "../navegacion/proyectos.php";

?>


<body class="bg-image">

<?php include('../login/login.php');   ?>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<?php include('../../templates/barra_nav.php');   ?>

<div class= "h1">
  <center><h2 class="room-name">Proyectos</h2></center>
</div>

<center>

  <div class="container">
    <!-- <div class="row col-md-10 col-md-offset-2 custyle"> -->

      <form align="center" action="proyectos.php" method="get">
        <div class="row">
          <a class="card text-white bg-success mb-2 col-md-2">Nombre</a><br><br>
          <a class="card text-white bg-success mb-2 col-md-2">Tipo de proyecto</a><br><br>
        </div>
        <div class="row">
          <input style="height:30px" class="col-md-2" type="text" name="nameToSearch" palceholder="Value To Search"><br><br>
          <select style="height:30px" class="col-md-2" type="text" name="typeOfProyectToSearch" palceholder="Value To Search">
            <option value=""></option>
            <option value="Central">Central</option>
            <option value="Minera">Minera</option>
            <option value="Vertedero">Vertedero</option>
            </select>
        </div>

        <button class= "btn btn-success btn-m" type="submit" name="search" value="Filter">Filtrar</button><br><br>

        <div class="table-wrapper-scroll-y my-custom-scrollbar">
          <table class="table table-bordered table-striped mb-0">
            <thead>
            <tr>
              <th class="text-center">Nombre</th>
              <th class="text-center">Tipo</th>
              <th class="text-center">Operativo</th>
              <th class="text-center">Fecha de apertura</th>
            </tr>
            </thead>


            <?php foreach ($search_result as $row){
              echo
              "<tr>
                  <td class = \"text-center\"><a href=../perfil_proyecto/proyecto.php?pid=$row[0]>$row[1]</a></td>
                  <td class = \"text-center\">$row[2]</td>
                  <td class = \"text-center\">$row[5]</td>
                  <td class = \"text-center\">$row[6]</td>
                </tr>";
              }
              ?>

          </table>
        </div>
      </form>


  </div>
</center>



<?php include('../../templates/footer.html');   ?>
