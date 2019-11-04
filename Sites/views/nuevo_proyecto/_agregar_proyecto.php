<?php
session_start();
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
  if ($nombre_result["nombre"]!="")
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
  $operativo = "Si";
}
else
{
  $operativo = "No";
}
$lat = $_POST["lat"];
$long = $_POST["long"];
$lid = $_POST["lid"];
$sid = $_SESSION["sid"];

verif_nombre($nombre);
verif_lat($lat);
verif_long($long);
verif_fecha($fecha);

$query_quitar_foranea = "ALTER TABLE proyectos DROP CONSTRAINT proyectos_pid_fkey";
consultar($query_quitar_foranea);
$query_insert_proyectos = "INSERT INTO proyectos(nombre,tipo,latitud,longitud,operativo,fecha_apertura)
                           VALUES('$nombre', '$tipo', '$lat', '$long', '$operativo', '$fecha')
                           RETURNING pid";
$result = consultar($query_insert_proyectos) -> fetchALL();
$result = $result[0];
$pid = $result[0];
$query_insert_pyl = "INSERT INTO pyl VALUES('$pid', '$lid')";
consultar($query_insert_pyl);
$query_agregar_foranea = " ALTER TABLE proyectos
                           ADD CONSTRAINT proyectos_pid_fkey
                           FOREIGN KEY(pid) REFERENCES pyl(pid)
                           ON UPDATE CASCADE ON DELETE CASCADE";
$result = consultar($query_agregar_foranea) -> fetchALL();
$query_asociar = "INSERT INTO pys VALUES('$pid','$sid')";
consultar($query_asociar);
redirect_correcto();
?>
