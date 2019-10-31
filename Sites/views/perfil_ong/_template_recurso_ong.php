<?php

$recurso_query = "SELECT *
                FROM (SELECT *
                                FROM (SELECT * FROM ryo WHERE oid=$oid) as foo
                                NATURAL JOIN recursos
                                ORDER BY status) as var
                ORDER BY causa_contaminante DESC";
$recurso_result = consultar($recurso_query) -> fetchALL();


?>


<?php

foreach ($recurso_result as $row)
{
  $rid = $row["rid"];
  $numero = $row["numero"];
  $causa = $row["causa_contaminante"];
  $status = $row["status"];
  echo "
  <div class='row'>
    <div class='well col-md-12'>
      <div class='col-md-3'>
        <label>$numero</label>
      </div>
      <div class='col-md-3'>
        <label>$causa</label>
      </div>
      <div class='col-md-3'>
        <label>$status</label>
      </div>
      <div class='col-md-3'>
        <a class= 'btn btn-info btn-xs' href= '../perfil_recurso/recurso.php?rid=$rid' >
        Ver
        </a>
      </div>
    </div>
  </div>
  ";
}

?>
