<?php include('../../templates/header.php');   ?>


  <body class="bg-image">
    <div class="container">
      <!-- Header -->

      <!-- Page Content -->
      <div class="container">
        <div class="row">

          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow" onclick="window.location.href= 'centrales.php'; ">
              <img src="https://previews.123rf.com/images/ahasoft2000/ahasoft20001611/ahasoft2000161102935/66421411-electricity-symbol-rubber-seal-stamp-watermark-icon-symbol-inside-circle-frame-with-grunge-design-an.jpg" class="card-img-top" alt="...">
              <div class="card-body text-center">
                <h5 class="card-title mb-0">Centrales Electricas</h5>
                <div class="card-text text-black-50">Conoce los proyectos</div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow" onclick="window.location.href= 'mineras.php'; ">
              <img src="http://iminco.net/wp-content/uploads/2017/11/Quarry-Mine-Maintenance-768x512.jpg" class="card-img-top" alt="...">
              <div class="card-body text-center">
                <h5 class="card-title mb-0">Mineras</h5>
                <div class="card-text text-black-50">Conoce los proyectos</div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow" onclick="window.location.href= 'vertederos.php'; ">
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSd46pOHDHr8x0uufl23yU_xklioVmAqcn9oCyxLrSj-nobHX6j" class="card-img-top" alt="...">
              <div class="card-body text-center">
                <h5 class="card-title mb-0">Vertederos</h5>
                <div class="card-text text-black-50">Conoce los proyectos</div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow" onclick="window.location.href= 'clandestinos.php'; ">
              <img src="https://blackphoenixalchemylab.com/wp-content/uploads/2012/12/Jolly-Roger.jpg" class="card-img-top" alt="...">
              <div class="card-body text-center">
                <h5 class="card-title mb-0">Proyectos Clandestinos</h5>
                <div class="card-text text-black-50">Conoce los proyectos</div>
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
