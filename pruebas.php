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
$n=10;
//arreglo para almacenar la cantidad de puntos entre dos nodos
$nodos=array();

//creando arreglo de distancia de 1 entre dos nodos continuos

for($i=1;$i<=$n;$i++){
	
	$nodos[$i]=array();
	
};
for($i=1;$i<=$n;$i++){
	

		
		$directo="SELECT destino FROM callep2 WHERE origen = '$i'";
		
			if ($result = mysqli_query($conexion,$directo)){
				
				while ($row = mysqli_fetch_row($result)) {
					
				  		
						$con=$row[0];
						
						
						if($con!=NULL){
							echo"<br> hay conexion directa entre $i y $con<br>";
							$nodos[$i][$con]=2;
							$nodos[$con][$i]=2;
							
							echo"<br> conexiones directa de $i";
							print_r($nodos[$i]);
							echo"<br> conexiones directa de $con";
							print_r($nodos[$con]);
						};
    
				};
				
				mysqli_free_result($result);
						
			}
			else {
				echo "<br> no hay conexion directa<br>";
	    	echo "Error: <br>" . mysqli_error($conexion);
			};
		


};

?>