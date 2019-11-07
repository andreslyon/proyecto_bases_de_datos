<?php
$todos_los_lugares = "SELECT lid, comuna, region
                      FROM lugares
                      ORDER BY region, comuna";

$lugares = consultar($todos_los_lugares) -> fetchALL();
?>

<style>
  .form-gradient .header {
    border-top-left-radius: .3rem;
    border-top-right-radius: .3rem;
  }
  .form-gradient input[type=text]:focus:not([readonly]) {
    border-bottom: 1px solid #fd9267;
    box-shadow: 0 1px 0 0 #fd9267;
  }
  .form-gradient input[type=text]:focus:not([readonly]) + label {
    color: #4f4f4f;
  }
  .form-gradient textarea.md-textarea:focus:not([readonly]) {
    border-bottom: 1px solid #fd9267;
    box-shadow: 0 1px 0 0 #fd9267;
  }
  .form-gradient .md-form textarea.md-textarea:focus:not([readonly])+label {
    color: #4f4f4f;
  }


  .form-dark .md-form label {
    color: #fff;
  }
  .form-dark input[type=text]:focus:not([readonly]) {
    border-bottom: 1px solid #00C851;
    -webkit-box-shadow: 0 1px 0 0 #00C851;
    box-shadow: 0 1px 0 0 #00C851;
  }
  .form-dark input[type=text]:focus:not([readonly]) + label {
    color: #fff;
  }
  .form-dark textarea.md-textarea:focus:not([readonly]) {
    border-bottom: 1px solid #00C851;
    box-shadow: 0 1px 0 0 #00C851;
    color: #fff;
  }
  .form-dark textarea.md-textarea  {
    color: #fff;
  }
  .form-dark .form-control, .form-dark .form-control:focus {
    color: #fff;
  }
  .form-dark .md-form textarea.md-textarea:focus:not([readonly])+label {
    color: #fff;
  }
</style>

<form class="form-gradient mb-5" action="_planificacion_automatica.php" method="POST">

  <!--Form with header-->
  <div class="card">

    <!--Header-->
    <div class="header peach-gradient">

      <div class="row d-flex justify-content-center">
        <h3 class="white-text mb-0 py-5 font-weight-bold">Planificacion Automatica</h3>
      </div>

    </div>
    <!--Header-->

    <div class="card-body mx-4">

      <div class="md-form">
        <select name='lid' id='form104' type='text' class='form-control' style="height: 39px;">
        <?php
        foreach ($lugares as $lugar)
        {
          $opt_lid = $lugar["lid"];
          $opt_comuna = $lugar["comuna"];
          $opt_region = $lugar["region"];
          echo  "<option value='$opt_lid' >$opt_region - $opt_comuna</option>
                  ";
        }
        ?>
        </select>
        <label for="form104">Elige una comuna</label>
      </div>

      <div class="md-form">
        <input name="presupuesto" type="number" id="form105" class="form-control">
        <label for="form105">Inserta el presupuesto total</label>
      </div>

      <!--Grid row-->
      <div class="row d-flex align-items-center mb-3 mt-4">

        <!--Grid column-->
        <div class="col-md-12">
          <div class="text-center">
            <button type="submit" class="btn btn-grey btn-rounded z-depth-1a">Planificar</button>
          </div>
        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->
    </div>

  </div>
  <!--/Form with header-->

</form>
