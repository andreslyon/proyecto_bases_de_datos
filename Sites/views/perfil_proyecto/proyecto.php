<?php include('../../templates/header.php');   ?>

<?php
function es_socio($sid, $pid)
{
  $todos_los_socios = " SELECT sid, pid
                        FROM pys
                        WHERE sid='$sid' AND pid='$pid'";
  $result = consultar($todos_los_socios) -> fetchALL();
  $result = $result[0];
  if ($result["sid"]=="")
  {
    return False;
  }
  else
  {
    return True;
  }
}

function consultar($query)
{
  require("../../config/conexion_impar.php");
  $result = $db -> prepare($query);
  $result -> execute();
  return $result;
}

$pid = $_GET["pid"];
$query_proyecto = "(SELECT * FROM proyectos where pid=".$pid.") as query_proyecto";
$query = "SELECT * FROM ".$query_proyecto;
$query = $query." NATURAL JOIN pyl";
$query = $query." NATURAL JOIN lugares";
$search_result = consultar($query) -> fetchALL();
foreach ($search_result as $row)
{
  $pid = $row[1];
  $nombre = $row[2];
  $tipo = $row[3];
  $lat = $row[4];
  $long = $row[5];
  $operativo = $row[6];
  $fecha = $row[7];
  $comuna = $row[8];
  $region = "Region ".$row[9];
}

$_SESSION["current_page_url"] = "../perfil_proyecto/proyecto.php?pid=$pid";

?>

<style type="text/css">
  .bg-image {
    background-image: url("http://www.dessica.fr/wp-content/uploads/2016/06/corrosion.png");
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
    if($tipo == "Vertedero")
    {
      echo 'background-image: url("https://cdn.pixabay.com/photo/2017/09/08/18/20/garbage-2729608__340.jpg");';

    }
    if($tipo == "Central")
    {
      echo 'background-image: url("https://images6.alphacoders.com/932/932622.jpg");';

    }
    if($tipo == "Minera")
    {
      echo 'background-image: url("https://img5.goodfon.com/original/1920x1080/0/11/trucks-mining-mine.jpg");';

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
  background: rgba(200,100,50,1);
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

  <div class="container emp-profile" style="border-radius:25px;height:500px;">

      <div class="col-md-4">
        <div class="text-center">
          <h2 class="room-name">
          <?php
          echo"$nombre";
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
                  <th class="text-center"><strong>Tipo:</strong></th>
                  <th class="text-center"><?php echo"$tipo" ?></th>
                </tr>
                </thead>
                <?php include("_template_tipo_proyecto.php"); ?>
                <tr>
                    <td class = "text-center"><strong>Ubicacion:</strong></td>
                    <td class = "text-center"><?php echo"$comuna, $region" ?></td>
                </tr>
                <tr>
                    <td class = "text-center"><strong>Geolocalizacion:</strong></td>
                    <td class = "text-center"><?php echo"$lat, $long" ?></td>
                </tr>
                <tr>
                    <td class = "text-center"><strong>Fecha de Apertura:</strong></td>
                    <td class = "text-center"><?php echo"$fecha" ?></td>
                </tr>
                <tr>
                    <td class = "text-center"><strong>Operativo:</strong></td>
                    <td class = "text-center"><?php echo"$operativo" ?></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <!-- BOTONES -->
        <div class='row'>
        <?php
        if ($_SESSION["tipo_de_login"]=="socio")
        {
          if (!es_socio($_SESSION["sid"], $pid))
          {
          echo
            "<form style='margin-left:30%' action='_template_asociarse.php' method='post'>
              <div class='btn' style='background:rgba(0,0,0,0.7);border-radius:25px'>
                <a class= 'btn btn-info btn-xs' style='margin-bottom:5px;padding:3px 8px;'></a>
                <input type='hidden' name='accion' value='asociarse'>
                <button style='color:#eee;font-size:18px;background:rgba(255,255,255,0);' type='submit' name='pid' value='$pid'>
                <b>Asociarse</b>
                </button>
              </div>
            </form>";
          }
          else
          {
            echo
              "<form class='col-6' action='_template_asociarse.php' method='post'>
                <div class='btn' style='background:rgba(0,0,0,0.7);border-radius:25px'>
                  <a class= 'btn btn-warning btn-xs' style='margin-bottom:5px;padding:3px 8px;'></a>
                  <input type='hidden' name='accion' value='desasociarse'>
                  <button style='color:#eee;font-size:18px;background:rgba(255,255,255,0);' type='submit' name='pid' value='$pid'>
                  <b>Desasociarse</b>
                  </button>
                </div>
              </form>
              <form class='col-6' action='_template_eliminar_proyecto.php' method='post'>
                <div class='btn' style='background:rgba(0,0,0,0.7);border-radius:25px'>
                  <a class= 'btn btn-danger btn-xs' style='margin-bottom:5px;padding:3px 8px;'></a>
                  <input type='hidden' name='accion' value='desasociarse'>
                  <button style='color:#eee;font-size:18px;background:rgba(255,255,255,0);' type='submit' name='pid' value='$pid'>
                  <b>Eliminar</b>
                  </button>
                </div>
              </form>";
          }
        }
          ?>
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
                  <a class="nav-link active" id="recursos-tab" data-toggle="tab" href="#recursos" role="tab" aria-controls="profile" aria-selected="false">Recursos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" id="socios-tab" data-toggle="tab" href="#socios" role="tab" aria-controls="profile" aria-selected="false">Socios</a>
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
                  <div class='row'>
                    <div class='well col-md-12' style="background:rgba(225,150,75,0.9)">
                      <div class='col-md-3'>
                        <label>Numero</label>
                      </div>
                      <div class='col-md-3'>
                        <label>Causa</label>
                      </div>
                      <div class='col-md-3'>
                        <label>Status</label>
                      </div>
                      <div class='col-md-3'>
                        <label></label>
                      </div>
                    </div>
                  </div>

                  <?php include("_template_recurso_proyecto.php"); ?>
                </div>
              </div>
              <!-- SI NO -->
                <!-- Debes estar conectado para ver los eventos -->
              <!-- HASTA AQUI EL CONDICIONAL -->

              <div class="tab-pane fade" id="socios" role="tabpanel" aria-labelledby="socios-tab">
                <!-- por cada evento y si esta vigente -->
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                  <!-- por cada evento y si esta vigente -->
                  <div class='row'>
                    <div class='well col-md-12' style="background:rgba(225,150,75,0.9)">
                      <div class='col-md-12'>
                        <label>Nombre Completo</label>
                      </div>
                    </div>
                  </div>

                  <?php include("_template_socios_proyecto.php"); ?>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

    </div>
  <br>

  <div class = text-center>
    <form action="../navegacion/proyectos.php" method="get">
        <input type="submit" value="Volver">
    </form>
  </div>

  </body>

</html>
