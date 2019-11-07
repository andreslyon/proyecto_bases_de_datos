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
$todas_las_ongs = "
          SELECT *
          FROM (
                SELECT ongs.oid, grupo80.nombre, grupo80.pais, grupo80.descripcion
                FROM  ongs
                      INNER JOIN dblink('dbname=grupo80 user=grupo80 password=grupo80', 'SELECT nombre, pais, descripcion FROM ong') AS grupo80(nombre varchar(100), pais varchar(100), descripcion varchar(5000))
                      ON grupo80.nombre LIKE CONCAT(ongs.nombre, '_')
                UNION
                SELECT ongs.oid, grupo80.nombre, grupo80.pais, grupo80.descripcion
                FROM  ongs
                      NATURAL JOIN dblink('dbname=grupo80 user=grupo80 password=grupo80', 'SELECT nombre, pais, descripcion FROM ong') AS grupo80(nombre varchar(100), pais varchar(100), descripcion varchar(5000))
                ) AS Foo
          WHERE oid=$oid
          ";
// $query = $query." NATURAL JOIN pyl";
// $query = $query." NATURAL JOIN lugares";
$search_result = consultar($todas_las_ongs) -> fetchALL();

$result = $search_result[0];
// $oid = $result["oid"];
$nombre = $result["nombre"];
$pais = $result["pais"];
$desc = $result["descripcion"];

$_SESSION["current_page_url"] = "../perfil_ong/ong.php?oid=$oid";

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

  <?php include('../login/login.php');   ?>

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
                  <th class="text-center"><strong>Pais:</strong></th>
                  <th class="text-center"><?php echo"$pais"; ?></th>
                </tr>
                </thead>
                <?php include("_template_counts_ong.php"); ?>
                <tr>
                    <td class = "text-center"><strong>Marchas Organizadas:</strong></td>
                    <td class = "text-center"><?php echo"$marcha_count_result"; ?></td>
                </tr>
                <tr>
                    <td class = "text-center"><strong>Redes Sociales Organizadas:</strong></td>
                    <td class = "text-center"><?php echo"$red_count_result"; ?></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <!-- BOTONES -->
        <!-- <div class="row"> -->
          <!-- <div class="col-md-4"> -->
            <!-- <a class= "btn btn-info btn-xs"></a> -->
            <!-- VER -->
          <!-- </div> -->
          <!-- SI ES QUE ESTA CONECTADO -->
          <!-- <div class="col-md-4"> -->
            <!-- <a class= "btn btn-warning btn-xs"></a> -->
            <!-- EDITAR -->
          <!-- </div> -->
          <!-- <div class="col-md-4"> -->
            <!-- <a class= "btn btn-danger btn-xs"></a> -->
            <!-- ELIMINAR -->
          <!-- </div> -->
          <!-- HASTA AQUI EL ESTAR CONECTADO -->
        <!-- </div> -->
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
                  <a class="nav-link active" id="recursos-tab" data-toggle="tab" href="#recursos" role="tab" aria-controls="profile" aria-selected="false">Recursos Solicitados</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link active' id='marchas-tab' data-toggle='tab' href='#marchas' role='tab' aria-controls='profile' aria-selected='false'>Marchas</a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link active' id='red-tab' data-toggle='tab' href='#red' role='tab' aria-controls='profile' aria-selected='false'>Redes Sociales</a>
                </li>
                <?php
                if ($_SESSION["tipo_de_login"]=="ong" && $oid==$_SESSION["oid"])
                {echo"
                  <li class='nav-item'>
                    <a class='nav-link active' id='plan-tab' data-toggle='tab' href='#plan' role='tab' aria-controls='profile' aria-selected='false'>Planificar</a>
                  </li>";
                }
                ?>
              </ul>

            </div>
          </div>

        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="tab-content profile-tab" id="myTabContent">

              <div class="tab-pane fade" id="descripcion" role="tabpanel" aria-labelledby="descripcion-tab">
                <div class="table-wrapper-scroll-y my-custom-scrollbar">

                  <div class='row'>
                    <div class='well col-md-12' style='width:100px' >
                      <!-- por cada evento y si esta vigente -->
                      <p style = "font-family:georgia,garamond,serif;font-size:25px;font-style:italic;">
                        <b><?php echo"$desc" ?></b>
                      </p>
                    </div>
                  </div>

                </div>
              </div>
              <!-- SI ES QE ESTA CONECTADO -->
              <!-- Eventos de la Sala -->
              <div class="tab-pane fade" id="recursos" role="tabpanel" aria-labelledby="recursos-tab">
                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                  <!-- por cada evento y si esta vigente -->

                  <div class='row'>
                    <div class='well col-md-12' style="background:rgba(70%,70%,70%,0.9)">
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

                  <?php include("_template_recurso_ong.php"); ?>
                </div>
              </div>
              <!-- SI NO -->
                <!-- Debes estar conectado para ver los eventos -->
              <!-- HASTA AQUI EL CONDICIONAL -->
                <div class='tab-pane fade' id='marchas' role='tabpanel' aria-labelledby='marchas-tab'>
                  <!-- por cada evento y si esta vigente -->
                  <div class='table-wrapper-scroll-y my-custom-scrollbar'>
                    <!-- por cada evento y si esta vigente -->
                    <div class='row'>
                      <div class='well col-md-12' style="background:rgba(70%,70%,70%,0.9)">
                        <div class='col-md-3'>
                          <label>Marcha</label>
                        </div>
                        <div class='col-md-3'>
                          <label>Fecha</label>
                        </div>
                        <div class='col-md-3'>
                          <label>Lugar de reunion</label>
                        </div>
                        <div class='col-md-3'>
                          <label>Presupuesto</label>
                        </div>
                      </div>
                    </div>

                    <?php include("_template_marcha_ong.php"); ?>

                  </div>
                </div>
                <div class='tab-pane fade' id='red' role='tabpanel' aria-labelledby='red-tab'>
                  <!-- por cada evento y si esta vigente -->
                  <div class='table-wrapper-scroll-y my-custom-scrollbar'>
                    <!-- por cada evento y si esta vigente -->
                    <div class='row'>
                      <div class='well col-md-12' style="background:rgba(70%,70%,70%,0.9)">
                        <div class='col-md-3'>
                          <label>Red Social</label>
                        </div>
                        <div class='col-md-3'>
                          <label>Fecha</label>
                        </div>
                        <div class='col-md-3'>
                          <label>Tipo de contenido</label>
                        </div>
                        <div class='col-md-3'>
                          <label>Presupuesto</label>
                        </div>
                      </div>
                    </div>

                    <?php include("_template_red_social_ong.php"); ?>
                </div>
              </div>
              <?php
              if ($_SESSION["tipo_de_login"]=="ong" && $oid==$_SESSION["oid"])
              {echo"
                <div class='tab-pane fade' id='plan' role='tabpanel' aria-labelledby='plan-tab'>
                  <!-- por cada evento y si esta vigente -->";
                  include("_template_planificacion_automatica.php");
                echo
                "</div>";
              }
              ?>

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
