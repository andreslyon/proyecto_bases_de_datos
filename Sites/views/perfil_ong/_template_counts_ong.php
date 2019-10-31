<?php

$todos_los_proyectos_2 = "
                        SELECT proyectos.pid, grupo80.nombre as nombre_proyecto
                        FROM  proyectos
                              INNER JOIN dblink('dbname=grupo80 user=grupo80 password=grupo80', 'SELECT nombre FROM proyectos') AS grupo80(nombre varchar(100))
                              ON grupo80.nombre LIKE CONCAT(proyectos.nombre, '_')
                        UNION
                        SELECT proyectos.pid, grupo80.nombre as nombre_proyecto
                        FROM  proyectos
                              NATURAL JOIN dblink('dbname=grupo80 user=grupo80 password=grupo80', 'SELECT nombre FROM proyectos') AS grupo80(nombre varchar(100))
                          ";

$ong_red_sociales_2 = "
                        SELECT grupo80.id_mov, grupo80.nombre_ong, grupo80.nombre_proyecto, grupo80.presupuesto, grupo80.fecha, grupo80.tipo_contenidos, grupo80.duracion
                        FROM  dblink('dbname=grupo80 user=grupo80 password=grupo80',   'SELECT id_mov, nombre_ong, nombre_proyecto, presupuesto, fecha, tipo_contenidos, duracion
                                                                                        FROM  organizan
                                                                                        NATURAL JOIN redes_sociales')
                              AS grupo80(id_mov int, nombre_ong varchar(100), nombre_proyecto varchar(100), presupuesto int, fecha date, tipo_contenidos varchar(100), duracion int)
                        WHERE grupo80.nombre_ong='$nombre'
                        ";

$ong_marchas_2 = "
                        SELECT grupo80.id_mov, grupo80.nombre_ong, grupo80.nombre_proyecto, grupo80.presupuesto, grupo80.fecha, grupo80.n_esperado_personas, grupo80.lugar
                        FROM  dblink('dbname=grupo80 user=grupo80 password=grupo80',   'SELECT id_mov, nombre_ong, nombre_proyecto, presupuesto, fecha, n_esperado_personas, lugar
                                                                                        FROM  organizan
                                                                                        NATURAL JOIN marchas')
                              AS grupo80(id_mov int, nombre_ong varchar(100), nombre_proyecto varchar(100), presupuesto int, fecha date, n_esperado_personas int, lugar varchar(100))
                        WHERE grupo80.nombre_ong='$nombre'
                        ";


$red_count_query = "
              SELECT COUNT(pid)
              FROM ($todos_los_proyectos_2) AS foo
                    NATURAL JOIN
                    ($ong_red_sociales_2) AS var
              ";

$red_count_result = consultar($red_count_query) -> fetchALL();
$red_count_result = $red_count_result[0][0];


$marcha_count_query = "
              SELECT COUNT(pid)
              FROM ($todos_los_proyectos_2) AS foo
                    NATURAL JOIN
                    ($ong_marchas_2) AS var
              ";

$marcha_count_result = consultar($marcha_count_query) -> fetchALL();
$marcha_count_result = $marcha_count_result[0][0];

?>
