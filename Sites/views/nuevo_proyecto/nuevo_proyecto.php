<?php
function redirect($url)
{
  header("Location: $url");
  exit;
}
session_start();
?>

<style>
  body{
  margin:0;
  color:#6a6f8c;
  background:#c8c8c8;
  font:600 16px/18px 'Open Sans',sans-serif;
  }
  *,:after,:before{box-sizing:border-box}
  .clearfix:after,.clearfix:before{content:'';display:table}
  .clearfix:after{clear:both;display:block}
  a{color:inherit;text-decoration:none}

  .login-wrap{
  width:100%;
  margin:auto;
  max-width:525px;
  min-height:670px;
  position:relative;
  background:url(https://thumbor.forbes.com/thumbor/960x0/https%3A%2F%2Fspecials-images.forbesimg.com%2Fdam%2Fimageserve%2F38984058%2F960x0.jpg%3Ffit%3Dscale) no-repeat center;
  box-shadow:0 12px 15px 0 rgba(0,0,0,.24),0 17px 50px 0 rgba(0,0,0,.19);
  }
  .login-html{
  width:100%;
  height:100%;
  position:absolute;
  padding:90px 70px 50px 70px;
  background:rgba(40,57,101,.9);
  }
  .login-html .sign-in-htm,
  .login-html .sign-up-htm{
  top:0;
  left:0;
  right:0;
  bottom:0;
  position:absolute;
  transform:rotateY(180deg);
  backface-visibility:hidden;
  transition:all .4s linear;
  }
  .login-html .sign-in,
  .login-html .sign-up,
  .login-form .group .check{
  display:none;
  }
  .login-html .tab,
  .login-form .group .label,
  .login-form .group .button{
  text-transform:uppercase;
  }
  .login-html .tab{
  font-size:22px;
  margin-right:15px;
  padding-bottom:5px;
  margin:0 15px 10px 0;
  display:inline-block;
  border-bottom:2px solid transparent;
  }
  .login-html .sign-in:checked + .tab,
  .login-html .sign-up:checked + .tab{
  color:#fff;
  border-color:#1161ee;
  }
  .login-form{
  min-height:345px;
  position:relative;
  perspective:1000px;
  transform-style:preserve-3d;
  }
  .login-form .group{
  margin-bottom:15px;
  }
  .login-form .group .label,
  .login-form .group .input,
  .login-form .group .button{
  width:100%;
  color:#fff;
  display:block;
  }
  .login-form .group .input,
  .login-form .group .button{
  border:none;
  padding:15px 20px;
  border-radius:25px;
  background:rgba(255,255,255,.1);
  }
  .login-form .group input[data-type="password"]{
  text-security:circle;
  -webkit-text-security:circle;
  }
  .login-form .group .label{
  color:#aaa;
  font-size:12px;
  }
  .login-form .group .button{
  background:#1161ee;
  }
  .login-form .group label .icon{
  width:15px;
  height:15px;
  border-radius:2px;
  position:relative;
  display:inline-block;
  background:rgba(255,255,255,.1);
  }
  .login-form .group label .icon:before,
  .login-form .group label .icon:after{
  content:'';
  width:10px;
  height:2px;
  background:#fff;
  position:absolute;
  transition:all .2s ease-in-out 0s;
  }
  .login-form .group label .icon:before{
  left:3px;
  width:5px;
  bottom:6px;
  transform:scale(0) rotate(0);
  }
  .login-form .group label .icon:after{
  top:6px;
  right:0;
  transform:scale(0) rotate(0);
  }
  .login-form .group .check:checked + label{
  color:#fff;
  }
  .login-form .group .check:checked + label .icon{
  background:#1161ee;
  }
  .login-form .group .check:checked + label .icon:before{
  transform:scale(1) rotate(45deg);
  }
  .login-form .group .check:checked + label .icon:after{
  transform:scale(1) rotate(-45deg);
  }
  .login-html .sign-in:checked + .tab + .sign-up + .tab + .login-form .sign-in-htm{
  transform:rotate(0);
  }
  .login-html .sign-up:checked + .tab + .login-form .sign-up-htm{
  transform:rotate(0);
  }

  .hr{
  height:2px;
  margin:60px 0 50px 0;
  background:rgba(255,255,255,.2);
  }
  .foot-lnk{
  text-align:center;
  }
  .custom_volver{
    padding:10px 60px;
    font-size:15px;
    background:rgb(10,10,100);
    color:rgb(255,255,255);
    border-radius:20px;
  }
</style>

<body>
  <form class="login-wrap" action="_login_access_redirect.php" method="POST">
  	<div class="login-html">
  		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Socio</label>
      <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">ONG</label>

      <div class="login-form">
        php
        if ($_SESSION["tipo_de_login"]=="socio")
        {
          echo"
          <div class='sign-in-htm'>
            <div class='group'>
              <label  for='user' class='label'>Nombre</label>
              <input name='socio_nombre' id='user' type='text' class='input'>
            </div>
            <div class='group'>
              <label for='pass' class='label'>Apellido</label>
              <input name='socio_apellido' id='pass' type='text' class='input'>
            </div>
            <div class='group'>
              <label for='pass' class='label'>Password</label>
              <input name='socio_password' id='pass' type='password' class='input' data-type='password'>
            </div>
            <div class='group'>
              <input id='check' type='checkbox' class='check' checked>
              <label for='check'><span class='icon'></span> Recordarme</label>
            </div>
            <div class='group'>
              <button name='tipo_de_login' type='submit' class='button' value='socio'>login</button>
            </div>
          </div>
          
          <div class='sign-up-htm'>
            <div class='group'>
              <label  for='user' class='label'>Nombre de la ONG</label>
              <input name='ong_nombre' id='user' type='text' class='input'>
            </div>
            <div class='group'>
              <label for='pass' class='label'>Password</label>
              <input name='ong_password' id='pass' type='password' class='input' data-type='password'>
            </div>
            <div class='group'>
              <input id='check' type='checkbox' class='check' checked>
              <label for='check'><span class='icon'></span> Recordarme</label>
            </div>
            <div class='group'>
              <button name='tipo_de_login' type='submit' class='button' value='ong'>login</button>
            </div>
          </div>
          ";
        }
        else
        {
          if(isset($_SESSION["current_page_url"]))
          {
            redirect($_SESSION["current_page_url");
          }
          else
          {
            redirect("action='../../index.php");
          }

        }
        ?>
  		</div>
  	</div>
  </form>


  <br><br>
  <div class="row">
    <div class="text-center" style="margin-left:45%;">
      <?php
      if(isset($_SESSION["current_page_url"]))
      {
        $url = $_SESSION["current_page_url"];
        echo
        "<form action='$url' method='get'>";
      }
      else
      {
        echo
        "<form action='../../index.php' method='get'> ";
      }
      ?>
          <input class="custom_volver" type="submit" value="Volver">
      </form>
    </div>
  </div>
</body>
