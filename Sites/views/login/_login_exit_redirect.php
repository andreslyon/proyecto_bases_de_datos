<?php
session_start();
function consultar($query)
{
  require("../../config/conexion_impar.php");
  $result = $db -> prepare($query);
  $result -> execute();
  return $result;
}

function redirect()
{
  if(isset($_SESSION["url_antes_de_login"]))
  {
    $url = $_SESSION["url_antes_de_login"];
    header("Location: $url");
    exit;
  }
  else
  {
    header("Location: ../../index.php");
    exit;
  }
}


if($_SESSION["tipo_de_login"]=="socio")
{
    unset($_SESSION["tipo_de_login"]);
    unset($_SESSION["sid"]);
    unset($_SESSION["socio_nombre"]);
    unset($_SESSION["socio_apellido"]);
    redirect();
}

else if ($_SESSION["tipo_de_login"]=="ong")
{
    unset($_SESSION["tipo_de_login"]);
    unset($_SESSION["oid"]);
    unset($_SESSION["ong_nombre"]);
    redirect();
}
?>
