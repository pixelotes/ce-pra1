<?php

include('parametros.php');
session_set_cookie_params(7200,"/");
session_start(); //para manipular variables de sesiÃ³n SIEMPRE hay que poner session_start();
$numItems = numItemsCarrito();

////////////////////////////
/// FUNCIONES DE USUARIO ///
////////////////////////////

function recuperaPass($correo)
{

	global $host, $port, $user, $password, $dbname;

	$subject = 'Contraseña perdida';
	$headers = 'From: webmaster@noentiendo.es' . "\r\n" .
	'Reply-To: webmaster@noentiendo.es' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();

	$con     = mysqli_connect($host,$user,$password,$dbname);
	// Comprueba la conexión
	if(mysqli_connect_errno()){
		echo "Fallo en la conexión con MySQL: " . mysqli_connect_error();
	}
	$sql = "SELECT * FROM usuarios WHERE correo = '".$correo."' LIMIT 1;";

	//Realiza la consulta
	if($result = mysqli_query($con,$sql))
	{
		if(sizeof($result) > 0){
			//En caso de encontrar recultados
			$row     = mysqli_fetch_row($result);
			$message = 'Su cuenta de usuario es '.$row[1].' y su contraseña es '.$row[2];
			mail($correo, $subject, $message, $headers); //envia correo de confirmación
		}
		else
		{
			//En caso de no encontrarlos
			$message = 'No se ha encontrado ninguna cuenta registrada con esta dirección de correo';
			mail($correo, $subject, $message, $headers); //envia correo de denegación
		}
		mysqli_free_result($result);
	}

	mysqli_close($con);
}

//registra un nuevo usuario, devuelve true si se realiza con éxito y false si no
function registraUsuario($usu,$pass,$mail)
{

	global $host, $port, $user, $password, $dbname, $cxn;

	$query = "INSERT INTO usuarios VALUES ('','".$usu."','".$pass."','".$mail."');";
	if($ppp = $cxn->prepare($query)){
		$ppp->execute();
		$ppp->close();
		return true;
	}
	else
	{
		return false;
	}
}

function generaBotones()
{
	if(isset($_SESSION["usuario"]) && $_SESSION["usuario"] != null && $_SESSION["usuario"] != 'admin'){
		echo("<button type=\"submit\" id=\"btnDesconectar\">Desconectar</button>");
	}
	else
	if(isset($_SESSION["usuario"]) && $_SESSION["usuario"] == 'admin'){
		echo("<button type=\"submit\" id=\"btnAdministrar\" style=\"margin-right: 5px;\">Administrar</button>");
		echo("<button type=\"submit\" id=\"btnDesconectar\">Desconectar</button>");
	}
	else
	{
		echo("<button id=\"btnMenuRegistro\" style=\"margin-right: 5px;\"title=\"&iquest;No tienes cuenta? Pues rellena este formulario. &iexcl;Es r&aacute;pido!\">Registro</button>");
		echo("<button id=\"btnMenuLogin\">Login</button>");
	}
}

function guardaEstadisticasAcceso($usu,$juego)
{

	global $host, $port, $user, $password, $dbname;

	$cxn = new mysqli($host, $user, $password, $dbname, $port)
	or die ('Ocurrió un error al conectar con la base de datos.' . mysqli_connect_error());

	$query = "INSERT INTO accesos VALUES ('', (SELECT id FROM usuarios WHERE usuario = '".$usu."' LIMIT 1), ".$juego.", now());";
	if($ppp = $cxn->prepare($query)){
		$ppp->execute();
		$ppp->close();
		return true;
	}
	else
	{
		return false;
	}
}

function devuelveUser()
{
	if(isset($_SESSION["usuario"]) && ($_SESSION["usuario"] != ""||$_SESSION["usuario"] != 'admin')){
		echo("<a href=\"user.php?user=".$_SESSION["usuario"]."\" style=\"text-decoration: none;\">".$_SESSION["usuario"]."</a>");
	}
	else
	{
		echo("invitado");
	}
}

