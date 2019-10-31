<?php

$socios_query = "SELECT *
                FROM (SELECT * FROM pys WHERE pid=$pid) as foo
                NATURAL JOIN socios
                ORDER BY nombre";
$socios_result = consultar($socios_query) -> fetchALL();


?>


<?php

foreach ($socios_result as $row)
{
  $nombre = $row["nombre"];
  $apellido = $row["apellido"];
  echo "
  <div class='row'>
    <div class='well col-md-12'>
      <div class='col-md-12'>
        <label>$nombre $apellido</label>
      </div>
    </div>
  </div>
  ";
}

?>
