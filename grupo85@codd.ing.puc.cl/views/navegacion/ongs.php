<?php include('../../templates/header.html');   ?>

<?php
if(isset($_GET["search"]))
{
  $nameToSearch = $_GET["nameToSearch"];

  $query = "SELECT * FROM ongs";
  $query = $query." WHERE nombre LIKE '%".$nameToSearch."%'";

  $search_result = filterTable($query) -> fetchALL();
}
else {
  $query = "SELECT * FROM ongs";
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

<?php include('../../templates/barra_nav.php');   ?>

<div class= "h1">
  <center><h2 class="room-name">ONGs</h2></center>
</div>

<center>

  <div class="container">
    <!-- <div class="row col-md-10 col-md-offset-2 custyle"> -->

      <form align="center" action="ongs.php" method="get">
        <div class="row">
          <a class="card text-white bg-success mb-2 col-md-2">Nombre</a><br><br>
        </div>
        <div class="row">
          <input style="height:30px" class="col-md-2" type="text" name="nameToSearch" palceholder="Value To Search"><br><br>
        </div>

        <button class= "btn btn-success btn-m" type="submit" name="search" value="Filter">Filtrar</button><br><br>

        <div class="table-wrapper-scroll-y my-custom-scrollbar">
          <table class="table table-bordered table-striped mb-0">
            <thead>
            <tr>
              <th class="text-center">Nombre</th>
              <th class="text-center">Algo1</th>
              <th class="text-center">Algo2</th>
              <th class="text-center">Algo3</th>
            </tr>
            </thead>


            <?php foreach ($search_result as $row){
              echo
              "<tr>
                  <td class = \"text-center\"><a href=../perfil_ong/ong.php?oid=$row[0]>$row[1]</a></td>
                  <td class = \"text-center\">Valor1</td>
                  <td class = \"text-center\">Valor2</td>
                  <td class = \"text-center\">Valor3</td>
                </tr>";
              }
              ?>

          </table>
        </div>
      </form>


  </div>
</center>



<br><br>
<form action="../pages/navegacion_index.php" method="get">
    <input type="submit" value="Volver">
</form>
</body>

</html>