function devuelveUserName()
{
	if(isset($_SESSION["usuario"]) && ($_SESSION["usuario"] != ""||$_SESSION["usuario"] != 'admin')){
		return $_SESSION["usuario"];
	}
	else
	{
		return "invitado";
	}
}

function devuelveUserId() {
	
	if(isset($_SESSION["usuario"]) && ($_SESSION["usuario"] != ""||$_SESSION["usuario"] != 'admin')){
		global $host, $port, $user, $password, $dbname;
		$cxn = new mysqli($host, $user, $password, $dbname, $port)
			or die ('Ocurrió un error al conectar con la base de datos.' . mysqli_connect_error());
	
		$query = "SELECT id from usuarios where usuario='".$_SESSION["usuario"]."' LIMIT 1";
		if($cxn->real_query ($query)){

		if($result = $cxn->store_result()){
			$nrows    = $result->num_rows;

			$all_rows = $result->fetch_all(MYSQLI_ASSOC);

			return $all_rows[0]['id'];
		}

		$result->close(); //liberamos recursos
	}
		//echo $query;
		return query_select_single($query);
	}
	return -1;
	
}


function existeLogin()
{
	if(isset($_SESSION["usuario"]) && ($_SESSION["usuario"] != ""||$_SESSION["usuario"] != 'admin')){
		return true;
	}
	else
	{
		return false;
	}
}

function estaUsuarioLogeado() {
   if(isset($_SESSION["usuario"]) && ($_SESSION["usuario"] != ""||$_SESSION["usuario"] != 'admin')){
		echo("perfil.php");
	}
	else
	{
		echo("login.php");
	}
}
    

function checkLogin($usu,$pass)
{

	global $host, $port, $user, $password, $dbname;

	$cxn = new mysqli($host, $user, $password, $dbname, $port)
	or die ('Ocurrió un error al conectar con la base de datos.' . mysqli_connect_error());

	$query = "SELECT * FROM usuarios WHERE usuario = '".$usu."' AND password = '".$pass."';";
	if($stmt = $cxn->prepare($query)){

		/* execute query */
		$stmt->execute();

		/* store result */
		$stmt->store_result();

		$num = $stmt->num_rows;
		//echo "Resultados(".$usu.",".$pass."): ".$num;
		if($num > 0){
			$stmt->close();
			return true;
		}
		else
		{
			$stmt->close();
			return false;
		}
		/* close statement */

	}
}

function inicializa()
{
	if(empty($_SESSION['login'])){
		$_SESSION['login'] = false;
	}
	if(empty($_SESSION['usuario'])){
		$_SESSION['usuario'] = "";
	}
}

////////////////////////////
/// NAVEGACIÓN DE PÁGINA ///
////////////////////////////

function creaMenu()
{
	echo("<div href='#' id='0' class='list-group-item' style=\"background-color: black; color: white;\"><b>CATEGOR&Iacute;AS</b></div>");
	echo("<div id=\"nav\">");
	echo("<a href='categoria.php?id=600' id='600' class='list-group-item' style=\"background-color: #d1e5e6; color: #4f5152;\"><b>Top Ventas</b></a>");
	echo("<a href='categoria.php?id=500' id='500' class='list-group-item' style=\"background-color: #c5ffb8; color: #4f5152;\"><b>Novedades</b></a>");
	global $host, $port, $user, $password, $dbname;
	
	$cxn = new mysqli($host, $user, $password, $dbname, $port)
	or die ('Ocurrió un error al conectar con la base de datos.' . mysqli_connect_error());

	$query = "SELECT DISTINCT id,nombre FROM Categorias;";

	if($cxn->real_query ($query)){

		if($result = $cxn->store_result()){
			$nrows    = $result->num_rows;

			$all_rows = $result->fetch_all(MYSQLI_ASSOC);

			//crea los elementos de la lista a partir de los resultados
			for($i = 0; $i < count($all_rows); $i++){
				echo "<a href='categoria.php?id=".$all_rows[$i]['id']."' id='".$all_rows[$i]['id']."' class='list-group-item'>".$all_rows[$i]['nombre']."</a>\n";
			}
		}

		$result->close(); //liberamos recursos
	}
	echo("</div>");
}

