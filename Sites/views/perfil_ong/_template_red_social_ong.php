<?php

$todos_los_proyectos = "
                        SELECT proyectos.pid, grupo80.nombre as nombre_proyecto
                        FROM  proyectos
                              INNER JOIN dblink('dbname=grupo80 user=grupo80 password=grupo80', 'SELECT nombre FROM proyectos') AS grupo80(nombre varchar(100))
                              ON grupo80.nombre LIKE CONCAT(proyectos.nombre, '_')
                        UNION
                        SELECT proyectos.pid, grupo80.nombre as nombre_proyecto
                        FROM  proyectos
                              NATURAL JOIN dblink('dbname=grupo80 user=grupo80 password=grupo80', 'SELECT nombre FROM proyectos') AS grupo80(nombre varchar(100))
                          ";

$ong_red_sociales = "
                        SELECT grupo80.id_mov, grupo80.nombre_ong, grupo80.nombre_proyecto, grupo80.presupuesto, grupo80.fecha, grupo80.tipo_contenidos, grupo80.duracion
                        FROM  dblink('dbname=grupo80 user=grupo80 password=grupo80',   'SELECT id_mov, nombre_ong, nombre_proyecto, presupuesto, fecha, tipo_contenidos, duracion
                                                                                        FROM  organizan
                                                                                        NATURAL JOIN redes_sociales')
                              AS grupo80(id_mov int, nombre_ong varchar(100), nombre_proyecto varchar(100), presupuesto int, fecha date, tipo_contenidos varchar(100), duracion int)
                        WHERE grupo80.nombre_ong='$nombre'
                        ";

$red_query = "
              SELECT nombre_proyecto, tipo_contenidos, fecha, pid, presupuesto
              FROM ($todos_los_proyectos) AS foo
                    NATURAL JOIN
                    ($ong_red_sociales) AS var
              ORDER BY fecha DESC
              ";


$red_result = consultar($red_query) -> fetchALL();

?>


<?php

foreach ($red_result as $row)
{
  $pid = $row["pid"];
  $proyecto = $row["nombre_proyecto"];
  $tipo = $row["tipo_contenidos"];
  $fecha = $row["fecha"];
  $presupuesto = $row["presupuesto"];
  echo "
  <div class='row'>
    <div class='well col-md-12'>
      <div class='col-md-3'>
        <label>Red social contra <a href=../perfil_proyecto/proyecto.php?pid=$pid>$proyecto</a></label>
      </div>
      <div class='col-md-3'>
        <label>$fecha</label>
      </div>
      <div class='col-md-3'>
        <label>$tipo</label>
      </div>
      <div class='col-md-3'>
        <label>$$presupuesto CLP</label>
      </div>
    </div>
  </div>
  ";
}

?>
