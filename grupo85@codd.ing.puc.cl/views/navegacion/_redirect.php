<?php
if(isset($_GET["search"]))
{
  $indx = $_GET["type"];
  $value = $_GET["nameToSearch"];
  if($indx!="")
  {
    header("Location: $indx.php?search=filter&nameToSearch=$value");
    exit;
  }
}
header('Location: ../../index.php');
exit;

?>
