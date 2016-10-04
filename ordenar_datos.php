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

//seleccionar todas las conecciones del nodo $origen=1

for($i=1;$i<=$n;$i++){
	
	$dato ="UPDATE matriz 
	    			SET  `$i` = '0' 
	    			WHERE origen_destino='$i'";
					
	    	if (mysqli_query($conexion,$dato)){
			
				echo "\n distancia 0 definida en nodo $i". "<br>" ;
				}
			else {
	    		echo "Error: " . $dato . "<br>" . mysqli_error($conexion);
				};
	
}
unset($dato);

for($origen=1;$origen<=$n;$origen++){
	$select="SELECT destino,largo FROM callep2 WHERE origen = '$origen'";

	if ($result = mysqli_query($conexion,$select)) {
		//llamada existosa
		
	    printf("Select returned %d rows.<br>" , mysqli_num_rows($result));
		
		
		//se entra en un while para pasar por todas las filas
	  	while ($row = mysqli_fetch_assoc($result)) {
			
	    	//echo $row["destino"];
			$nodo_destino=$row["destino"];
			$largo=$row["largo"];
			settype($largo,"float");
			//echo $largo;
	    	//echo "<br>",var_dump($row),"<br>";
	    	
			//se incertan los datos
	    	/*$dato ="UPDATE matriz 
	    			SET `$nodo_destino` = '$largo'
	    			WHERE 'origen_destino' = $origen";
			*/
			    	$dato ="UPDATE matriz 
	    			SET  `$nodo_destino` = '$largo' 
	    			WHERE origen_destino='$origen'";
					
	    	if (mysqli_query($conexion,$dato)){
			
				echo "\n $dato ingresado". "<br>" ;
				}
			else {
	    		echo "Error: " . $dato . "<br>" . mysqli_error($conexion);
				};
	    	$dato_inverso ="UPDATE matriz 
	    	SET  `$origen` = '$largo' 
	    	WHERE origen_destino='$nodo_destino'";
					
	    	if (mysqli_query($conexion,$dato_inverso)){
			
				echo "\n $dato_inverso inverso ingresado". "<br>" ;
				}
			else {
	    		echo "Error: " . $dato . "<br>" . mysqli_error($conexion);
				};
		}
		mysqli_free_result($result);
	}
	else {
	    	echo "Error: " . $selec . "<br>" . mysqli_error($conexion);
		};
}






/*$query = "INSERT INTO matriz ($destino)
VALUES ($distancia)";

if (mysqli_query($conexion, $query)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
};


*/
?>