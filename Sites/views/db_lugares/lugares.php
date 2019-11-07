<?php include('../../templates/header.php');   ?>

<?php
if(isset($_POST["search"]))
{
    $withResourceToSearch = $_POST["withResourceToSearch"];

    if($withResourceToSearch="pendientes")
    {
        $query = "SELECT lugares.region FROM recursos NATURAL JOIN recursospendientes NATURAL JOIN ryl NATURAL JOIN lugares";
    }
    if($withResourceToSearch="rechazadas")
    {
        $query = "SELECT lugares.region FROM recursos NATURAL JOIN recursosrechazados NATURAL JOIN ryl NATURAL JOIN lugares";
    }
    if($withResourceToSearch="aprobados")
    {
        $query = "SELECT lugares.region FROM recursos NATURAL JOIN recursosaprobados NATURAL JOIN ryl NATURAL JOIN lugares";
    }
}

else
{
    $query = "SELECT region FROM lugares";

}

$query = substr($query,0,strlen($query)-4);

$search_result = filterTable($query) -> fetchALL();


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
  <center><h2 class="room-name">Todos las regiones con recursos vigentes</h2></center>
</div>


<center>

  <div class="container">
    <!-- <div class="row col-md-10 col-md-offset-2 custyle"> -->

      <form align="center" action="lugares.php" method="post">
        <!-- <div class="row"> -->
          <!-- <a class="card text-white bg-success mb-2 col-md-2">Comuna</a><br><br> -->
          <!-- <a class="card text-white bg-success mb-2 col-md-2">Region</a><br><br> -->
        <!-- </div> -->
        <!-- <div class="row"> -->
          <!-- <select class="col-md-2" type="text" name="typeOfProyectToSearch" palceholder="Value To Search"> -->
            <!-- <option value=""></option> -->
            <!-- <option value="Central">Central</option> -->
            <!-- <option value="Minera">Minera</option> -->
            <!-- <option value="Vertedero">Vertedero</option> -->
            <!-- </select> -->

          <!-- <div class="col-md-2"> -->
            <!-- Desde: -->
             <!-- <input class="col-md-12 center" type="date" name="dateA" value="<?php #echo date('Y-m-d'); ?>" /> -->
             <!-- <br/> -->
             <!-- Hasta: -->
             <!-- <input class="col-md-12 center" type="date" name="dateB" value="<?php #echo date('Y-m-d'); ?>" /> -->
           <!-- </div> -->

        <!-- </div> -->

        <!-- <button class= "btn btn-success btn-m" type="submit" name="search" value="Filter">Filtrar</button><br><br> -->

        <div class="table-wrapper-scroll-y my-custom-scrollbar">
          <table class="table table-bordered table-striped mb-0">
            <thead>
            <tr>
              <th class="text-center">Region</th>
              <th class="text-center">Numero de recursos vigentes</th>

            </tr>
            </thead>
            <?php
            require("../../config/conexion_impar.php");
            $query = "SELECT region FROM lugares";
            $result = $db -> prepare($query);
            $result -> execute();
            $regiones = $result -> fetchALL();
            foreach ($regiones as $region){
              $query = "SELECT COUNT(region) FROM lugares NATURAL JOIN ryl NATURAL JOIN recursospendientes WHERE '".$region[0]."'=lugares.region";
              $result = $db -> prepare($query);
              $result -> execute();
              $cuenta = $result -> fetchALL();
              $cuenta = $cuenta[0];
              echo
              "<tr>
                  <td class = \"text-center\">$region[0]</td>
                  <td class = \"text-center\">$cuenta[0]</td>
                  </tr>";
              }
              ?>

          </table>
        </div>
      </form>


  </div>
</center>


<?php include('footer.html'); ?>
