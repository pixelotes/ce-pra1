<?php  
	include('funciones.php');
	
	if(isset($_GET["id"]) && $_GET["id"]!="") {
		if(isset($_SESSION["usuario"]) && ($_SESSION["usuario"] != ""||$_SESSION["usuario"] != 'invitado')){
			///////////////////////////////////
			// EL USUARIO SÍ ESTÁ REGISTRADO //
			///////////////////////////////////		
			
			/*
			Ahora ya podemos hacer gestiones si el usuario está logeado, en cuyo caso
			vamos a realizar la gestión de su carrito a través de la base de datos. Se
			siguien los mismos pasos que con la cookie: comprobar si el producto ya está
			en el carrito del usuario, si es así se añade a la línea existente, y si no
			existe se crea una línea nueva con el producto.
			*/	
			
			//USUARIO - usamos bd para el carrito
			echo("USUARIO: ".$_SESSION["usuario"]."<br/>");
			
			$producto = $_GET["id"];
			$cantidad = 1;
			$usuario = devuelveUserId();
			
			echo("ID DE USUARIO: ".$usuario."<br/>");
			
			////////////////////////////////////////////
			// EL PRODUCTO YA ESTÁ EN EL CARRITO (BD) //
			////////////////////////////////////////////
			if (numItemsCarrito($usuario, $producto)>0) {
				//El producto existe, editamos la línea agregando la cantidad
				//echo("EL PRODUCTO YA EXISTE<br/>");
				if (editaItemCarrito($usuario, $producto, $cantidad)==true) {
					echo "ITEM AGREGADO CORRECTAMENTE<br/>";
				} else { 
					echo("ERROR AL AGREGAR ITEM<br/>"); 
				}
			////////////////////////////////////////////////
			// EL PRODUCTO NO ESTÁ EN EL CARRITO (COOKIE) //
			////////////////////////////////////////////////
			} else {
				//El producto no existe, lo introducimos directamente
				//echo("EL PRODUCTO NO EXISTE<br/>");				
				if (agregaItemCarrito($usuario, $producto, $cantidad)==true) {
					echo "ITEM AGREGADO CORRECTAMENTE<br/>";
				} else { 
					echo("ERROR AL AGREGAR ITEM<br/>"); 
				}
			}
		}
		else {
		///////////////////////////////////
		// EL USUARIO NO ESTÁ REGISTRADO //
		///////////////////////////////////
		
		/*
		Es necesario manipular las cookies ANTES de generar cualquier output HTML, en
		cuyo caso PHP nos generará un error. Por eso, comprobamos primero si el usuario
		no está logeado, en cuyo caso gestionamos el carrito a través de una cookie.
		*/
		
		// Comprobamos si existe la cookie
		$aCarrito = array();
		if(isset($_COOKIE['carrito'])) {
			$aCarrito = unserialize($_COOKIE['carrito']);
		}
		
		// Creamos una variable para almacenar la cantidad de producto a agregar
		$cant=0;
		
		if(!isset($_GET['cant'])) {
			$cant=1; // Si no se especifica la cantidad, asumimos que es 1
		} else {
			$cant=$_GET['cant']; // En caso contrario, tomamos la cantidad que se nos dice
		}
		
		// Creamos una variable para saber si hemos encontrado el producto en la cesta
		$iUltimaPos = count($aCarrito);
		
		// Recorremos el carrito (si existe)
		if($iUltimaPos>0) {
			// Para cada línea, comprobamos si encontamos la id de producto
			foreach ($aCarrito as $key => $value) {
				// Si la encontramos, sumamos la cantidad y salimos del bucle			
				if($value['id']==$_GET['id']) {
					unset($aCarrito[$key]);
				}
			}
			
		}
	
		// Creamos la cookie (serializamos)
		$iTemCad = time() + (60 * 60);
		setcookie('carrito', serialize($aCarrito), $iTemCad);
		}
		
		// DEBUG
		/*echo("El usuario es INVITADO<br/>");
		$producto = $_GET["id"];
		echo("Añadiendo producto id ".$producto."<br/>");
		$cantidad = 0;
		if (isset($_GET['cant'])) {
			$cantidad=$_GET['cant'];
			echo("Añadiendo producto id=".$producto."<br/>");
		} else {
			$cantidad=1;
			echo("No se especifica cantidad, asumiendo valor de ".$cantidad."<br/>");
		}
		echo("Líneas en carrito: ".$iUltimaPos."<br/>");
		echo("Contenidos del carrito:<br/>");
		$sHTML = '';
		foreach ($aCarrito as $key => $value) {
			$sHTML .= '-> ID: ' . $value['id'] . ', CANTIDAD: ' . $value['cant'] . '<br>';
		}
		echo $sHTML;*/
	}

	header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
<html>
<header>
</header>
<body>
</body>
</html>