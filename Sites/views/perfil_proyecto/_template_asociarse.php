<?php
session_start();
$pid = $_POST["pid"];
$sid = $_SESSION["sid"];

function consultar($query)
{
  require("../../config/conexion_impar.php");
  $result = $db -> prepare($query);
  $result -> execute();
  return $result;
}


if($_POST["accion"]=="asociarse")
{
  $query = "
  INSERT INTO pys VALUES('$pid','$sid')
  ";
  consultar($query);
}
else if ($_POST["accion"]=="desasociarse")
{
  $query = "
  DELETE FROM pys WHERE pid='$pid' AND sid='$sid';
  ";
  consultar($query);
}
header("Location: proyecto.php?pid=$pid");
exit;
?>
