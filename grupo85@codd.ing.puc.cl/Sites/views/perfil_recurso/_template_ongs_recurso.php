<?php

$ongs_query = "SELECT *
                FROM (SELECT * FROM ryo WHERE rid=$rid) as foo
                NATURAL JOIN ONGs
                ORDER BY nombre";
$ongs_result = consultar($ongs_query) -> fetchALL();


?>


<?php

foreach ($ongs_result as $row)
{
  $nombre = $row["nombre"];
  $oid = $row["oid"];
  echo "
  <div class='row'>
    <div class='well col-md-12'>
      <div class='col-md-9'>
        <label>$nombre</label>
      </div>
      <div class='col-md-3'>
        <a class= 'btn btn-info btn-xs' href= '../perfil_ong/ong.php?oid=$oid' >
        Ver
        </a>
      </div>
    </div>
  </div>
  ";
}

?>
