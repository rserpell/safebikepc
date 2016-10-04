<?php
  
  
  $conexion = mysqli_connect("localhost", "rodrigo", "serpell","bicicleta");

if (!$conexion) {
    echo "No pudo conectarse a la BD: " . mysql_error();
    
};

$query="INSERT INTO p1_calles(nombre,origen,destino,largo)
					VALUES('a',1,2,12)";

//$prueba="SELECT * FROM 'p1_calles'";
//print_r(mysqli_query($conexión, $prueba));

$q="INSERT INTO p1_calles (nombre, origen , destino , largo )
					VALUES('a',1,2,12)";
if (mysqli_query($conexion,$q)){
    echo "New record created successfully";
}
else {
    echo "Error: " . $q . "<br>" . mysqli_error($conexion);
};
?>