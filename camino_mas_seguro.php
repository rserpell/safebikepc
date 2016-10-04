<?php
    $conexion = mysqli_connect("localhost", "rodrigo", "serpell","bicicleta");

if (!$conexion) {
    echo "No pudo conectarse a la BD: " . mysql_error();
 	};
	
	
	$origen=1;
	$destino=9;
	$distancia=0;
	$vec_orgn=array();
	//buscando los vecinos del origen

			$select="SELECT destino,largo,seguridad FROM callep2 WHERE origen = '$origen'";
				
			if ($result = mysqli_query($conexion,$select)) {
					

						
				//se entra en un while para pasar por todas las filas
				while ($row = mysqli_fetch_assoc($result)) {
				  		
					$vecinos_de[$origen][]=array("vecino"=>$row["destino"],
													"largo"=>$row["largo"],
													"seguridad"=>$row["seguridad"])
													;						
				
					$vec_de[$origen][]=$row["destino"];    
				}
			};
			
			//Tomando las calles como reversibles
			$select="SELECT origen,largo,seguridad FROM callep2 WHERE destino = '$origen'";
				
			if ($result = mysqli_query($conexion,$select)) {
					
				//printf("Select returned %d rows.<br>" , mysqli_num_rows($result));
					
					
				//se entra en un while para pasar por todas las filas
				while ($row = mysqli_fetch_assoc($result)) {
				  		
					$vecinos_de[$origen][]=array("vecino"=>$row["origen"],
										"largo"=>$row["largo"],
										"seguridad"=>$row["seguridad"])
										;						
				    $vec_de[$origen][]=$row["origen"];  
				}
			};

	
	
	
	//array donde guardar los vecinos que ya fueron visitados y donde guardar los disponibles
	$vec_visitados=array();
	//$vec_disp=array();
	
	
	
	//determinando la distancia minima entre origen y destino
	$query="SELECT `$destino` FROM floywar WHERE origen_destino='$origen'";
	if ($result = mysqli_query($conexion,$query)){
			    		
			$fila = mysqli_fetch_row($result);
			$dist_minima=$fila[0];
			mysqli_free_result($result);
				
	}
	else {
		    echo "Error: <br>" . mysqli_error($conexion);	
	};
	
	//determinando la distancia maxima de la ruta
	
	$dist_max=$dist_minima*1.5;
		
	//creando el arreglo para guardar las rutas e inciando el contador de rutas

	$ruta=array();
	$n_ruta=1;
		$v=$origen;
		$vec_visitados[$v]=array();
		//print_r($vec_visitados);
	$ruta[$n_ruta]=array("numero"=>'',
			"nodos"=>array(),
			"distancia"=>'',
			"seguridad"=>''
					);
						
	$ruta[$n_ruta]["nodos"][]=$origen;
									

		

	
//do

