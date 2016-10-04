<?php

//crear la matriz de distancias nxn

   $conexion = mysqli_connect("localhost", "rodrigo", "serpell","bicicleta");

if (!$conexion) {
    echo "No pudo conectarse a la BD: " . mysql_error();
 	};
	
		
$query="DROP TABLE IF EXISTS matriz";	
if (mysqli_query($conexion,$query)){
		
		echo "\n matriz antigua borrada";
		}
	else {
    	echo "Error: " . $q . "<br>" . mysqli_error($conexion);
		};


$crear="CREATE TABLE matriz (
 id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
 origen_destino int(3) not null
)";	

if (mysqli_query($conexion,$crear)){
		
		echo "\n Tabla matriz creada";
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


if (mysqli_query($conexion,"ALTER TABLE `matriz` ADD `1` INT(3) NULL AFTER `origen_destino`")){
		
		echo "\n matriz agrandada";
		}
	else {
    	echo "Error: " . $agrandar. "<br>" . mysqli_error($conexion);
		};
		
for($i=2;$i<=$n;$i++){

$after=$i-1;
	
//resolver porque no crea las columnas	
$agrandar="ALTER TABLE `matriz` ADD `$i` INT(3) NULL AFTER `$after`";
	
	if (mysqli_query($conexion,$agrandar)){
		
		echo "\n matriz agrandada";
		}
	else {
    	echo "Error: " . $agrandar. "<br>" . mysqli_error($conexion);
		};
};

//hay que crear todas las filas con el nodo de origen en la columna 'origen_destino', falta agregar codgio para que no se creen nodos repetidos
    	
 for($j=1;$j<=$n;$j++){
    		$query = "INSERT INTO matriz (origen_destino) VALUES ($j)";

		if (mysqli_query($conexion, $query)) {
    		echo "nueva fila $j creada";
			} 
		else {
    		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				};	
    	};

?>