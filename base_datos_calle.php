
<?php

$conexion = mysqli_connect("localhost", "rodrigo", "serpell","bicicleta");

if (!$conexion) {
    echo "No pudo conectarse a la BD: " . mysql_error();
 	};
    
        
    $nombre_calle=array("a","b","c");
	$nodo_calles=array(
		"a" => array(2,4,6), 	
		"b" => array(1,3,5),
		"c" => array(2,3,6)
						);
	$distancia_calles=array(
		"a" => array(10,23), 	
		"b" => array(11,34),
		"c" => array(21,32)
		);
		
		
		
		
foreach ($nombre_calle as $calle) {
	
	
	$i=count($nodo_calles[$calle]);

	for($j=1;$j<=$i-1;$j++){
		
		$c=$calle;
		echo "<br>",$calle,"<br>";	
		echo "$c$j";
		$nombre_t="$c$j";
		var_dump($nombre_t);
		echo "<br>",$nombre_t,"<br>";
		$origen_t=$nodo_calles[$calle][$j-1];
		$destino_t=$nodo_calles[$calle][$j];
		$distancia_t=$distancia_calles[$calle][$j-1];

		$q="INSERT INTO p1_calles (nombre, origen , destino , largo )VALUES('$nombre_t',$origen_t,$destino_t,$distancia_t)";

	if (mysqli_query($conexion,$q)){
    	echo "New record created successfully";
		}
	else {
    	echo "Error: " . $q . "<br>" . mysqli_error($conexion);
		};
			
	};
	unset($calle);

};
?>