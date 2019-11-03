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
  }
</style>

<div style="margin-left:60%;margin-right:10%">
    <?php

    if ($_SESSION["tipo_de_login"]=="socio")
    {
      $socio_nombre = $_SESSION["socio_nombre"];
      $socio_apellido = $_SESSION["socio_apellido"];
      echo "
            <form class='botoncito_de_login' align='center' action='views/login/_login_exit_redirect.php' method='post'>
              <div class='row'>
                <div class='col-8'>
                    Indentificado como socio,<br>
                    $socio_nombre $socio_apellido
                </div>
                <button class='btn col-4 botoncito_de_salir' type='submit' name='search' value='Filter'>Salir</button>
              </div>
            </form>";
    }
    else if ($_SESSION["tipo_de_login"]=="ong")
    {
      $ong_nombre = $_SESSION["ong_nombre"];
      echo "
            <form class='botoncito_de_login' align='center' action='views/login/_login_exit_redirect.php' method='post'>
              <div class='row'>
                <div class='col-8'>
                    Indentificado como ONG,<br>
                    $ong_nombre
                </div>
                <button class='btn col-4 botoncito_de_salir' type='submit' name='search' value='Filter'>Salir</button>
              </div>
            </form>";
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
