<?php include('../../templates/header.php');   ?>

<?php
if(isset($_POST["search"]))
{
  $nameToSearch = $_POST["nameToSearch"];
  $numberToSearch = $_POST["numberToSearch"];
  // $dateToSearch = $_POST["dateToSearch"];
  $comunaToSearch = $_POST["comunaToSearch"];
  $regionToSearch = $_POST["regionToSearch"];
  $typeToSearch = $_POST["typeToSearch"];

  $query = "SELECT * FROM recursos";
  $query = $query." NATURAL JOIN recursospendientes";
  $query = $query." NATURAL JOIN ryl NATURAL JOIN lugares";
  if($typeToSearch!="")
  {
      $query = $query." NATURAL JOIN pyr";
      $query = $query." INNER JOIN proyectos ON pyr.pid=proyectos.pid";
  }
  $query = $query." WHERE recursos.nombre LIKE '%".$nameToSearch."%' AND";
  if($typeToSearch!="")
  {
      $query = $query." proyectos.tipo LIKE '%".$typeToSearch."%' AND";
  }
  if($_POST['dateA']!="" and $_POST['dateB']!="")
  {
    // $dateA = date('Y-m-d', strtotime($_POST['dateA']));
    // $dateB = date('Y-m-d', strtotime($_POST['dateB']));
    $dateA = $_POST['dateA'];
    $dateB = $_POST['dateB'];
    $query = $query." recursos.fecha_apertura >= '".$dateA."' AND";
    $query = $query." recursos.fecha_apertura < '".$dateB."' AND";
  }

  $query = $query." numero LIKE '%".$numberToSearch."%' AND";
  $query = $query." comuna LIKE '%".$comunaToSearch."%' AND";
  $query = $query." region LIKE '%".$regionToSearch."%' AND";
  // $query = $query." fecha_apertura LIKE '%".$dateToSearch."%' AND";

  $query = substr($query,0,strlen($query)-4);

  $search_result = filterTable($query) -> fetchALL();
}
else {
  $query = "SELECT * FROM recursos NATURAL JOIN recursospendientes";
  $query = $query." NATURAL JOIN ryl NATURAL JOIN lugares";
  $search_result = filterTable($query) -> fetchALL();
}

function filterTable($query)
{
  require("../../config/conexion_impar.php");
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
  <center><h2 class="room-name">Recursos Pendientes</h2></center>
</div>

<center>

  <div class="container">
    <!-- <div class="row col-md-10 col-md-offset-2 custyle"> -->

      <form align="center" action="pendientes.php" method="post">
        <div class="row">
          <a class="card text-white bg-success mb-2 col-md-2">Numero</a><br><br>
          <a class="card text-white bg-success mb-2 col-md-2">Nombre</a><br><br>
          <a class="card text-white bg-success mb-2 col-md-2">Comuna</a><br><br>
          <a class="card text-white bg-success mb-2 col-md-2">Region</a><br><br>
          <a class="card text-white bg-success mb-2 col-md-2">Fecha de apertura</a><br><br>
          <a class="card text-white bg-success mb-2 col-md-2">Tipo de proyecto</a><br><br>

        </div>
        <div class="row">
          <input class="col-md-2" type="text" name="numberToSearch" palceholder="Value To Search"><br><br>
          <input class="col-md-2" type="text" name="nameToSearch" palceholder="Value To Search"><br><br>
          <select class="col-md-2" type="text" name="comunaToSearch" palceholder="Value To Search">
            <option value=""></option>
            <?php
            require("../../config/conexion_impar.php");
            $query = "SELECT comuna FROM lugares ORDER BY comuna";
            $result = $db -> prepare($query);
          	$result -> execute();
            $results = $result -> fetchALL();
            foreach ($results as $row){
              echo  "<option value=\"$row[0]\">$row[0]</option>";
            }

            ?>
            </select>
          <select class="col-md-2" type="text" name="regionToSearch" palceholder="Value To Search">
            <option value=""></option>
            <?php
            require("../../config/conexion_impar.php");
            $query = "SELECT region FROM lugares GROUP BY region ORDER BY region";
            $result = $db -> prepare($query);
          	$result -> execute();
            $results = $result -> fetchALL();
            foreach ($results as $row){
              echo  "<option value=\"$row[0]\">$row[0]</option>";
            }

            ?>
            </select>
            <div class="col-md-2">
              Desde:
               <input class="col-md-12 center" type="date" name="dateA" value="<?php echo date('Y-m-d'); ?>" />
               <br/>
               Hasta:
               <input class="col-md-12 center" type="date" name="dateB" value="<?php echo date('Y-m-d'); ?>" />
             </div>
          <select class="col-md-2" type="text" name="typeToSearch" palceholder="Value To Search">
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
              <th class="text-center">Numero</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Estado</th>
              <th class="text-center">Comuna</th>
              <th class="text-center">Region</th>
              <th class="text-center">Fecha de apertura</th>
              <th class="text-center">Causa contaminante</th>
              <th class="text-center">Area</th>
              <?php
              if($typeToSearch!="")
              {
                  echo "<th class=\"text-center\">Tipo de Proyecto</th>";
              }
              ?>
            </tr>
            </thead>


            <?php foreach ($search_result as $row){
              echo
              "<tr>
                  <td class = \"text-center\">$row[2]</td>
                  <td class = \"text-center\">$row[3]</td>
                  <td class = \"text-center\">$row[8]</td>
                  <td class = \"text-center\">$row[9]</td>
                  <td class = \"text-center\">$row[10]</td>
                  <td class = \"text-center\">$row[7]</td>
                  <td class = \"text-center\">$row[4]</td>
                  <td class = \"text-center\">$row[5]</td>";
                  if($typeToSearch!="")
                  {
                    echo "<td class = \"text-center\">$row[14]</td>";
                  }

                echo "</tr>";
              }
              ?>

          </table>
        </div>
      </form>


  </div>
</center>



















<?php include('footer.html'); ?>
