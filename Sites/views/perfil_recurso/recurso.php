<?php include('../../templates/header.php');   ?>

<?php

function consultar($query)
{
  require("../../config/conexion_impar.php");
  $result = $db -> prepare($query);
  $result -> execute();
  return $result;
}

$rid = $_GET["rid"];
$query_recursos = "(SELECT * FROM recursos where rid=".$rid.") as query_recursos";
$query = "SELECT * FROM ".$query_recursos;
$query = $query." NATURAL JOIN ryl";
$query = $query." NATURAL JOIN lugares";
$search_result = consultar($query) -> fetchALL();

$proy_result = consultar("SELECT pid, nombre
                          FROM (SELECT pid FROM pyr WHERE rid=$rid) as foo
                          NATURAL JOIN proyectos") -> fetchALL();
$pid = $proy_result[0]["pid"];
$proyecto = $proy_result[0]["nombre"];


$row = $search_result[0];
$rid = $row["rid"];
$nombre = $row["nombre"];
$numero = $row["numero"];
$status = $row["status"];
$causa = $row["causa_contaminante"];
$fecha = $row["fecha_apertura"];
$comuna = $row["comuna"];
$region = "Region ".$row["region"];

$area = $row["area_influencia_kms"];
$descripcion = $row["descripcion"];

$_SESSION["url_antes_de_login"] = "../perfil_recurso/recurso.php?rid=$rid";

?>

<style type="text/css">
  .bg-image {
    background-image: url("https://wallpaperaccess.com/full/253322.jpg");
    background-size: cover;
    background-position: center;
  }
  .emp-profile {
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    /* background: #fff; */
    <?php
    if($status == "aprobado")
    {
      echo 'background-image: url("https://live.staticflickr.com/3328/4615825551_d36ae5f896_b.jpg");';

    }
    if($status == "rechazado")
    {
      echo 'background-image: url("https://live.staticflickr.com/3328/4615825551_d36ae5f896_b.jpg");';

    }
    if($status == "en trámite")
    {
      echo 'background-image: url("https://live.staticflickr.com/3328/4615825551_d36ae5f896_b.jpg");';

    }
    ?>
    /* background-image: url("https://www.pixelstalk.net/wp-content/uploads/images1/Industrial-Backgrounds-HD-620x404.jpg"); */
    background-size: cover;
    background-position: center;

    align-items: center;
    align-self: center;
    align-content: center;
  }
  .room-name{
  background: rgba(225,150,75,1);
          }
</style>

<head>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->
</head>

<body class="bg-image">

  <?php include('../login/login.php');   ?>

  <div class="container emp-profile">

      <div class="col-md-4">
        <div class="text-center">
          <h2 class="room-name">
          <?php
          echo"Recurso $status";
          ?>
          </h2>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
            <div class="row col-md-12 custyle">
              <table class="table table-striped custab">
                <thead>
                <tr>
                  <th class="text-center"><strong>Numero:</strong></th>
      <?php echo "<th class='text-center'>$numero</th>" ?>
                </tr>
                </thead>
                <tr>
                    <td class="text-center"><strong>Contra:</strong></td>
        <?php echo "<td class='text-center'><a href='../perfil_proyecto/proyecto.php?pid=$pid'>$proyecto</td>" ?>
                </tr>
                <tr>
                    <td class = "text-center"><strong>Causa:</strong></td>
                    <td class = "text-center"><?php echo"$causa" ?></td>
                </tr>
                <tr>
                    <td class = "text-center"><strong>Ubicacion:</strong></td>
                    <td class = "text-center"><?php echo"$comuna, $region" ?></td>
                </tr>
                <tr>
                    <td class = "text-center"><strong>Fecha Apertura:</strong></td>
                    <td class = "text-center"><?php echo"$fecha" ?></td>
                </tr>
                <?php include("_template_dictamen_recurso.php"); ?>
              </table>
            </div>
          </div>
        </div>
        <!-- BOTONES -->
        <div class="row">
          <div class="col-md-4">
            <a class= "btn btn-info btn-xs"></a>
            VER
          </div>
          <!-- SI ES QUE ESTA CONECTADO -->
          <div class="col-md-4">
            <a class= "btn btn-warning btn-xs"></a>
            EDITAR
          </div>
          <div class="col-md-4">
            <a class= "btn btn-danger btn-xs"></a>
            ELIMINAR
          </div>
          <!-- HASTA AQUI EL ESTAR CONECTADO -->
        </div>
      </div>

      <div class="col-md-1" ></div>

      <div class="col-md-7">
        <div class="row">
          <div class="col-md-12">
            <div class="profile-head">

              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="descripcion-tab" data-toggle="tab" href="#descripcion" role="tab" aria-controls="profile" aria-selected="false">Descripcion</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" id="ongs-tab" data-toggle="tab" href="#ongs" role="tab" aria-controls="profile" aria-selected="false">ONGs Asociadas</a>
                </li>
              </ul>

            </div>
          </div>

        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="tab-content profile-tab" id="myTabContent">

              <!-- SI ES QE ESTA CONECTADO -->
              <!-- Eventos de la Sala -->
              <div class="tab-pane fade" id="descripcion" role="tabpanel" aria-labelledby="descripcion-tab">
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                  <!-- por cada evento y si esta vigente -->
                  <p style = "font-family:georgia,garamond,serif;font-size:25px;font-style:italic;">
                    <b><?php echo"$descripcion" ?></b>
                  </p>
                  <br>
                  <h2>Área comprometida: <?php echo"$area" ?>kms</h2>
                </div>
              </div>
              <!-- SI NO -->
                <!-- Debes estar conectado para ver los eventos -->
              <!-- HASTA AQUI EL CONDICIONAL -->

              <div class="tab-pane fade" id="ongs" role="tabpanel" aria-labelledby="ongs-tab">
                <!-- por cada evento y si esta vigente -->
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                  <!-- por cada evento y si esta vigente -->
                  <?php include("_template_ongs_recurso.php"); ?>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

    </div>


    <br><br>
    <div class = text-center>
      <form action="../navegacion/recursos.php" method="get">
          <input type="submit" value="Volver">
      </form>
    </div>

    </body>

  </html>