function listaProductos($categoria, $numero) {
	
	global $host, $port, $user, $password, $dbname;
	
	$cxn = new mysqli($host, $user, $password, $dbname, $port)
	or die ('Ocurrió un error al conectar con la base de datos.' . mysqli_connect_error());

	// más recientes
	if ($categoria == 500) {
		$query = "SELECT * FROM productos ORDER BY fecha_alta DESC LIMIT ".$numero.";";
	} 
	// más vendidos
	else if ($categoria == 600) {
		$query = "SELECT * FROM productos;";
	}
	// categorías estándar
	else {
		$query = "SELECT DISTINCT * FROM productos where categoria_1=".$categoria." or categoria_2=".$categoria." or categoria_3=".$categoria." LIMIT ".$numero.";";
	}
	
	//echo $query;
	
	if($cxn->real_query ($query)){

		if($result = $cxn->store_result()){
			$nrows    = $result->num_rows;

			$all_rows = $result->fetch_all(MYSQLI_ASSOC);

			//crea los elementos de la lista a partir de los resultados
			for($i = 0; $i < count($all_rows); $i++){
				$salida = "\t<div class='col-lg-4 col-md-6 mb-4'>\n\t\t<div class='card h-100'>\n\t\t\t<a href='#'><img style='max-height:150px;' class='card-img-top' src='images/";
				$salida = $salida.$all_rows[$i]['imagen_1'];
				$salida = $salida."' alt=''></a>\n\t\t\t<div class='card-body' style='background-color:lightgrey;'>\n\t\t\t\t<h4 class='card-title'><a href='producto.php?id=".$all_rows[$i]['id']."'>";
				$salida = $salida.TildeToHtml($all_rows[$i]['nombre']);
				$salida = $salida."</a></h4>\n\t\t\t\t<h5>";
				$salida = $salida.$all_rows[$i]['precio'];
				$salida = $salida."&euro;</h5>\n\t\t\t\t<p class='card-text'>";
				$salida = $salida.TildeToHtml(substr($all_rows[$i]['descripcion'],0,100))."...";
				//$salida = $salida."</p>\n\t\t\t</div>\n\t\t\t<div class='card-footer'>\n\t\t\t\t<small class='text-muted'>&#9733; &#9733; &#9733; &#9733; &#9734;</small>\n\t\t\t</div>\n\t\t</div>\n\t</div>\n\n";
				$salida = $salida."</p>\n\t\t\t</div>\n\t\t\t<div class='card-footer'><center><a href='agregar.php?id=".$all_rows[$i]['id']."' class='btn btn-success' style='float:center;'>A&ntilde;adir a la cesta</a></center>\n\t\t\t</div>\n\t\t</div>\n\t</div>\n\n";
				echo($salida);
			}
		}
		
		$result->close(); //liberamos recursos
	}
}

function devuelveCantidadCarrito($usuario, $producto) {
    $query = "SELECT sum(cantidad) as resultado FROM carrito WHERE usuario=".devuelveUserId()." and producto=".$producto;
    
    global $host, $port, $user, $password, $dbname;
    $cxn = new mysqli($host, $user, $password, $dbname, $port)
        or die ('Ocurrió un error al conectar con la base de datos.' . mysqli_connect_error());

    //$query = "SELECT id from usuarios where usuario='".$_SESSION["usuario"]."' LIMIT 1";
    if($cxn->real_query ($query)){

        if($result = $cxn->store_result()){
            $nrows    = $result->num_rows;

            $all_rows = $result->fetch_all(MYSQLI_ASSOC);

            $resultado = $all_rows[0]['resultado'];
            if ($resultado == "") $resultado = 0;
            return $resultado;
        }
    }
}

