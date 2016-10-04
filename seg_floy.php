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
//$n=max($max1,$max2);
$n=10;
//arreglo para almacenar la cantidad de puntos en una ruta
$nodos=array();

for($i=1;$i<=$n;$i++){
	
	$nodos[$i]=array();
	
};
//creando arreglo de cantidad  de nodos  entre dos nodos continuos
for($i=1;$i<=$n;$i++){
	

		
		$directo="SELECT destino FROM callep2 WHERE origen = '$i'";
		
			if ($result = mysqli_query($conexion,$directo)){
				
				while ($row = mysqli_fetch_row($result)) {
					
				  		
						$con=$row[0];
						
						
						if($con!=NULL){
							
							$nodos[$i][$con]=2;
							$nodos[$con][$i]=2;
							//echo"<br> hay conexion directa entre $i y $con<br>";
						};
    
				};
				
				mysqli_free_result($result);
						
			}
			else {
				echo "<br> no hay conexion directa<br>";
	    	echo "Error: <br>" . mysqli_error($conexion);
			};
							echo"<br> conexiones directa de $i";
							print_r($nodos[$i]);
							echo"<br> conexiones directa de $con";
							print_r($nodos[$con]);		


};



//limite de tiempo maximo
set_time_limit(2400);

for($k=1;$k<=$n;$k++){
	
	for($i=1;$i<=$n;$i++){
		
		for($j=1;$j<=$n;$j++){
		//seguridad de i a k
		$query_i_k=$select="SELECT `$k` FROM seg_floywar WHERE origen_destino = '$i'";
		
			if ($result = mysqli_query($conexion,$query_i_k)){
				
						$row = mysqli_fetch_row($result);
						$seg_i_k=$row[0];
						mysqli_free_result($result);
						
			}
			else {
	    	echo "Error: " . $selec . "<br>" . mysqli_error($conexion);
			};
		//seguridad de k a j
		$query_k_j="SELECT `$j` FROM seg_floywar WHERE origen_destino = '$k'";
		
			if ($result = mysqli_query($conexion,$query_k_j)){
				
						$row = mysqli_fetch_row($result);
						$seg_k_j=$row[0];
						mysqli_free_result($result);
			}
			else {
	    	echo "Error: <br>" . mysqli_error($conexion);
			};
			
		//distancia de i a j
		$query_i_j=$select="SELECT `$j` FROM seg_floywar WHERE origen_destino = '$i'";
		
			if ($result = mysqli_query($conexion,$query_i_j)){
				
						$row = mysqli_fetch_row($result);
						$seg_i_j=$row[0];
						mysqli_free_result($result);
			}
			else {
	    	echo "Error: <br>" . mysqli_error($conexion);
			};
			
			
			//reparar para seguridad en el mismo nodo
			if($seg_i_j!=NULL){
				
				
				if($seg_i_k!=NULL&&$seg_k_j!=NULL){
					//comparar seguridad actual con i a k +k a j
					
					echo"<br>  i=$i , j=$j y k=$k";
					
					$nodos_temp=$nodos[$i][$k]+$nodos[$k][$j]-1;
					
					$seg_temp=($seg_i_k*$nodos[$i][$k]+$seg_k_j*$nodos[$k][$j])/$nodos_temp;
					
					
					if($seg_i_j<$seg_temp){
						//sumar los nodos desde i a k y k a j
						$nodos[$i][$j]=$nodos_temp;
						$nodos[$j][$i]=$nodos_temp;
						
						//cambiar dato en la base de datos
						//echo "<br> se actualizara el dato $i , $j";
						$cambiar_camino=$select="UPDATE seg_floywar 
												SET  `$j` = '$seg_temp' 
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
				if($seg_i_k!=NULL&&$seg_k_j!=NULL){
					//cambiar numero de nodos
						$nodos[$i][$j]=$nodos[$i][$k]+$nodos[$k][$j]-1;
						$nodos[$j][$i]=$nodos[$i][$k]+$nodos[$k][$j]-1;
					
					//asiganar distancia de i a j como la suma de i a k +k a j
					
					//echo "<br> se actualizara el dato $i , $j (ahora pasara por $k)";
					
					$seg_temp=($seg_i_k*$nodos[$i][$k]+$seg_k_j*$nodos[$k][$j])/$nodos[$j][$i];
					$cambiar_camino="UPDATE seg_floywar 
												SET  `$j` = '$seg_temp' 
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
		
					

		}
		
	}
	
}

echo"<br>TERMINO<br>";
	
?>