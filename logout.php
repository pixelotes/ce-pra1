<?php include("funciones.php"); ?>	

<?php
session_start();

// Unset all of the session variables.
$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();
?>

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
  
  <!-- Con la sesión destruida, redirigimos a la página principal -->
  <script src="js/jquery.min.js"></script>
	<script>
	$(function() {
		window.open('index.php','_self');
	});
	</script>
	
</head>

<body>

  <!-- Barra de navegación -->
  <?php include('template/navbar.php'); ?>

  <!-- Page Content -->
  <div class="container">
	
	<!-- Contenido -->

  </div>
  <!-- /.container -->

  <!-- Pie de página -->
  <?php include('template/footer.php') ?>

</body>

</html>