<?php
if ($status != "en trámite")
  {
    if($status=="aprobado")
    {
      $status_query ="SELECT fecha_dictamen FROM recursosaprobados WHERE rid=$rid";
    }
    if($status=="rechazado")
    {
      $status_query ="SELECT fecha_dictamen FROM recursosrechazados WHERE rid=$rid";
    }
    $status_result = consultar($status_query) -> fetchALL();
  }
?>


<?php
if($status != "en trámite")
{
  $fecha_dictamen = $status_result[0]["fecha_dictamen"];
  echo "<tr>
          <td class = 'text-center'><strong>Fecha Dictamen</strong></td>
          <td class = 'text-center'>$fecha_dictamen</td>
        </tr>";
}



?>
