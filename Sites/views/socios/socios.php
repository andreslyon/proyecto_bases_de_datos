<?php include('../../templates/header.html');   ?>

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
  <center><h2 class="room-name">Todos Los socios con recursos pendientes en sus proyectos</h2></center>
</div>


<center>

  <div class="container">
    <!-- <div class="row col-md-10 col-md-offset-2 custyle"> -->

      <form align="center" action="lugares.php.php" method="post">
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
              <th class="text-center">Nombre</th>
              <th class="text-center">Apellido</th>
              <th class="text-center">Proyectos</th>
              <th class="text-center">Recursos pendients</th>

            </tr>
            </thead>
            <?php
            require("../../config/conexion.php");
            $query = "SELECT socios.sid, socios.nombre, socios.apellido
                          FROM socios NATURAL JOIN pys NATURAL JOIN pyr
                          INNER JOIN recursospendientes
                          ON recursospendientes.rid=pyr.rid GROUP BY socios.sid";
            $result = $db -> prepare($query);
            $result -> execute();
            $socios = $result -> fetchALL();
            foreach ($socios as $socio){
                echo
                "<tr>
                    <td class = \"text-center\">$socio[1]</td>
                    <td class = \"text-center\">$socio[2]</td>";
                // $query = "SELECT COUNT(region) FROM lugares NATURAL JOIN ryl NATURAL JOIN recursospendientes WHERE '".$region[0]."'=lugares.region";
                // $result = $db -> prepare($query);
                // $result -> execute();
                // $cuenta = $result -> fetchALL();
                // $cuenta = $cuenta[0];
                echo
                    "<td class = \"text-center\"></td>
                    <td class = \"text-center\"></td>
                    </tr>";

                $query = "SELECT proyectos.nombre,COUNT(proyectos.nombre)  FROM socios NATURAL JOIN pys INNER JOIN proyectos ON pys.pid=proyectos.pid";
                $query = $query." INNER JOIN pyr ON pyr.pid=pys.pid INNER JOIN recursospendientes ON recursospendientes.rid=pyr.rid";
                $query = $query." WHERE ".$socio[0]."=socios.sid GROUP BY proyectos.nombre ORDER BY COUNT(proyectos.nombre) DESC";
                $result = $db -> prepare($query);
                $result -> execute();
                $pids = $result -> fetchALL();
                foreach ($pids as $pid){
                    // $query = "SELECT  proyectos.nombre, COUNT(pid)
                    //               FROM proyectos NATURAL JOIN pyr NATURAL JOIN recursospendientes
                    //                GROUP BY pid ORDER BY COUNT(pid) DESC";
                    // // $query = "SELECT proyectos.nombre, COUNT(pid) FROM socios NATURAL JOIN pys INNER JOIN proyectos ON pys.pid=proyectos.pid";
                    // // $query = $query." INNER JOIN pyr ON pyr.pid=pys.pid INNER JOIN recursospendientes ON recursospendientes.rid=pyr.rid";
                    // // $query = $query." WHERE '".$socio[0]."'=socios.sid AND ".$pid[0]."=pys.pid GROUP BY pid";
                    // $result = $db -> prepare($query);
                    // $result -> execute();
                    // $cuenta = $result -> fetchALL();
                    // $cuenta = $cuenta[0];

                      echo
                      "<tr>
                          <td class = \"text-center\"></td>
                          <td class = \"text-center\"></td>
                          <td class = \"text-center\">$pid[0]</td>
                          <td class = \"text-center\">$pid[1]</td>
                          </tr>";

                    }
                  echo
                  "<tr>
                      <td class = \"text-center\">-------------------------------------------</td>
                      <td class = \"text-center\">-------------------------------------------</td>
                      <td class = \"text-center\">-------------------------------------------</td>
                      <td class = \"text-center\">-------------------------------------------</td>
                      </tr>";
              }
              ?>

          </table>
        </div>
      </form>


  </div>
</center>


<?php include('footer.html'); ?>
