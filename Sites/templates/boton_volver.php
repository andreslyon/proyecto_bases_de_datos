<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
<!-- sample html for this button-->
<!-- stylesheet for this button -->
<style type="text/css">
  .button_volver {
    backface-visibility: hidden;
  position: relative;
  cursor: pointer;
  display: inline-block;
  white-space: nowrap;
  background: rgba(11.677175897748024%,17.821477470402332%,54.19354838709677%,0.852);
  border-radius: 3px;
  border: 0px solid #444;
  border-width: 0px 0px 0px 0px;
  padding: 10px 15px 10px 41px;
  box-shadow: 0px 2px 0px #090b15;
    color: #fff;
  font-size: 16px;
  font-family: century gothic;
  font-weight: 900;
  font-style: normal;
  text-shadow: 0px -1px 0px rgba(0%,0%,0%,0.3)
  }
  .button_volver > div {
    color: #999;
  font-size: 10px;
  font-family: Helvetica Neue;
  font-weight: initial;
  font-style: normal;
  text-align: center;
  margin: 0px 0px 0px 0px
  }
  .button_volver > i {
    font-size: 1em;
  background: rgba(0,0,0,0.2);
  border-radius: 0px;
  border: 0px solid transparent;
  border-width: 0px 0px 0px 0px;
  padding: 14px 7px 14px 7px;
  margin: 0px 0px 0px 0px;
  position: absolute;
  top: 0px;
  left: 0px;
  bottom: 0px;
  width: 34px
  }
  .button_volver > .ld {
    font-size: initial
  }
</style>



<div class="row" style='margin-left:46%;'>

  <?php
  if(isset($_SESSION["current_page_url"]))
  {
    $url = $_SESSION["current_page_url"];
    echo
    "<a class='button_volver' href='$url'>
        Volver
        <div></div>
        <i class='fa fa-reply'></i>
      </a>";
  }
  else
  {
    echo
    "<a class='button_volver' href='../../index.php'>
        Volver
        <div></div>
        <i class='fa fa-reply'></i>
      </a>";
  }
  ?>

</div>
