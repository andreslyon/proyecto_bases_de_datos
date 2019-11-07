<?php
session_start();
function redirect_correcto($oid)
{
  header("Location: ong.php?oid=$oid");
  exit;
}

function consultar($query)
{
  require("../../config/conexion_impar.php");
  $result = $db -> prepare($query);
  $result -> execute();
  return $result;
}


$oid = $_SESSION["oid"];
$lid = $_POST["lid"];
$presupuesto = $_POST["presupuesto"];



// echo"oid = $oid, lid = $lid, presupuesto = $presupuesto";


redirect_correcto($oid);
?>
