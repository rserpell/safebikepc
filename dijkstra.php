<?php

    $conexion = mysqli_connect("localhost", "rodrigo", "serpell","bicicleta");
	
    if (!$conexion) {
    echo "No pudo conectarse a la BD: " . mysql_error();
 	};
	
	//inciando variables
	
	$origen=1;
	$destino=2;
	$camino=array();
	$nodos=array();
	$nodos_completos=array();
	$distancia=0;
	$dist_temp=0;
	
	//llamar distancia minima entre origen y destino del viaje desde floywar
	
	if ($result = mysqli_query($conexion,"SELECT `$destino` FROM floywar WHERE origen_destino='$origen'")) {
    				
		$fila = mysqli_fetch_row($result);
		$distancia_minima=$fila[0]+1;
		mysqli_free_result($result);
	
	}else {
    	echo "Error: <br>" . mysqli_error($conexion);
	};
	
		
	$v=$origen;
	
	//inicio del bucle
	
	do{
		
		//buscando los vecinos de v
		
		$select="SELECT destino,largo FROM callep2 WHERE origen = '$v'";
		
		if ($result = mysqli_query($conexion,$select)) {
			
		    printf("Select returned %d rows.<br>" , mysqli_num_rows($result));
			
			
			//el array donde guardar los vecinos de los nodos, asociado con la distancia a cada uno
			$vecinos_de[$v]=array();
			
			//se entra en un while para pasar por todas las filas
		  	while ($row = mysqli_fetch_assoc($result)) {
		  		
				array_push($vecinos_de[$v],array("destino"=>$row["destino"],"largo"=>$row["largo"]));						
		    
			}
		}
		
		echo "<br> los vecinos de v son<br>";		
		var_dump($vecinos_de[$v]);
		
		//recorrer los nodos vecinos de v
		
		$quedan_nodos_vecinos=TRUE; //asuemiendo que todos tienen a lo menos un nodo vecino
		
		while($quedan_nodos_vecinos){
			
			foreach ($vecinos_de[$v] as $id => $vecino) {
			
			
			echo "<br> dentro del for each vecinos <br>";	
			var_dump($vecino["destino"]);
			
					//decidir si el nodo vecino esta completo
					
					if(!in_array($vecino["destino"],$nodos_completos)){
					
						//decidir si el camino desde origen al vecino es el optimo 
						$vec=$vecino["destino"];
						if ($result = mysqli_query($conexion,"SELECT `$vec` FROM floywar WHERE origen_destino='$origen'")){
		    				
							$fila = mysqli_fetch_row($result);
							//var_dump($fila);
							$min_origen_vecino=$fila[0]+1;
							mysqli_free_result($result);
			
						}else {
		    				echo "Error: <br>" . mysqli_error($conexion);
						};
						
						$dist_temp=$dist_temp+$vecino["largo"];
						
						if($dist_temp<$min_origen_vecino){
							
							//el algoritmo esta en un optimo
							
							$quedan_nodos_vecinos=TRUE;
							unset($vecinos_de[$v][$id]);
		
						}else{
					
						};
		
					}else{
						
					array_push($nodos_completos,$v);
					$quedan_nodos_vecinos=FALSE;
					};
				
				
			};
		};
		
				
		//se almacena el nodo recien completado
		array_push($nodos_completos,$v);
		
		//ingresar el nodo al camino
		array_push($camino,$vecino_mas_cercano);
		
		$distancia=$distancia+$largo;
		$v=$vecino_mas_cercano;
		
	}while($v!=$destino&&$distancia>$distancia_minima);
	
	
	
	
	//var_dump($camino);
	//var_dump($min);
	//$array = ['a', 'b', 'c'];
	//$key = array_search('a', $array);
	
	
	
?>