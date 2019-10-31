<?php include('../../templates/header.html');   ?>


  <body class="bg-image">
    <div class="container">
      <!-- Header -->

      <!-- Page Content -->
      <div class="container">
        <div class="row">

          <!-- <div class="col-xl-3 col-md-6 mb-4"> -->
            <!-- <div class="card border-0 shadow" onclick="window.location.href= 'aprobados.php'; "> -->
              <!-- <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRtnmZK0TEwSih1tj4gOffN-W5Y4vORsZCgh_jGLA5q_W3oEsne" class="card-img-top" alt="..."> -->
              <!-- <div class="card-body text-center"> -->
                <!-- <h5 class="card-title mb-0">Recursos Aprobados</h5> -->
                <!-- <div class="card-text text-black-50">Conoce los recursos</div> -->
              <!-- </div> -->
            <!-- </div> -->
          <!-- </div> -->

          <!-- <div class="col-xl-3 col-md-6 mb-4"> -->
            <!-- <div class="card border-0 shadow" onclick="window.location.href= 'rechazados.php'; "> -->
              <!-- <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSf9zVximP8a7Ph-dPYymzoFMnCnxGBKIvOYZzg4xJvUTVeCySA" class="card-img-top" alt="..."> -->
              <!-- <div class="card-body text-center"> -->
                <!-- <h5 class="card-title mb-0">Recursos Rechazados</h5> -->
                <!-- <div class="card-text text-black-50">Conoce los recursos</div> -->
              <!-- </div> -->
            <!-- </div> -->
          <!-- </div> -->

          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow" onclick="window.location.href= 'todos_los_recursos.php'; ">
              <img src="https://definicion.mx/wp-content/uploads/2014/04/recursos.jpg" class="card-img-top" alt="...">
              <div class="card-body text-center">
                <h5 class="card-title mb-0">Todos los Recursos</h5>
                <div class="card-text text-black-50">Conoce los recursos</div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow" onclick="window.location.href= 'pendientes.php'; ">
              <img src="https://previews.123rf.com/images/theerakit/theerakit1610/theerakit161000036/67643544-clock-icon-in-trendy-flat-style-time-symbol-for-your-web-design-logo-ui.jpg" class="card-img-top" alt="...">
              <div class="card-body text-center">
                <h5 class="card-title mb-0">Recursos en tramite</h5>
                <div class="card-text text-black-50">Conoce los recursos</div>
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
    <br><br>
    <form action="../pages/database_index.php" method="get">
        <input type="submit" value="Volver">
    </form>
    </body>

  </html>
