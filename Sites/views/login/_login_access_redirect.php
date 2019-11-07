<?php
session_start();
function consultar($query)
{
  require("../../config/conexion_impar.php");
  $result = $db -> prepare($query);
  $result -> execute();
  return $result;
}

function redirect_correcto()
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

function redirect_incorrecto()
{
  $_SESSION["login_bad_access"] = True;
  header("Location: login_access.php");
  exit;
}

function socio_sid($nombre, $apellido, $pswd)
{
  $todos_los_socios = " SELECT sid, nombre, apellido, password
                        FROM socios NATURAL JOIN sociospassword
                        WHERE nombre='$nombre' AND apellido='$apellido' AND password='$pswd'";
  $socio = consultar($todos_los_socios) -> fetchALL();
  $socio = $socio[0];
  if ($socio["sid"]!="")
  {
    return $socio["sid"];
  }
  else
  {
    return False;
  }
}

function ong_oid($nombre, $pswd)
{
  $todas_las_ongs = " SELECT oid, nombre, password
                        FROM ongs NATURAL JOIN ongspassword
                        WHERE nombre='$nombre' AND password='$pswd'";
  $ong = consultar($todas_las_ongs) -> fetchALL();

  $ong = $ong[0];
  if ($ong["oid"]!="")
  {
    return $ong["oid"];
  }
  else
  {
    return False;
  }
}

if($_POST["tipo_de_login"]=="socio")
{
  $nombre = $_POST["socio_nombre"];
  $apellido = $_POST["socio_apellido"];
  $pswd = $_POST["socio_password"];

  $sid = socio_sid($nombre, $apellido, $pswd);
  if ($sid)
  {
    $_SESSION["tipo_de_login"] = "socio";
    $_SESSION["sid"] = $sid;
    $_SESSION["socio_nombre"] = $nombre;
    $_SESSION["socio_apellido"] = $apellido;
    redirect_correcto();

  }
  else{redirect_incorrecto();}

}

else if ($_POST["tipo_de_login"]=="ong")
{
  $nombre = $_POST["ong_nombre"];
  $pswd = $_POST["ong_password"];

  $oid = ong_oid($nombre, $pswd);
  if ($oid)
  {
    $_SESSION["tipo_de_login"] = "ong";
    $_SESSION["oid"] = $oid;
    $_SESSION["ong_nombre"] = $nombre;
    redirect_correcto();
  }
  else{redirect_incorrecto();}
}
?>
