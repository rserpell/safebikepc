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
$n=max($max1,$max2);


//limite de tiempo maximo
set_time_limit(2400);

for($k=1;$k<=$n;$k++){
	
	for($i=1;$i<=$n;$i++){
		
		for($j=1;$j<=$n;$j++){
		//distancia de i a k
		$query_i_k=$select="SELECT `$k` FROM floywar WHERE origen_destino = '$i'";
		
			if ($result = mysqli_query($conexion,$query_i_k)){
				
						$row = mysqli_fetch_row($result);
						$dist_i_k=$row[0];
						mysqli_free_result($result);
			}
			else {
	    	echo "Error: " . $selec . "<br>" . mysqli_error($conexion);
			};
		//distancia de k a j
		$query_k_j="SELECT `$j` FROM floywar WHERE origen_destino = '$k'";
		
			if ($result = mysqli_query($conexion,$query_k_j)){
				
						$row = mysqli_fetch_row($result);
						$dist_k_j=$row[0];
						mysqli_free_result($result);
			}
			else {
	    	echo "Error: <br>" . mysqli_error($conexion);
			};
			
		//distancia de i a j
		$query_i_j=$select="SELECT `$j` FROM floywar WHERE origen_destino = '$i'";
		
			if ($result = mysqli_query($conexion,$query_i_j)){
				
						$row = mysqli_fetch_row($result);
						//echo "<br> row de $i a $j<br>";
						//var_dump($row);
						$dist_i_j=$row[0];
						//var_dump($dist_i_j);
						mysqli_free_result($result);
			}
			else {
	    	echo "Error: <br>" . mysqli_error($conexion);
			};
			
			if($dist_i_j!=NULL){
				if($dist_i_k!=NULL&&$dist_k_j!=NULL){
					//comparar distancia actual con i a k +k a j
					$dt=$dist_i_k+$dist_k_j;
					
					if($dist_i_j>$dt){
						//cambiar dato en la base de datos
						//echo "<br> se actualizara el dato $i , $j";
						$cambiar_camino=$select="UPDATE floywar 
												SET  `$j` = '$dt' 
												WHERE origen_destino='$i'";
		
						if ($result = mysqli_query($conexion,$cambiar_camino)){
							
							//echo "<br> distancia cambiada";
							//mysqli_free_result($result);
						}
						else {
	    				echo "Error: <br>" . mysqli_error($conexion);
						};
					};
				}
			}
			else{
				if($dist_i_k!=NULL&&$dist_k_j!=NULL){
					//asiganar distancia de i a j como la suma de i a k +k a j
					
					//echo "<br> se actualizara el dato $i , $j (ahora pasara por $k)";
					$dt=$dist_i_k+$dist_k_j;
					$cambiar_camino="UPDATE floywar 
												SET  `$j` = '$dt' 
												WHERE origen_destino='$i'";
		
					if ($result = mysqli_query($conexion,$cambiar_camino)){
						//echo "<br> el resultado que arroja error: $result <br>";
						//mysqli_free_result($result);
						echo "<br> distancia cambiada";
					}
					else {
	    				echo "Error: <br>" . mysqli_error($conexion);
					};
				}	
			};
		
					
		//$dt=$camino_i_k+$camino_k_j;
							
		//query para modificar el camino minimo
		/*$cambiar_camino ="UPDATE floywar 
				SET  `$nodo_destino` = '$largo' 
				WHERE origen_destino='$origen'";*/	
		}
		
	}
	
}

echo"<br>TERMINO<br>";
	
?>