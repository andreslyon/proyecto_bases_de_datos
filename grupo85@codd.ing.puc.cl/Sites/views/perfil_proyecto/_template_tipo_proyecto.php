<?php
if ($tipo != "Vertedero")
  {
    if($tipo == "Central")
    {
      $tipo_query ="SELECT energia FROM proyectoscentrales WHERE pid=$pid";
    }
    if($tipo == "Minera")
    {
      $tipo_query ="SELECT nombre
                    FROM (SELECT mid FROM pym WHERE pid=$pid) as foo
                    NATURAL JOIN minerales";
    }
    $tipo_result = consultar($tipo_query) -> fetchALL();
  }
?>


<?php
if($tipo == "Central")
{
  $energia = $tipo_result[0]["energia"];
  echo "<tr>
          <td class = 'text-center'><strong>Produccion</strong></td>
          <td class = 'text-center'>Energia $energia </td>
        </tr>";
}
if($tipo == "Minera")
{
  echo "<tr>
          <td class = 'text-center'><strong>Extrae:</strong></td>
          <td class = 'text-center'>";
  foreach ($tipo_result as $min)
  {
    echo " $min[0]";
  }
  echo "</td>
        </tr>";
}


?>
