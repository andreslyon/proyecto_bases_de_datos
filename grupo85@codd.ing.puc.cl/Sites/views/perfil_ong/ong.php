<?php include('../../templates/header.php');   ?>

<?php

function consultar($query)
{
  require("../../config/conexion_impar.php");
  $result = $db -> prepare($query);
  $result -> execute();
  return $result;
}

$oid = $_GET["oid"];
$query_ong = "(SELECT * FROM ongs where oid=".$oid.") as query_ong";
$query = "SELECT * FROM ".$query_ong;
// $query = $query." NATURAL JOIN pyl";
// $query = $query." NATURAL JOIN lugares";
$search_result = consultar($query) -> fetchALL();

$result = $search_result[0];
$oid = $result["oid"];
$nombre = $result["nombre"];

?>

<style type="text/css">
  .bg-image {
    background-image: url("https://images.pexels.com/photos/1325866/pexels-photo-1325866.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940");
    background-size: cover;
    background-position: center;
  }
  .emp-profile {
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    /* background: #fff; */
    background-image: url("https://previews.123rf.com/images/aruba2000/aruba20001510/aruba2000151000470/46269903-vecchio-cartellone-con-strappato-manifesti-e-annunci-della-priorità-bassa-del-primo-piano.jpg");
    background-size: cover;
    background-position: center;

    align-items: center;
    align-self: center;
    align-content: center;
  }
  .room-name{
  background: rgba(225,225,225,1);
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
  <div class="container emp-profile">

      <div class="col-md-4">
        <div class="text-center">
          <h2 class="room-name">
          <?php
          echo"$nombre"; ?>
          </h2>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
            <div class="row col-md-12 custyle">
              <table class="table table-striped custab">
                <thead>
                <tr>
                  <th class="text-center"><strong>algo1:</strong></th>
                  <th class="text-center">valor1</th>
                </tr>
                </thead>
                <tr>
                    <td class = "text-center"><strong>algo2:</strong></td>
                    <td class = "text-center">valor2</td>
                </tr>
                <tr>
                    <td class = "text-center"><strong>algo3:</strong></td>
                    <td class = "text-center">valor3</td>
                </tr>
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
                  <a class="nav-link active" id="recursos-tab" data-toggle="tab" href="#recursos" role="tab" aria-controls="profile" aria-selected="false">Recursos asociados</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" id="movilizaciones-tab" data-toggle="tab" href="#movilizaciones" role="tab" aria-controls="profile" aria-selected="false">Movilizaciones organizadas</a>
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
              <div class="tab-pane fade" id="recursos" role="tabpanel" aria-labelledby="recursos-tab">
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                  <!-- por cada evento y si esta vigente -->
                  <?php include("_template_recurso_ong.php"); ?>
                </div>
              </div>
              <!-- SI NO -->
                <!-- Debes estar conectado para ver los eventos -->
              <!-- HASTA AQUI EL CONDICIONAL -->

              <div class="tab-pane fade" id="movilizaciones" role="tabpanel" aria-labelledby="movilizaciones-tab">
                <!-- por cada evento y si esta vigente -->
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                  <!-- por cada evento y si esta vigente -->
                  AQUI LAS MOVILIZACIONES
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

    </div>


  <br><br>
  <div class = text-center>
    <form action="../navegacion/ongs.php" method="get">
        <input type="submit" value="Volver">
    </form>
  </div>

  </body>

</html>
