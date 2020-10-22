		<div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
			<?php 
				global $host, $port, $user, $password, $dbname;
	
				$cxn = new mysqli($host, $user, $password, $dbname, $port)
				or die ('Ocurrió un error al conectar con la base de datos.' . mysqli_connect_error());

				$query = "select count(imagen_1)+count(imagen_2)+count(imagen_3) as cuenta from productos where id=".$id_juego.";";

				if($cxn->real_query ($query)){

					if($result = $cxn->store_result()){
						$nrows    = $result->num_rows;

						$all_rows = $result->fetch_all(MYSQLI_ASSOC);

						//crea los elementos de la lista a partir de los resultados
						for($i = 0; $i < count($all_rows); $i++){
							if ($all_rows[$i]['cuenta']>0) {
								
								echo("<li data-target='#carouselExampleIndicators' data-slide-to='0' style='background-color:black;' class='active'></li><br/>");
							}
							if ($all_rows[$i]['cuenta']>1) {
								
								echo("<li data-target='#carouselExampleIndicators' data-slide-to='1' style='background-color:black;'></li>");
							}
							if ($all_rows[$i]['cuenta']>2) {
								
								echo("<li data-target='#carouselExampleIndicators' data-slide-to='2' style='background-color:black;'></li>");
							}
							
						}
					}

					$result->close(); //liberamos recursos
				}
			?>
          </ol>
          <div class="carousel-inner" role="listbox">
			<?php 
				global $host, $port, $user, $password, $dbname;
	
				$cxn = new mysqli($host, $user, $password, $dbname, $port)
				or die ('Ocurrió un error al conectar con la base de datos.' . mysqli_connect_error());

				$query = "select imagen_1, imagen_2, imagen_3 from productos where id=".$id_juego.";";

				if($cxn->real_query ($query)){

					if($result = $cxn->store_result()){
						$nrows    = $result->num_rows;

						$all_rows = $result->fetch_all(MYSQLI_ASSOC);

						$li = "";
						//crea los elementos de la lista a partir de los resultados
						for($i = 0; $i < count($all_rows); $i++){
							if ($all_rows[$i]['imagen_1']!="") {
								echo("<div class='carousel-item active'><br/><center><img style='max-height: 300px;' class='d-block img-fluid' src='images/".$all_rows[$i]['imagen_1']."' alt='Imagen 1'></center><br/></div>");
							}
							if ($all_rows[$i]['imagen_2']!="") {
								echo("<div class='carousel-item'><br/><center><img style='max-height: 300px;' class='d-block img-fluid' src='images/".$all_rows[$i]['imagen_2']."' alt='Imagen 1'></center><br/></div>");
							}
							if ($all_rows[$i]['imagen_3']!="") {
								echo("<div class='carousel-item'><br/><center><img style='max-height: 300px;' class='d-block img-fluid' src='images/".$all_rows[$i]['imagen_3']."' alt='Imagen 1'></center><br/></div>");
							}
							
						}
					}

					$result->close(); //liberamos recursos
				}
			?>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color:black; padding: 2px; border: 3px solid black; border-radius: 15%;"></span>
            <span class="sr-only">Anterior</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true" style="background-color:black; padding: 2px; border: 3px solid black; border-radius: 15%;"></span>
            <span class="sr-only">Siguiente</span>
          </a>
        </div>