function numItemsCarrito() {
	$numItems = 0;
 
	// Usuario no logeado
	if (!isset($_SESSION["logeado"])|| (isset($_SESSION["logeado"]) && $_SESSION["logeado"]==false)) {
		$aCarrito = array();
		if(isset($_COOKIE['carrito'])) {
			$aCarrito = unserialize($_COOKIE['carrito']);
			//$numItems = count($aCarrito);
			foreach ($aCarrito as $key => $value) {
				$numItems = $numItems + $value["cant"];
			}
		}
	} 
	// Usuario logeado
	else {
		$query = "SELECT sum(cantidad) as resultado FROM carrito WHERE usuario=".devuelveUserId();
		global $host, $port, $user, $password, $dbname;
		$cxn = new mysqli($host, $user, $password, $dbname, $port)
			or die ('Ocurrió un error al conectar con la base de datos.' . mysqli_connect_error());
	
		//$query = "SELECT id from usuarios where usuario='".$_SESSION["usuario"]."' LIMIT 1";
		if($cxn->real_query ($query)){

		if($result = $cxn->store_result()){
			$nrows    = $result->num_rows;

			$all_rows = $result->fetch_all(MYSQLI_ASSOC);
            
            $resultado = $all_rows[0]['resultado'];
            if ($resultado == "") $resultado = 0;
			return $resultado;
		}
		}
	}
		
	return $numItems;
}

function TildeToHtml($cadena) {
	return str_replace(array("á", "é", "í", "ó", "ú", "ñ", "Á", "É", "Í", "Ó", "Ú", "Ñ", "¡", "¿", "€"), 
	array("&aacute;", "&eacute;", "&iacute;", "&oacute;", "&uacute;", "&ntilde;", "&Aacute;", "&Eacute;", "&Iacute;", "&Oacute;", "&Uacute;", "&Ntilde;", "&iexcl;", "&iquest;", "&euro;"), 
	$cadena);
}

function agregaItemCarrito($usuario, $producto, $cantidad) {
    $query = "INSERT INTO carrito (usuario, producto, cantidad) VALUES (".devuelveUserId().",".$producto.",".$cantidad.");";
    
    global $host, $port, $user, $password, $dbname;
    $cxn = new mysqli($host, $user, $password, $dbname, $port)
        or die ('Ocurrió un error al conectar con la base de datos.' . mysqli_connect_error());

    //$query = "SELECT id from usuarios where usuario='".$_SESSION["usuario"]."' LIMIT 1";
    if($cxn->real_query ($query)){

        return true;
    } else {
        return false;
    }
}

function editaItemCarrito($usuario, $producto, $cantidad) {
    $query = "UPDATE carrito SET cantidad=cantidad+".$cantidad." where usuario=".$usuario." and producto=".$producto;
    
    global $host, $port, $user, $password, $dbname;
    $cxn = new mysqli($host, $user, $password, $dbname, $port)
        or die ('Ocurrió un error al conectar con la base de datos.' . mysqli_connect_error());

    //$query = "SELECT id from usuarios where usuario='".$_SESSION["usuario"]."' LIMIT 1";
    if($cxn->real_query ($query)){

        return true;
    } else {
        return false;
    }
}

///////////////////////////
/// DETALLE DE ARTÍCULO ///
///////////////////////////

function carouselJuego($id_juego) {
}

function nombreJuego($id_juego) {
	global $host, $port, $user, $password, $dbname;
	
	$cxn = new mysqli($host, $user, $password, $dbname, $port)
	or die ('Ocurrió un error al conectar con la base de datos.' . mysqli_connect_error());

	$query = "SELECT nombre from productos where id=".$id_juego.";";

	if($cxn->real_query ($query)){

		if($result = $cxn->store_result()){
			$nrows    = $result->num_rows;

			$all_rows = $result->fetch_all(MYSQLI_ASSOC);

			//crea los elementos de la lista a partir de los resultados
			for($i = 0; $i < count($all_rows); $i++){
				echo TildeToHtml($all_rows[$i]['nombre']);
			}
		}

		$result->close(); //liberamos recursos
	}
}

