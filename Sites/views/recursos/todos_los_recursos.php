<?php include('../../templates/header.html');   ?>

<?php
if(isset($_POST["search"]))
{
    $typeOfProyectToSearch = $_POST["typeOfProyectToSearch"];
    $dateA = $_POST["dateA"];
    $dateB = $_POST["dateB"];

    $selected = "recursos.numero, recursos.nombre, recursos.status,";
    $selected = $selected." lugares.comuna, lugares.region, recursos.fecha_apertura,";
    $selected = $selected." recursos.causa_contaminante, recursos.area_influencia_kms,";
    $selected = $selected." proyectos.tipo";

    $query = "SELECT ".$selected." FROM recursos";
    $query = $query." NATURAL JOIN ryl NATURAL JOIN lugares";
    $query = $query." NATURAL JOIN pyr INNER JOIN proyectos ON pyr.pid = proyectos.pid";

    if ($typeOfProyectToSearch != "")
    {
      if($typeOfProyectToSearch = "Centrales")
      {
        $query = $query." INNER JOIN proyectoscentrales ON proyectoscentrales.pid = proyectos.pid";
      }
      if($typeOfProyectToSearch = "Mineras")
      {
        $query = $query." INNER JOIN proyectosmineras ON proyectosmineras.pid = proyectos.pid";
      }
      if($typeOfProyectToSearch = "Vertederos")
      {
        $query = $query." INNER JOIN proyectosvertederos ON proyectosvertederos.pid = proyectos.pid";
      }
    }

    $query = $query." WHERE recursos.nombre LIKE '%".$nameToSearch."%' AND";

    if($_POST['dateA']!="" and $_POST['dateB']!="")
    {
      // $dateA = date('Y-m-d', strtotime($_POST['dateA']));
      // $dateB = date('Y-m-d', strtotime($_POST['dateB']));
      $dateA = $_POST['dateA'];
      $dateB = $_POST['dateB'];
      $query = $query." recursos.fecha_apertura >= '".$dateA."' AND";
      $query = $query." recursos.fecha_apertura < '".$dateB."' AND";
    }

    $query = substr($query, 0, strlen($query) - 4);

    $search_result = filterTable($query) -> fetchALL();
}
else
{
    $selected = "recursos.numero, recursos.nombre, recursos.status,";
    $selected = $selected." lugares.comuna, lugares.region, recursos.fecha_apertura,";
    $selected = $selected." recursos.causa_contaminante, recursos.area_influencia_kms,";
    $selected = $selected." proyectos.tipo";

    $query = "SELECT ".$selected." FROM recursos";
    $query = $query." NATURAL JOIN ryl NATURAL JOIN lugares";
    // $query = "SELECT * FROM proyectos";
    $query = $query." NATURAL JOIN pyr INNER JOIN proyectos ON pyr.pid = proyectos.pid";
    $search_result = filterTable($query) -> fetchALL();

}

function filterTable($query)
{
  require("../../config/conexion.php");
  $result = $db -> prepare($query);
	$result -> execute();
  return $result;
}

?>


<body class="bg-image">

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


<div class= "h1">
  <center><h2 class="room-name">Todos Los Recursos</h2></center>
</div>


<center>

  <div class="container">
    <!-- <div class="row col-md-10 col-md-offset-2 custyle"> -->

      <form align="center" action="todos_los_recursos.php" method="post">
        <div class="row">
          <a class="card text-white bg-success mb-2 col-md-2">Asociados a Proyecto de tipo</a><br><br>
          <a class="card text-white bg-success mb-2 col-md-2">Fecha de apertura</a><br><br>
        </div>
        <div class="row">
          <select class="col-md-2" type="text" name="typeOfProyectToSearch" palceholder="Value To Search">
            <option value=""></option>
            <option value="Central">Central</option>
            <option value="Minera">Minera</option>
            <option value="Vertedero">Vertedero</option>
            </select>

          <div class="col-md-2">
            Desde:
             <input class="col-md-12 center" type="date" name="dateA" value="<?php echo date('Y-m-d'); ?>" />
             <br/>
             Hasta:
             <input class="col-md-12 center" type="date" name="dateB" value="<?php echo date('Y-m-d'); ?>" />
           </div>

        </div>

        <button class= "btn btn-success btn-m" type="submit" name="search" value="Filter">Filtrar</button><br><br>

        <div class="table-wrapper-scroll-y my-custom-scrollbar">
          <table class="table table-bordered table-striped mb-0">
            <thead>
            <tr>
              <th class="text-center">Numero</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Estado</th>
              <th class="text-center">Comuna</th>
              <th class="text-center">Region</th>
              <th class="text-center">Fecha de apertura</th>
              <th class="text-center">Causa contaminante</th>
              <th class="text-center">Area</th>
              <th class="text-center">Tipo de Proyecto</th>

            </tr>
            </thead>


            <?php foreach ($search_result as $row){
              echo
              "<tr>
                  <td class = \"text-center\">$row[0]</td>
                  <td class = \"text-center\">$row[1]</td>
                  <td class = \"text-center\">$row[2]</td>
                  <td class = \"text-center\">$row[3]</td>
                  <td class = \"text-center\">$row[4]</td>
                  <td class = \"text-center\">$row[5]</td>
                  <td class = \"text-center\">$row[6]</td>
                  <td class = \"text-center\">$row[7]</td>
                  <td class = \"text-center\">$row[8]</td>
                  </tr>";
              }
              ?>

          </table>
        </div>
      </form>


  </div>
</center>


<?php include('footer.html'); ?>
