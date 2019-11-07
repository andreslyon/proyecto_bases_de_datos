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


if(intval($pid)>450)
{
  $query = "DELETE FROM proyectos WHERE pid='$pid'";
  consultar($query);
}
header("Location: ../../index.php");
exit;
?>
