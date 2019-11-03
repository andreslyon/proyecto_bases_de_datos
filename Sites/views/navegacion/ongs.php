<?php include('../../templates/header.php');   ?>

<?php
if(isset($_GET["search"]))
{
  $nameToSearch = $_GET["nameToSearch"];

  $query = "
            SELECT *
            FROM (
                  SELECT ongs.oid, grupo80.nombre, grupo80.pais
                  FROM  ongs
                        INNER JOIN dblink('dbname=grupo80 user=grupo80 password=grupo80', 'SELECT nombre, pais FROM ong') AS grupo80(nombre varchar(100), pais varchar(100))
                        ON grupo80.nombre LIKE CONCAT(ongs.nombre, '_')
                  UNION
                  SELECT ongs.oid, grupo80.nombre, grupo80.pais
                  FROM  ongs
                        NATURAL JOIN dblink('dbname=grupo80 user=grupo80 password=grupo80', 'SELECT nombre, pais FROM ong') AS grupo80(nombre varchar(100), pais varchar(100))
                  ) AS Foo
            WHERE nombre LIKE '%$nameToSearch%'
            ORDER BY pais
          ";

  $search_result = filterTable($query) -> fetchALL();
}
else {
  $query = "
            SELECT ongs.oid, grupo80.nombre, grupo80.pais
            FROM  ongs
                  INNER JOIN dblink('dbname=grupo80 user=grupo80 password=grupo80', 'SELECT nombre, pais FROM ong') AS grupo80(nombre varchar(100), pais varchar(100))
                  ON grupo80.nombre LIKE CONCAT(ongs.nombre, '_')
            UNION
            SELECT ongs.oid, grupo80.nombre, grupo80.pais
            FROM  ongs
                  NATURAL JOIN dblink('dbname=grupo80 user=grupo80 password=grupo80', 'SELECT nombre, pais FROM ong') AS grupo80(nombre varchar(100), pais varchar(100))
            ORDER BY pais
          ";
  // $query = "SELECT ongs.oid, result.nombre FROM ongs INNER JOIN dblink('grupo80', 'SELECT nombre FROM ong') as result(nombre varchar(100)) ON result.nombre LIKE CONCAT(ongs.nombre, '_')";
  $search_result = filterTable($query) -> fetchALL();
  // $query = $query." UNION SELECT ongs.oid, result.nombre FROM ongs NATURAL JOIN dblink('grupo80', 'SELECT nombre FROM ong') as result(nombre varchar(100))";

  // $search_result = filterTable($query) -> fetchALL();
}

function filterTable($query)
{
  require("../../config/conexion_impar.php");
  $result = $db -> prepare($query);
	$result -> execute();
  return $result;
}

$_SESSION["url_antes_de_login"] = "../navegacion/ongs.php";

?>



<body class="bg-image">

<?php include('../login/login.php');   ?>

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
              <th class="text-center">Pais</th>
            </tr>
            </thead>


            <?php foreach ($search_result as $row){
              $s_oid = $row["oid"];
              $s_nombre = $row["nombre"];
              $s_pais = $row["pais"];
              echo
              "<tr>
                  <td class = \"text-center\"><a href=../perfil_ong/ong.php?oid=$s_oid>$s_nombre</a></td>
                  <td class = \"text-center\">$s_pais</td>
                </tr>";
              }
              ?>

          </table>
        </div>
      </form>


  </div>
</center>



<?php include('../../templates/footer.html');   ?>
