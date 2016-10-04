<?php
    $conexion = mysqli_connect("localhost", "rodrigo", "serpell","bicicleta");

if (!$conexion) {
    echo "No pudo conectarse a la BD: " . mysql_error();
 	};
	
		
$query="DROP TABLE IF EXISTS floywar";	
if (mysqli_query($conexion,$query)){
		echo "\n matriz floywar antigua borrada";
		}
	else {
    	echo "Error: " . $query . "<br>" . mysqli_error($conexion);
		};


$crear="CREATE TABLE floywar (
 id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
 origen_destino int(3) not null
)";	

if (mysqli_query($conexion,$crear)){
		
		echo "\n Tabla floywar creada";
		}
	else {
    	echo "Error: " . $crear. "<br>" . mysqli_error($conexion);
		};
		
//encontrar cantidad de nodos
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
echo "<br>$n<br>";
//----------------

//hay que agregar las columnas de 1 hasta n


if (mysqli_query($conexion,"ALTER TABLE `floywar` ADD `1` INT(3) NULL AFTER `origen_destino`")){
		
		echo "\n floywar agrandada";
		}
	else {
    	echo "Error: " . "ALTER TABLE `floywar` ADD `1` INT(3) NULL AFTER `origen_destino`". "<br>" . mysqli_error($conexion);
		};
		
for($i=2;$i<=$n;$i++){

$after=$i-1;
	
//resolver porque no crea las columnas	
$agrandar="ALTER TABLE `floywar` ADD `$i` INT(3) NULL AFTER `$after`";
	
	if (mysqli_query($conexion,$agrandar)){
		
		echo "\n floywar agrandada";
		}
	else {
    	echo "Error: " . $agrandar. "<br>" . mysqli_error($conexion);
		};
};

//hay que crear todas las filas con el nodo de origen en la columna 'origen_destino', falta agregar codgio para que no se creen nodos repetidos
    	
 for($j=1;$j<=$n;$j++){
    		$query = "INSERT INTO floywar (origen_destino) VALUES ($j)";

		if (mysqli_query($conexion, $query)) {
    		echo "nueva fila $j creada";
			} 
		else {
    		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				};	
    	};
		
unset($dato);

// definiendo la distancia de i a i = 0
for($i=1;$i<=$n;$i++){
	
	$dato ="UPDATE floywar 
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

//se traspasan los datos de las calles para inicializar la matriz


?>