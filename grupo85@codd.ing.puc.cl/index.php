<?php include('templates/header.html');   ?>
  <body class="bg-image">
    <div class="container">
      <!-- Header -->


      <?php include('templates/barra_nav_home.php');   ?>

      <!-- Page Content -->
      <div class="container">
        <div class="row">

          <div style="height:300px;width:300px" class="col-xl-4 col-md-6 mb-4">
            <div class="card border-0 shadow" onclick="window.location.href= 'views/pages/navegacion_index.php'; ">
              <img src="http://www.clker.com/cliparts/A/Y/V/4/E/c/navigation-logo-hi.png" class="card-img-top" alt="...">
              <div class="card-body text-center">
                <h5 class="card-title mb-0">Navega ONGs y proyectos</h5>
                <div class="card-text text-black-50">Ten acceso a todos sus nombres.</div>
              </div>
            </div>
          </div>

          <div style="height:300px;width:300px" class="col-xl-4 col-md-6 mb-4">
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
