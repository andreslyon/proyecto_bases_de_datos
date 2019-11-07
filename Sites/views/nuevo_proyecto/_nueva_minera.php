<?php
function redirect($url)
{
  header("Location: $url");
  exit;
}
function consultar($query)
{
  require("../../config/conexion_impar.php");
  $result = $db -> prepare($query);
  $result -> execute();
  return $result;
}

session_start();

$todas_los_minerales = "SELECT mid, nombre
                      FROM minerales
                      ORDER BY nombre";

$minerales = consultar($todas_los_minerales) -> fetchALL();



?>

<style>
  body{
  margin:0;
  color:#6a6f8c;
  background:#c8c8c8;
  font:600 16px/18px 'Open Sans',sans-serif;
  }
  *,:after,:before{box-sizing:border-box}
  .clearfix:after,.clearfix:before{content:'';display:table}
  .clearfix:after{clear:both;display:block}
  a{color:inherit;text-decoration:none}

  .login-wrap{
  width:100%;
  margin:auto;
  max-width:525px;
  min-height:670px;
  position:relative;
  background:url(https://thumbor.forbes.com/thumbor/960x0/https%3A%2F%2Fspecials-images.forbesimg.com%2Fdam%2Fimageserve%2F38984058%2F960x0.jpg%3Ffit%3Dscale) no-repeat center;
  box-shadow:0 12px 15px 0 rgba(0,0,0,.24),0 17px 50px 0 rgba(0,0,0,.19);
  }
  .login-html{
  width:100%;
  height:100%;
  position:absolute;
  padding:90px 70px 50px 70px;
  background:rgba(40,57,101,.9);
  }
  .login-html .sign-in-htm,
  .login-html .sign-up-htm{
  top:0;
  left:0;
  right:0;
  bottom:0;
  position:absolute;
  transform:rotateY(180deg);
  backface-visibility:hidden;
  transition:all .4s linear;
  }
  .login-html .sign-in,
  .login-html .sign-up,
  .login-form .group .check{
  display:none;
  }
  .login-html .tab,
  .login-form .group .label,
  .login-form .group .button{
  text-transform:uppercase;
  }
  .login-html .tab{
  font-size:22px;
  margin-right:15px;
  padding-bottom:5px;
  margin:0 15px 10px 0;
  display:inline-block;
  border-bottom:2px solid transparent;
  }
  .login-html .sign-in:checked + .tab,
  .login-html .sign-up:checked + .tab{
  color:#fff;
  border-color:#1161ee;
  }
  .login-form{
  min-height:345px;
  position:relative;
  perspective:1000px;
  transform-style:preserve-3d;
  }
  .login-form .group{
  margin-bottom:15px;
  }
  .login-form .group .label,
  .login-form .group .input,
  .login-form .group .button{
  width:100%;
  color:#fff;
  display:block;
  }
  .login-form .group .input,
  .login-form .group .button{
  border:none;
  padding:15px 20px;
  border-radius:25px;
  background:rgba(255,255,255,.1);
  }
  .login-form .group input[data-type="password"]{
  text-security:circle;
  -webkit-text-security:circle;
  }
  .login-form .group .label{
  color:#aaa;
  font-size:12px;
  }
  .login-form .group .button{
  background:#1161ee;
  }
  .login-form .group label .icon{
  width:15px;
  height:15px;
  border-radius:2px;
  position:relative;
  display:inline-block;
  background:rgba(255,255,255,.1);
  }
  .login-form .group label .icon:before,
  .login-form .group label .icon:after{
  content:'';
  width:10px;
  height:2px;
  background:#fff;
  position:absolute;
  transition:all .2s ease-in-out 0s;
  }
  .login-form .group label .icon:before{
  left:3px;
  width:5px;
  bottom:6px;
  transform:scale(0) rotate(0);
  }
  .login-form .group label .icon:after{
  top:6px;
  right:0;
  transform:scale(0) rotate(0);
  }
  .login-form .group .check:checked + label{
  color:#fff;
  }
  .login-form .group .check:checked + label .icon{
  background:#1161ee;
  }
  .login-form .group .check:checked + label .icon:before{
  transform:scale(1) rotate(45deg);
  }
  .login-form .group .check:checked + label .icon:after{
  transform:scale(1) rotate(-45deg);
  }
  .login-html .sign-in:checked + .tab + .sign-up + .tab + .login-form .sign-in-htm{
  transform:rotate(0);
  }
  .login-html .sign-up:checked + .tab + .login-form .sign-up-htm{
  transform:rotate(0);
  }

  .hr{
  height:2px;
  margin:60px 0 50px 0;
  background:rgba(255,255,255,.2);
  }
  .foot-lnk{
  text-align:center;
  }
  .custom_volver{
    padding:10px 60px;
    font-size:15px;
    background:rgb(10,10,100);
    color:rgb(255,255,255);
    border-radius:20px;
  }
  .my-custom-scrollbar {
  position: relative;
  height: 300px;
  overflow: auto;
  }
</style>

<body>
  <form class="login-wrap" action="_agregar_minera.php" method="POST">
  	<div class="login-html">
      <label  for='user' class='label' style="font-size:25px;color:rgb(255,255,255)">Nueva Central</label>
      <hr>
      <?php
      if (isset($_SESSION["crear_proyecto_err"]))
      {
        $err = $_SESSION["crear_proyecto_err"];
        echo"
        <div style='color:rgb(255,100,100)' class='invalid-feedback'>Error al crear proyecto, $err.</div>
            ";
      }
      ?>
      <br><br>
  		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Detalles</label>
      <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>

      <div class="login-form">
        <?php
        if ($_SESSION["tipo_de_login"]=="socio")
        {
          if (!isset($_SESSION["crear_proyecto_err"]))
          {
            echo"
            <div class='sign-in-htm'>
              <div class='group'>
                <label for='pass' class='label'>Minerales que extrae:</label>
                  <div class='table-wrapper-scroll-y my-custom-scrollbar'>";
                    foreach ($minerales as $mineral)
                    {
                      $mineral_nombre = $mineral["nombre"];
                      $mineral_mid = $mineral["mid"];

                      echo  "<input id='pass' type='checkbox' name='mids[]' value='$mineral_mid' >$mineral_nombre<br><br>
                            ";
                    }
                    echo
                "</div>
              </div>
              <div class='group'>
                <button name='crear_proyecto' type='submit' class='button' value='True'>Crear Minera</button>
              </div>
            </div>";
          }
          else
          {
            unset($_SESSION["crear_proyecto_err"]);
            echo"
            <div class='sign-in-htm'>
              <div class='group'>
                <label for='pass' class='label'>Energia que produce</label>";

                  foreach ($minerales as $mineral)
                  {
                    $mineral_nombre = $mineral["nombre"];
                    $mineral_mid = $mineral["mid"];

                    echo  "<input id='pass' class='input' type='checkbox' name='mids[]' value='$mineral_mid' style='background:rgba(255,100,100,.4); />$mineral_nombre<br />
                          ";
                  }

                  echo
              "</div>
              <div class='group'>
                <button name='crear_proyecto' type='submit' class='button' value='True'>Crear Minera</button>
              </div>
            </div>";
          }

        }
        else
        {
          echo"Debes estar registrado como socio para agregar un proyecto.";
        }
        ?>
  		</div>
  	</div>
  </form>


  <br><br>
  <?php include("../../templates/boton_volver.php"); ?>

</body>