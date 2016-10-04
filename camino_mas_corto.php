<?php

   $conexion = mysqli_connect("localhost", "rodrigo", "serpell","bicicleta");
	
    if (!$conexion) {
    echo "No pudo conectarse a la BD: " . mysql_error();
 	};
	
	$origen=1;
	$destino=111;
	$camino=array();
	$nodos_completos=array();
	$distancia=0;
	$dist_temp=0;
	
	$v=$origen;
	$camino[]=$origen;
	
do{
	//buscando los vecinos de v		
	$select="SELECT destino,largo FROM callep2 WHERE origen = '$v'";
		
	if ($result = mysqli_query($conexion,$select)) {
			
		printf("Select returned %d rows.<br>" , mysqli_num_rows($result));
			
			
		//el array donde guardar los vecinos de los nodos, asociado con la distancia a cada uno
		$vecinos_de[$v]=array();
			
		//se entra en un while para pasar por todas las filas
		while ($row = mysqli_fetch_assoc($result)) {
		  		
			array_push($vecinos_de[$v],array("vecino"=>$row["destino"],"largo"=>$row["largo"]));						
		    
		}
	};
	
	//Tomando las calles como reversibles
		$select="SELECT origen,largo FROM callep2 WHERE destino = '$v'";
		
	if ($result = mysqli_query($conexion,$select)) {
			
		printf("Select returned %d rows.<br>" , mysqli_num_rows($result));
			
			
		//se entra en un while para pasar por todas las filas
		while ($row = mysqli_fetch_assoc($result)) {
		  		
			array_push($vecinos_de[$v],array("vecino"=>$row["origen"],"largo"=>$row["largo"]));						
		    
		}
	};
	
	//llamando las distancia desde los nodos vecinos al destino
	
		$dist_v_dest=array();
		
		foreach ($vecinos_de[$v] as $id => $vecino) {
			
			$vec=$vecino["vecino"];
			//var_dump($vec);
			if ($result = mysqli_query($conexion,"SELECT `$destino` FROM floywar WHERE origen_destino='$vec'")){
			    		
				$fila = mysqli_fetch_row($result);
				//echo "<br> fila es: <br>";
				//var_dump($fila);
				$dist_v_dest[$vec]=$fila[0];
				var_dump($dist_v_dest);
				mysqli_free_result($result);
				
			}else {
			    echo "Error: <br>" . mysqli_error($conexion);	
			
			
			};
		};
		
		$min=INF;
		foreach($dist_v_dest as $vecino=>$distancia){
				if($distancia<$min){
					$min=$distancia;
					$sig=$vecino;
				};
		};
		
		$camino[]=$sig;
		$v=$sig;
}while($v!=$destino);

echo "<br> camino es: <br>";
print_r($camino);	
	
	
	
?>