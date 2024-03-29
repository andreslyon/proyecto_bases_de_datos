<?php
session_start();
function redirect_correcto($pid)
{
  header("Location: ../perfil_proyecto/proyecto.php?pid=$pid");
  exit;
}

function consultar($query)
{
  require("../../config/conexion_impar.php");
  $result = $db -> prepare($query);
  $result -> execute();
  return $result;
}



$lid = $_SESSION["new_lid"];
$sid = $_SESSION["sid"];
$values = $_SESSION["new_values"];





$query_quitar_foranea = "ALTER TABLE proyectos DROP CONSTRAINT proyectos_pid_fkey";
consultar($query_quitar_foranea);
$query_insert_proyectos = "INSERT INTO proyectos(nombre,tipo,latitud,longitud,operativo,fecha_apertura)
                           VALUES($values)
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
$query_agregar_herencia = "INSERT INTO proyectosvertederos VALUES('$pid')";
consultar($query_agregar_herencia);

unset($_SESSION["new_lid"]);
unset($_SESSION["new_values"]);

redirect_correcto($pid);
?>
