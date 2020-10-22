<?php include("funciones.php"); ?>	
<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Información meta -->
  <?php include('template/meta.php') ?>

  <title>JuegoLandia - Tu tienda online de juegos de tablero</title>

  <!-- Librerías y otras dependencias -->
  <?php include('template/dependencies.php') ?>

  <!-- Custom styles for this template -->
  <link href="css/tienda.css" rel="stylesheet">
  <link href="css/login.css" rel="stylesheet">

</head>

<body>

  <!-- Barra de navegación -->
  <?php include('template/navbar.php'); ?>

  <!-- Page Content -->
  <div class="container">
	<br/>
	<br/>
	<!-- Contenido -->
	<form action="acciones.php" method="get">
	

	  <div class="container">
		<input type="hidden" name="accion" id="accion" value="login"></input>
		<label for="userId"><b>Usuario</b></label>
		<input type="text" placeholder="Introduce tu usuario" name="userId" required>

		<label for="userPass"><b>Contraseña</b></label>
		<input type="password" placeholder="Introduce tu contraseña" name="userPass" required>

		<button type="submit">Ingresar</button>
		<label>
		  <input type="checkbox" checked="checked" name="remember"> Recordarme en este equipo
		</label>
	  </div>

	  <div class="container" style="background-color:#f1f1f1">
		<button type="button" class="cancelbtn">Volver</button>
		<span class="psw">Recuperar <a href="#">contrase&ntilde;a</a></span>
	  </div>
	</form>

  </div>
  <!-- /.container -->

  <!-- Pie de página -->
  <?php include('template/footer.php') ?>

</body>

</html>
