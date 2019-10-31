<?php include('../../templates/header.html');   ?>

<?php
if(isset($_GET["search"]))
{
  $nameToSearch = $_GET["nameToSearch"];
  $causaToSearch = $_GET["causaToSearch"];
  if ($nameToSearch!=""||$causaToSearch!="")
  {
    $query = "
              SELECT *
              FROM recursos
              WHERE nombre LIKE '%".$nameToSearch."%'
              AND causa_contaminante LIKE '%".$causaToSearch."%'
              ORDER BY nombre
              ";
    // $query = $query." WHERE nombre LIKE '%".$nameToSearch."%'";
    // $query = $query." AND causa_contaminante LIKE '%".$causaToSearch."%'";
    // $query = $query." ORDER BY nombre";
  }
  $search_result = filterTable($query) -> fetchALL();
}
else {
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
  <center><h2 class="room-name">Recursos</h2></center>
</div>

<?php

if(!isset($_GET['search']))
{
  echo "
  <div class='container' align='center' >
    <div class='alert alert-dismissible alert-info'>
      <button type='button' class='close' data-dismiss='alert'>&times;</button>
      Aplica un filtro para mostrar los recursos.
    </div>
  </div>";
}
?>
<center>

  <div class="container">
    <!-- <div class="row col-md-10 col-md-offset-2 custyle"> -->

      <form align="center" action="recursos.php" method="get">
        <div class="row">
          <a class="card text-white bg-success mb-2 col-md-2">Proyecto en contra</a><br><br>
          <a class="card text-white bg-success mb-2 col-md-2">Causa</a><br><br>
        </div>
        <div class="row">
          <input style="height:30px" class="col-md-2" type="text" name="nameToSearch" palceholder="Value To Search"><br><br>
          <select style="height:30px" class="col-md-2" type="text" name="causaToSearch" palceholder="Value To Search">
            <option value=""></option>
            <?php
            require("../../config/conexion_impar.php");
            $selection_results = filterTable("SELECT causa_contaminante
                                              FROM recursos GROUP BY causa_contaminante
                                              ORDER BY causa_contaminante") -> fetchALL();
            foreach ($selection_results as $row){
              echo  "<option value=\"$row[0]\">$row[0]</option>";
            }

            ?>
            </select>
        </div>

        <button class= "btn btn-success btn-m" type="submit" name="search" value="Filter">Filtrar</button><br><br>

        <div class="table-wrapper-scroll-y my-custom-scrollbar">
          <table class="table table-bordered table-striped mb-0">
            <thead>
            <tr>
              <th class="text-center">Nombre</th>
              <th class="text-center">Número</th>
              <th class="text-center">Causa</th>
              <th class="text-center">Status</th>
            </tr>
            </thead>


            <?php foreach ($search_result as $row){
              echo
              "<tr>
                  <td class = \"text-center\"><a href=../perfil_recurso/recurso.php?rid=$row[0]>$row[2]</a></td>
                  <td class = \"text-center\">$row[1]</td>
                  <td class = \"text-center\">$row[3]</td>
                  <td class = \"text-center\">$row[7]</td>
                </tr>";
              }
              ?>

          </table>
        </div>
      </form>


  </div>
</center>



<?php include('../../templates/footer.html');   ?>
