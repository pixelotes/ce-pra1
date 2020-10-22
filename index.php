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

</head>

<body onload="<?php muestraMensaje() ?>">

  <!-- Barra de navegación -->
  <?php include('template/navbar.php'); ?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">

		<!-- Menú de categorías -->
        <div class="list-group my-4">
			<?php  creaMenu(); ?>
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">
		
		<!-- carrusel de imágenes -->
        <?php include('template/carousel.php'); ?>

        <div class="row">
		  <!-- Lista de 6 productos destacados -->	
		  <?php listaProductos(500, 6); ?>
        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Pie de página -->
  <?php include('template/footer.php') ?>

</body>

</html>