function precioJuego($id_juego) {
	global $host, $port, $user, $password, $dbname;
	
	$cxn = new mysqli($host, $user, $password, $dbname, $port)
	or die ('Ocurrió un error al conectar con la base de datos.' . mysqli_connect_error());

	$query = "SELECT precio from productos where id=".$id_juego.";";

	if($cxn->real_query ($query)){

		if($result = $cxn->store_result()){
			$nrows    = $result->num_rows;

			$all_rows = $result->fetch_all(MYSQLI_ASSOC);

			//crea los elementos de la lista a partir de los resultados
			for($i = 0; $i < count($all_rows); $i++){
				echo TildeToHtml($all_rows[$i]['precio']."€");
			}
		}

		$result->close(); //liberamos recursos
	}
}

function descripcionJuego($id_juego) {
	global $host, $port, $user, $password, $dbname;
	
	$cxn = new mysqli($host, $user, $password, $dbname, $port)
	or die ('Ocurrió un error al conectar con la base de datos.' . mysqli_connect_error());

	$query = "SELECT descripcion from productos where id=".$id_juego.";";

	if($cxn->real_query ($query)){

		if($result = $cxn->store_result()){
			$nrows    = $result->num_rows;

			$all_rows = $result->fetch_all(MYSQLI_ASSOC);

			//crea los elementos de la lista a partir de los resultados
			for($i = 0; $i < count($all_rows); $i++){
				echo TildeToHtml($all_rows[$i]['descripcion']);
			}
		}

		$result->close(); //liberamos recursos
	}
}

function contenidoJuego($id_juego) {
	global $host, $port, $user, $password, $dbname;
	
	$cxn = new mysqli($host, $user, $password, $dbname, $port)
	or die ('Ocurrió un error al conectar con la base de datos.' . mysqli_connect_error());

	$query = "SELECT contenido from productos where id=".$id_juego.";";

	if($cxn->real_query ($query)){

		if($result = $cxn->store_result()){
			$nrows    = $result->num_rows;

			$all_rows = $result->fetch_all(MYSQLI_ASSOC);

			//crea los elementos de la lista a partir de los resultados
			for($i = 0; $i < count($all_rows); $i++){
				echo TildeToHtml($all_rows[$i]['contenido']);
			}
		}

		$result->close(); //liberamos recursos
	}
}

function fichaJuego($id_juego) {
	echo("...");
}

function puntuacionJuego($id_juego) {
	echo("&#9733; &#9733; &#9733; &#9733; &#9734;");
}

//////////////////
/// CATEGORÍAS ///
//////////////////

function nombreCategoria($id_cat) {
	global $host, $port, $user, $password, $dbname;
	
	$cxn = new mysqli($host, $user, $password, $dbname, $port)
	or die ('Ocurrió un error al conectar con la base de datos.' . mysqli_connect_error());

	$query = "SELECT nombre from categorias where id=".$id_cat.";";

	if($cxn->real_query ($query)){

		if($result = $cxn->store_result()){
			$nrows    = $result->num_rows;

			$all_rows = $result->fetch_all(MYSQLI_ASSOC);

			//crea los elementos de la lista a partir de los resultados
			for($i = 0; $i < count($all_rows); $i++){
				echo TildeToHtml($all_rows[$i]['nombre']);
			}
		}

		$result->close(); //liberamos recursos
	}
}

/////////////////////////
/// CARRITO DE COMPRA ///
/////////////////////////
function muestra_carrito_cookie() {
	$items = [];
	
	//leemos la cookie
	if(isset($_COOKIE['carrito'])) {
		$aCarrito = unserialize($_COOKIE['carrito']);
		foreach ($aCarrito as $key => $value) {
			$resul = query_select("SELECT * FROM productos WHERE id=".$value["id"]);
			
			//recorrer $resul y armar array
			for($i = 0; $i < count($resul); $i++){
				//echo TildeToHtml($all_rows[$i]['contenido']);
				$item=array
				(
				"id"=>$resul[$i]["id"],
				"imagen"=>TildeToHtml($resul[$i]["imagen_1"]),
				"nombre"=>TildeToHtml($resul[$i]["nombre"]),
				"codigo"=>TildeToHtml($resul[$i]["referencia"]),
				"cantidad"=>$value["cant"],
				"precio"=>$resul[$i]["precio"]
				);
				array_push($items, $item);
			}		
		}
	}
	return $items;
}

