<?php
session_start();
function redirect_correctos()
{
  if(isset($_SESSION["current_page_url"]))
  {
    $url = $_SESSION["current_page_url"];
    header("Location: $url");
    exit;
  }
  else
  {
    header("Location: ../../index.php");
    exit;
  }
}
function redirect_correcto($tipo)
{
  if($tipo=="Vertedero")
  {
    header("Location: _agregar_vertedero.php");
    exit;
  }
  else if ($tipo=="Central")
  {
    header("Location: _nueva_central.php");
    exit;
  }
  else if ($tipo=="Minera")
  {
    header("Location: _nueva_minera.php");
    exit;
  }
}
function redirect_incorrecto()
{
  header("Location: nuevo_proyecto.php");
  exit;
}
function consultar($query)
{
  require("../../config/conexion_impar.php");
  $result = $db -> prepare($query);
  $result -> execute();
  return $result;
}
function verif_nombre($nombre)
{
  if ($nombre=="")
  {
    $_SESSION["crear_proyecto_err"] = "el nombre no puede estar vacío";
    redirect_incorrecto();
  }
  $todos_los_nombres = "SELECT nombre
                        FROM proyectos
                        WHERE nombre=$nombre";
  $nombre_result = consultar($todos_los_nombres) -> fetchALL();
  $nombre_result = $nombre_result[0];
  if ($nombre_result[0]!="")
  {
    $_SESSION["crear_proyecto_err"] = "el nombre ya existe";
    redirect_incorrecto();
  }
  else
  {
    return True;
  }
}
function verif_lat($lat)
{
  if ($lat=="")
  {
    $_SESSION["crear_proyecto_err"] = "la latitud no puede estar vacía";
    redirect_incorrecto();
  }
  if ($lat<-90||$lat>90)
  {
    $_SESSION["crear_proyecto_err"] = "lat debe estar entre [-90,90]";
    redirect_incorrecto();
  }
}
function verif_long($long)
{
  if ($long=="")
  {
    $_SESSION["crear_proyecto_err"] = "la longitud no puede estar vacía";
    redirect_incorrecto();
  }
  if ($long<0||$long>360)
  {
    $_SESSION["crear_proyecto_err"] = "long debe estar entre [0,360]";
    redirect_incorrecto();
  }
}
function verif_fecha($fecha)
{
  if ($fecha=="")
  {
    $_SESSION["crear_proyecto_err"] = "la fecha no puede estar vacía $fecha";
    redirect_incorrecto();
  }
}


$nombre = $_POST["nombre"];
$tipo = $_POST["tipo"];
$fecha = $_POST["fecha"];
if (isset($_POST["operativo"]))
{
  $operativo = "si";
}
else
{
  $operativo = "no";
}
$lat = $_POST["lat"];
$long = $_POST["long"];
$lid = $_POST["lid"];

verif_nombre($nombre);
verif_lat($lat);
verif_long($long);
verif_fecha($fecha);

$_SESSION["new_values"] = "'$nombre', '$tipo', '$lat', '$long', '$operativo', '$fecha'";
$_SESSION["new_lid"] = $lid;

redirect_correcto($tipo);

?>
