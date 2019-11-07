<?php
include('templates/header.php');
$_SESSION["current_page_url"] = "../../index.php";
?>
  <body class="bg-image">
    <?php include('views/login/login_from_index.php');   ?>
    <div class="container">
      <!-- Header -->

      <?php include('templates/barra_nav_home.php');   ?>

      <!-- Page Content -->
      <div class="container">
        <div class="row">

          <div class="col-xl-3 col-md-3 mb-4">
            <div class="card border-0 shadow" onclick="window.location.href= 'views/navegacion/proyectos.php'; ">
              <img src="http://www.supergenple.net/images/belchatow.jpg" class="card-img-top" alt="...">
              <div class="card-body text-center">
                <h5 class="card-title mb-0">Proyectos</h5>
                <div class="card-text text-black-50">Conoce los proyectos</div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-md-3 mb-4">
            <div class="card border-0 shadow" onclick="window.location.href= 'views/navegacion/ongs.php'; ">
              <img src="http://www.falco.lk/wp-content/uploads/2018/04/Falco-green.png" class="card-img-top" alt="...">
              <div class="card-body text-center">
                <h5 class="card-title mb-0">ONGs</h5>
                <div class="card-text text-black-50">Conoce las ONG</div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-md-3 mb-4">
            <div class="card border-0 shadow" onclick="window.location.href= 'views/navegacion/recursos.php'; ">
              <img src="http://www.easywallprints.com/upload/designs/library-background-small-1.jpg" class="card-img-top" alt="...">
              <div class="card-body text-center">
                <h5 class="card-title mb-0">Recursos</h5>
                <div class="card-text text-black-50">Conoce los Recursos</div>
              </div>
            </div>
          </div>
          <!-- <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-0 shadow" onclick="window.location.href= 'views/pages/navegacion_index.php'; ">
              <img src="http://www.clker.com/cliparts/A/Y/V/4/E/c/navigation-logo-hi.png" class="card-img-top" alt="...">
              <div class="card-body text-center">
                <h5 class="card-title mb-0">Navega ONGs y proyectos</h5>
                <div class="card-text text-black-50">Ten acceso a todos sus nombres.</div>
              </div>
            </div>
          </div> -->

          <div class="col-xl-3 col-md-3 mb-4">
            <div class="card border-0 shadow" onclick="window.location.href= 'views/pages/database_index.php'; ">
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTO0NbFzoNx8RQNTMlUIw-DaU92SrQWjEeEpgH66yra0BDoGcjF" class="card-img-top" alt="...">
              <div class="card-body text-center">
                <h5 class="card-title mb-0">Base de Datos</h5>
                <div class="card-text text-black-50">Explora nuestra base de datos</div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- /.container -->
    </div>


    <br>
    <br>
    <br>
    <br>
  </body>
</html>
