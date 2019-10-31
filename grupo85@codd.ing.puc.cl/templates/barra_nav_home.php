<div class="container">
  <div class="row">

    <form align="center" action="views/navegacion/_redirect.php" method="get">
      <div class="row" >
        <div style="font-family:georgia,garamond,serif;font-style:italic;background: rgba(75,175,25,1);margin: 10px;" class="room-name" >
          <b>Buscador</b>
        </div>
      </div>
      <div class="row">
        <input style = "width:800px;height:30px" class="col-md-9" type="text" name="nameToSearch" palceholder="Value To Search"><br><br>
        <select style = "height:30px;font-size:15px" class="col-md-2" type="text" name="type" palceholder="Value To Search">
          <option value="">¿Qué Buscas?</option>
          <option value=""></option>
          <option value="proyectos">Proyecto</option>
          <option value="ongs">ONG</option>
          <option value="recursos">Recurso</option>
          </select>
        <button style = "height:30px" class= "btn btn-success btn-m col-md-1" type="submit" name="search" value="Filter">Buscar</button><br><br>
      </div>

    </form>

  </div>
</div>


<br>
