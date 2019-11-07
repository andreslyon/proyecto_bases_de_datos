<?php
function redirect($url)
{
  header("Location: $url");
  exit;
}
?>

<style>
  .botoncito_de_login{
    font-size:15px;
    background:rgb(10,10,100);
    color:rgb(255,255,255);
    border-radius:20px;
  }

  .botoncito_de_salir{
    font-size:15px;
    background:rgb(60,60,100);
    color:rgb(255,255,255);
    border-radius:20px;
    margin-top: 10px;
    margin-bottom: 10px;
  }

  .botoncito_de_salir:hover{
    color:inherit;
    text-decoration:inherit;
  }

  .texto_botoncito{
    position: absolute;
    top: 50%;
    left: 50%;
    -moz-transform: translateX(-50%) translateY(-50%);
    -webkit-transform: translateX(-50%) translateY(-50%);
    transform: translateX(-50%) translateY(-50%);
  }

  .boton_icono{
    margin-top: 10px;
  }

</style>

<div style="margin-left:60%;margin-right:10%">
    <?php

    if ($_SESSION["tipo_de_login"]=="socio")
    {
      $socio_nombre = $_SESSION["socio_nombre"];
      $socio_apellido = $_SESSION["socio_apellido"];
      echo "
            <div class='botoncito_de_login' align='center' >
              <div class='row'>
                <div class='col-7'>
                    Indentificado como socio,<br>
                    $socio_nombre $socio_apellido
                </div>
                <a style='margin-bottom: 10px;background:#609136;border: 0px solid #444;box-shadow: 2.5px 2.5px 4px #000000;' href='views/nuevo_proyecto/nuevo_proyecto.php' class='btn btn-xs btn-info col-2 boton_icono'><span class='glyphicon glyphicon-plus'></span> Proyecto</a>
                <a style='margin-bottom:10px;margin-left:10px;margin-right:10px;' href='views/login/_login_exit_redirect.php' class='btn btn-xs btn-danger col-2 boton_icono'><span class='glyphicon glyphicon-log-out'></span> Salir</a>
                <div class='col-1'></div>
              </div>
            </div>";
    }
    else if ($_SESSION["tipo_de_login"]=="ong")
    {
      $ong_nombre = $_SESSION["ong_nombre"];
      $ong_oid = $_SESSION["oid"];
      echo "
            <div class='botoncito_de_login' align='center' >
              <div class='row'>
                <div class='col-7'>
                    Indentificado como ONG,<br>
                    $ong_nombre
                </div>
                <a style='margin-bottom: 10px;background:#609136;border: 0px solid #444;box-shadow: 2.5px 2.5px 4px #000000;' href='views/perfil_ong/ong.php?oid=$ong_oid' class='btn btn-xs btn-info col-2 boton_icono'><span class='glyphicon glyphicon-home'></span> Perfil</a>
                <a style='margin-bottom:10px;margin-left:10px;margin-right:10px;' href='views/login/_login_exit_redirect.php' class='btn btn-xs btn-danger col-2 boton_icono'><span class='glyphicon glyphicon-log-out'></span> Salir</a>
                <div class='col-1'></div>
              </div>
            </div>";
    }
    else
    {
      echo"
            <form align='center' action='views/login/login_access.php' method='post'>
              <button class='btn botoncito_de_login' type='submit' name='search' value='Filter'>Identificarse</button>
            </form>";
    }
    ?>
</div>
