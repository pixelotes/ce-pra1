<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
	  <img class="navbar-brand" style="max-width: 150px;" src="images/logo_main.png" href="#"></img>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <!--<li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>-->
            
        <?php
            if(isset($_SESSION["logeado"])){
                if($_SESSION["logeado"]==true) {
					echo "<li class=\"nav-item\">";
                    //echo "<span class=\"nav-link\">¡Bienvenido, ".devuelveUserName()."!</span>";
					echo "<span class=\"nav-link\">¡Bienvenido, ".devuelveUserName()."!";
					echo "</li>";
                }
            } else{
               		echo "<li class=\"nav-item\">";
                    echo "<span class=\"nav-link\">¡Bienvenido, invitado!</span>";
					echo "</li>";
            }
        ?>
		<?php
           if(isset($_SESSION["logeado"])){
                if($_SESSION["logeado"]==true) {
				?>
          <li class="nav-item">
            <a class="nav-link" href="acciones.php?accion=logout">Desconectar</a>
          </li>
		  <?php
		  }
		   } else {
		?>
			             <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
		  <?php
		   }
		   ?>
          <li class="nav-item">
            <a class="nav-link" href="carrito.php">Carrito <span style='font-weight: bolder; border-radius: 50%; padding: 1px 5px 0px 5px; background: #fff; border: 2px solid #000; color: #000; text-align: center; font-family: Arial, sans-serif;'><?php echo($numItems); ?></span></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>