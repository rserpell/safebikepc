<?php


 $conexion = mysqli_connect("localhost", "rodrigo", "serpell","bicicleta");

if (!$conexion) {
    echo "No pudo conectarse a la BD: " . mysql_error();
 	};

if ($result = mysqli_query($conexion,"SELECT MAX(origen) AS origen FROM callep2")) {
    printf("Select returned %d rows.\n", mysqli_num_rows($result));
		
	$fila = mysqli_fetch_array($result, MYSQLI_ASSOC);
	var_dump($fila);
	echo "<br>",$fila["origen"],"<br>";
	$max1=$fila["origen"];
   
   mysqli_free_result($result);
};
if ($result = mysqli_query($conexion,"SELECT MAX(destino) AS destino FROM callep2")) {
    printf("Select returned %d rows.\n", mysqli_num_rows($result));
		
	$fila = mysqli_fetch_array($result, MYSQLI_ASSOC);
	var_dump($fila);
	echo "<br>",$fila["destino"],"<br>";
	$max2=$fila["destino"];
   
   mysqli_free_result($result);
};

$n=max($max1,$max2);


    for($origen=1;$origen<=$n;$origen++){
    	
	$select="SELECT destino,seguridad FROM callep2 WHERE origen = '$origen'";

	if ($result = mysqli_query($conexion,$select)) {
		//llamada existosa
		
	    //printf("Select returned %d rows.<br>" , mysqli_num_rows($result));
		
		
		//se entra en un while para pasar por todas las filas
	  	while ($row = mysqli_fetch_assoc($result)) {
			
	    	//echo $row["destino"];
			$nodo_destino=$row["destino"];
			$seguridad=$row["seguridad"];
			//settype($largo,"float");

			    	$dato ="UPDATE seg_floywar 
	    					SET  `$nodo_destino` = '$seguridad' 
	    					WHERE origen_destino='$origen'";
					
	    	if (mysqli_query($conexion,$dato)){
			
				echo "\n $dato ingresado". "<br>" ;
				}
			else {
	    		echo "Error: " . $dato . "<br>" . mysqli_error($conexion);
				};
	    	$dato_inverso ="UPDATE seg_floywar 
	    					SET  `$origen` = '$seguridad' 
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
?>