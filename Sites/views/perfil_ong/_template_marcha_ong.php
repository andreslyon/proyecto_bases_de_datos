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

$ong_marchas = "
                        SELECT grupo80.id_mov, grupo80.nombre_ong, grupo80.nombre_proyecto, grupo80.presupuesto, grupo80.fecha, grupo80.n_esperado_personas, grupo80.lugar
                        FROM  dblink('dbname=grupo80 user=grupo80 password=grupo80',   'SELECT id_mov, nombre_ong, nombre_proyecto, presupuesto, fecha, n_esperado_personas, lugar
                                                                                        FROM  organizan
                                                                                        NATURAL JOIN marchas')
                              AS grupo80(id_mov int, nombre_ong varchar(100), nombre_proyecto varchar(100), presupuesto int, fecha date, n_esperado_personas int, lugar varchar(100))
                        WHERE grupo80.nombre_ong='$nombre'
                        ";

$marchas_query = "
                  SELECT nombre_proyecto, lugar, fecha, pid, presupuesto
                  FROM ($todos_los_proyectos) AS foo
                        NATURAL JOIN
                        ($ong_marchas) AS var
                  ORDER BY fecha DESC
                  ";


$marchas_result = consultar($marchas_query) -> fetchALL();

?>


<?php

foreach ($marchas_result as $row)
{
  $pid = $row["pid"];
  $proyecto = $row["nombre_proyecto"];
  $fecha = $row["fecha"];
  $lugar = $row["lugar"];
  $presupuesto = $row["presupuesto"];
  echo "
  <div class='row'>
    <div class='well col-md-12'>
      <div class='col-md-3'>
        <label>Marcha contra <a href=../perfil_proyecto/proyecto.php?pid=$pid>$proyecto</a></label>
      </div>
      <div class='col-md-3'>
        <label>$fecha</label>
      </div>
      <div class='col-md-3'>
        <label>$lugar</label>
      </div>
      <div class='col-md-3'>
        <label>$$presupuesto CLP</label>
      </div>
    </div>
  </div>
  ";
}

?>
