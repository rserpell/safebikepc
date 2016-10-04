<?php
    $conexion = mysqli_connect("localhost", "rodrigo", "serpell","bicicleta");

if (!$conexion) {
    echo "No pudo conectarse a la BD: " . mysql_error();
 	};
	if ($result = mysqli_query($conexion,"SELECT MAX(origen) AS origen FROM callep2")) {
		
	$fila = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$max1=$fila["origen"];
   
   mysqli_free_result($result);
};
if ($result = mysqli_query($conexion,"SELECT MAX(destino) AS destino FROM callep2")) {
		
	$fila = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$max2=$fila["destino"];
   
   mysqli_free_result($result);
};
//numero de nodos
$n_max=max($max1,$max2);



	$origen=1;
	$destino=9;
	$grafo=array();
	$seg=array();
	$dist=array();
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
		
		//array donde guardar los vecinos que ya fueron visitados
		$origen_de=array();
		$visitados_de=array();
		$distancia=array();
		
		
	//acotando el grafo en funcion de la distancia maxima
	for($n=1;$n<=$n_max;$n++){
		
				//limitando el grafo para que n no este muy lejos del origen 
				
				if ($result = mysqli_query($conexion,"SELECT `$n` FROM floywar WHERE origen_destino='$origen'")){
				    		
					$fila = mysqli_fetch_row($result);
					//echo "<br> fila es: <br>";
					//var_dump($fila);
					$dist_org_n=$fila[0];
					//var_dump($dist_v_dest);
					mysqli_free_result($result);
					
				}else {
				    echo "Error: <br>" . mysqli_error($conexion);	
				};
				//limitando el grafo para que n no este muy lejos del destino
				
				if ($result = mysqli_query($conexion,"SELECT `$n` FROM floywar WHERE origen_destino='$destino'")){
				    		
					$fila = mysqli_fetch_row($result);
					//echo "<br> fila es: <br>";
					//var_dump($fila);
					$dist_n_dest=$fila[0];
					//var_dump($dist_v_dest);
					mysqli_free_result($result);
					
				}else {
				    echo "Error: <br>" . mysqli_error($conexion);	
				};
			
			$f=1.5;
			$dist_max=$f*$dist_minima;
			$d=$dist_org_n+$dist_n_dest;
			
			if($d<=$dist_max){
				$grafo[]=$n;
			};
		
	};		
		
		
		
?>