for($i=1;$i<=20;$i++){


		
	
	//foreach ($vecinos_de[$v] as $id => $vecino) {

		
		//ahora hay que revisar las posibles rutas de origen a destino,
		// y seleccionar la mas segura. dentro de un rango de maxima distancia
		//la ruta se almacena en el arreglo $ruta, y se debe toman en cuenta que es necesario actualizar
		//la ruta si se supera la distancia maxima de la ruta.
		//hay q poder borrar entradas de $ruta
		
		
		
	//print_r($vec_disp[$v]);
	
			
				
				//print_r($vecino);

				
				//se define el puntero
				echo "<br> inicio del for";
				$r=$ruta[$n_ruta]["nodos"];
				foreach($vec_de[$v] as $id => $t){
					echo "<br> inicio for each";
					
					//var_dump(in_array($t,$r));
					echo "<br> r es:";
					print_r($r);
					echo "<br> t al incio del foreach es:$t";
					echo "<br> la condicion del 1er if es:";
					var_dump(!empty($vec_visitados[$v]));
					// reparar este if
					if(!empty($vec_visitados[$v])){
						
						echo "<br> la condicion del 2do if es:";
						var_dump(!in_array($t,$vec_visitados[$v])&&!in_array($t,$r));
						echo "<br> numero de ruta:";
						var_dump($n_ruta);
						echo "<br> ruta";
						print_r($r);
						if(!in_array($t,$vec_visitados[$v])&&!in_array($t,$r)){
						
						//$vec_visitados[$v][]=$t;
						$key=$id;
						$vec=$t;
						echo" <br>ENTRO AL IF";
						
						echo "<br> t es $t<br>";
						};
					}else{
						
						if(!in_array($t,$r)){
													$key=$id;
						//$vec_disp[$v][]=$t;
						$vec=$t;
						echo "<br>ingreso al else y vec es $vec";
						
						//var_dump($vecinos_de[$v]);
						//echo"<br>";
						//echo $key;
						}

					};
		
				};
					echo"<br> los vecinos visitados son:";
					var_dump($vec_visitados[$v]);
					echo"<br> v es:$v y el puntero esta en $vec";
					//echo"<br> vec es $vec";
					//var_dump($vec_disp[$v]);
					echo"<br>";
				//
				
				
				//obteniendo la distancia minima desde el nodo vecino al destino
				
				if ($result = mysqli_query($conexion,"SELECT `$destino` FROM floywar WHERE origen_destino='$vec'")){
				    		
					$fila = mysqli_fetch_row($result);
					//echo "<br> fila es: <br>";
					//var_dump($fila);
					$dist_vec_dest=$fila[0];
					//var_dump($dist_v_dest);
					mysqli_free_result($result);
					
				}else {
				    echo "Error: <br>" . mysqli_error($conexion);	
				};
				//obteniendo la distancia minima desde el origen al nodo vecino
				
				if ($result = mysqli_query($conexion,"SELECT `$vec` FROM floywar WHERE origen_destino='$origen'")){
				    		
					$fila = mysqli_fetch_row($result);
					//echo "<br> fila es: <br>";
					//var_dump($fila);
					$dist_origen_vec=$fila[0];
					//var_dump($dist_v_dest);
					mysqli_free_result($result);
					
				}else {
				    echo "Error: <br>" . mysqli_error($conexion);	
				};
				
				//comprobando que el vecino no esta muy lejos del destino ni el origen del vecino 
				//y que tiene nodos vecinos disponibles
				
				
				$distancia=$vecinos_de[$v][$key]["largo"];
				$seguridad=$vecinos_de[$v][$key]["seguridad"];
				

			
				$se_evalua_vec=FALSE;
				
				if(($dist_vec_dest+$distancia)<$dist_max){
					if($distancia<(1.5*$dist_origen_vec)){
	
							$se_evalua_vec=TRUE;
							

					};
				};

				
				if(($se_evalua_vec)){
					//hay que incorporar el nodo a una ruta , actualizar v ,distancia y seguridad de la ruta ,
					//y agregar el nodo a nodos visitados por v
					
				//echo "<br> entro al if";
				//print_r($vec_de[$v]);
				//echo "<br>";
					echo "<br> entro al if<br>";
					$ruta[$n_ruta]["nodos"][]=$vec;
					$ruta[$n_ruta]["distancia"]=$ruta[$n_ruta]["distancia"]+$distancia;
					$vec_visitados[$v][]=$vec;
					$vec_visitados[$vec][]=$v;
					$ruta[$n_ruta]["seguridad"]=$ruta[$n_ruta]["seguridad"]+$seguridad;
					$v=$vec;
				
					//var_dump($vec_visitados[$origen]);
					//echo "------------------------";
				}
				else{
					
					echo "<br> $vec esta muy lejos de la ruta <br>";
					//hay que buscar otro vecino 
					$vec_visitados[$v][]=$vec;
					echo "<br> vectores visitados por $v";
					var_dump($vec_visitados[$v]);
					echo "<br> vectores vecinos de $v";
					var_dump($vec_de[$v]);
					//si no hay mas vecinos hay que volver atras , actualizar la ruta ,v y la distancia 
					
					//si se vuelve al incicio y este no tiene mas vecinos disponibles se 
					//recorrieron todas las rutas
				 	
				 	//un foreach para evaluar si no hay mas vecinos
				 	$retroceder=TRUE;
					echo "<br> r es:";
					print_r($r);
				 	foreach($vec_de[$v] as $k=>$l){
				 		echo "<br> $l esta en la ruta";
					var_dump(in_array($l,$r));
						echo "<br> $l ya fue visitado desde $v";
					var_dump(in_array($l,$vec_visitados[$v]));
				 		if(!in_array($l,$r)&&!in_array($l,$vec_visitados[$v])){
				 			echo "<br> l es:$l";
				 			$retroceder=FALSE;
							echo "<br> esta en el if de retroceder |retroceder= ";
							var_dump($retroceder);
				 		};
				 	};
				 	
					
					if($retroceder){
							
						//se calcula la cantidad de nodos de la ruta
						
						$n_nodos=count($ruta[$n_ruta]["nodos"]);
						$x=$ruta[$n_ruta]["nodos"][$n_nodos-2];
						$y=$ruta[$n_ruta]["nodos"][$n_nodos-1];
						
						
						if ($result = mysqli_query($conexion,"SELECT `$y` 
															FROM floywar 
															WHERE origen_destino='$x'"
															)){
				    		
							$fila = mysqli_fetch_row($result);
							$dist_borrar=$fila[0];

							mysqli_free_result($result);
							
						}else {
						    echo "Error: <br>" . mysqli_error($conexion);	
						};
						
						//se corta la distancia
						$ruta[$n_ruta]["distancia"]=$ruta[$n_ruta]["distancia"]+$dist_borrar;
						
						//se borra el ultimo nodo
						array_pop($ruta[$n_ruta]["nodos"]);
						
						//se actualiza v
						$v=$x;
						echo "<br>";
						echo "v al final del recorte de ruta es $v";
						echo "<br> vectores visitados por $v";
						var_dump($vec_visitados[$v]);
						
					};
					
				};
				
			//se buscan los vecinos de v de ser necesario
			if(empty($vec_de[$v])){
			
			
			$vec_visitados[$v]=array();
			
			$select="SELECT destino,largo,seguridad FROM callep2 WHERE origen = '$v'";
				
			if ($result = mysqli_query($conexion,$select)) {
					

						
				//se entra en un while para pasar por todas las filas
				while ($row = mysqli_fetch_assoc($result)) {
				  		
					$vecinos_de[$v][]=array("vecino"=>$row["destino"],
													"largo"=>$row["largo"],
													"seguridad"=>$row["seguridad"])
													;						
				
					$vec_de[$v][]=$row["destino"];    
				}
			};
			
			//Tomando las calles como reversibles
			$select="SELECT origen,largo,seguridad FROM callep2 WHERE destino = '$v'";
				
			if ($result = mysqli_query($conexion,$select)) {
					
				//printf("Select returned %d rows.<br>" , mysqli_num_rows($result));
					
					
				//se entra en un while para pasar por todas las filas
				while ($row = mysqli_fetch_assoc($result)) {

					$vecinos_de[$v][]=array("vecino"=>$row["origen"],
										"largo"=>$row["largo"],
										"seguridad"=>$row["seguridad"])
										;						
				    $vec_de[$v][]=$row["origen"];  
				}
			};
		};
			
	
		//};

	// un if para decidir si se siguen buscando rutas, a partir de si quedan nodos libres en el origen 
	//y si se llego al destino por ultima ves

//echo "<br> disponibles:";
//print_r($vec_disp);
$seguir_buscando=TRUE;

if($v==$destino){
	echo"<br> LLEGO AL DESTINO<br>";
	if($vec_disp[$origen]==0){
		echo"<br> no sigue buscando<br>";
			
		
		$seguir_buscando=FALSE;
			foreach($vec_disp as $i=>$j){
		
			if($i!=$origen){
			
				$vec_visitados[$i]=array();
			};
		
		};
			
	}
	else{
		echo"<br> sigue buscando<br>";
		$n_ruta++;
		$seguir_buscando=TRUE;
		$v=$origen;
		$ruta[$n_ruta]=array("numero"=>'',
			"nodos"=>array(),
			"distancia"=>'',
			"seguridad"=>''
					);
						
		$ruta[$n_ruta]["nodos"][]=$origen;
		
		};

				
};
echo "<br> ruta: <br>";
print_r($ruta[$n_ruta]["nodos"]);
//print_r($ruta[1]);

};
//while($seguir_buscando);



?>