function muestra_carrito_bd() {
	$items = [];
	$query = "SELECT * FROM carrito WHERE usuario=".devuelveUserId().";";
	$carrito = query_select($query);
	
	for($i = 0; $i < count($carrito); $i++){	
			$producto = query_select("SELECT * FROM productos WHERE id=".$carrito[$i]["producto"]);
			
			//recorrer $resul y armar array
			for($j = 0; $j < count($producto); $j++){
				//echo TildeToHtml($all_rows[$i]['contenido']);
				$item=array
				(
				"id"=>$producto[$j]["id"],
				"imagen"=>TildeToHtml($producto[$j]["imagen_1"]),
				"nombre"=>TildeToHtml($producto[$j]["nombre"]),
				"codigo"=>TildeToHtml($producto[$j]["referencia"]),
				"cantidad"=>$carrito[$i]["cantidad"],
				"precio"=>$producto[$j]["precio"]
				);
				array_push($items, $item);
			}		
	}
	return $items;
}

function query_select($query) {
	global $host, $port, $user, $password, $dbname;
	
	$cxn = new mysqli($host, $user, $password, $dbname, $port)
	or die ('Ocurrió un error al conectar con la base de datos.' . mysqli_connect_error());

	if($cxn->real_query ($query)){

		if($result = $cxn->store_result()){
			$nrows    = $result->num_rows;

			$all_rows = $result->fetch_all(MYSQLI_ASSOC);

			return $all_rows;
		}

		$result->close(); //liberamos recursos
	}
	
	return null;
}

function elimina_item_carrito($usuario, $item) {
    global $host, $port, $user, $password, $dbname, $cxn;

	$query = "DELETE FROM carrito WHERE usuario=".$usuario." and producto=".$item;
    
	if($ppp = $cxn->prepare($query)){
		$ppp->execute();
		$ppp->close();
		return true;
	}
	else
	{
		return false;
	}
}

function vaciaCarrito() {
    global $host, $port, $user, $password, $dbname, $cxn;

	$query = "DELETE FROM carrito WHERE usuario=".devuelveUserId();
    
	if($ppp = $cxn->prepare($query)){
		$ppp->execute();
		$ppp->close();
		return true;
	}
	else
	{
		return false;
	}
}

function query_select_single($query) {
	global $host, $port, $user, $password, $dbname;
	
	$cxn = new mysqli($host, $user, $password, $dbname, $port)
	or die ('Ocurrió un error al conectar con la base de datos.' . mysqli_connect_error());
	//$query = "SELECT id FROM usuarios WHERE usuario = 'admin' LIMIT 1";
	//$stmt = $mysqliConn->prepare('SELECT id FROM Users WHERE username=?');
	if($cxn->real_query ($query)){

		if($result = $cxn->store_result()){
			$nrows    = $result->num_rows;

			$all_rows = $result->fetch_all(MYSQLI_ASSOC);

			return $all_rows[0]['id'];
		}

		$result->close(); //liberamos recursos
	}
	
	return null;
	
}

function muestraMensaje() {
    
    $mensaje="";
    
    if(isset($_GET["n"])) {
        switch($_GET["n"]) {
            case "1":
                $mensaje=TildeToHtml("Se ha iniciado la sesión correctamente.");
                break;
            case "2":
                $mensaje=TildeToHtml("La sesión finalizó correctamente.");
                break;
            case "3":
                $mensaje=TildeToHtml("Se ha añadido el producto al carrito.");
                break;
            case "4":
                $mensaje=TildeToHtml("Se ha eliminado el producto del carrito.");
                break;
            case "5":
                $mensaje=TildeToHtml("Se ha vaciado el carrito.");
                break;
            case "6":
                $mensaje=TildeToHtml("Error eliminando la línea.");
                break;
            case "7":
                $mensaje=TildeToHtml("Error al agregar producto al carrito.");
                break;
            case "8":
                $mensaje=TildeToHtml("Error vaciando el carrito.");
                break;
        }
        echo "toast_s('".$mensaje."')";
    }
    
    
}

?>