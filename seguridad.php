<?php

$conexion = mysqli_connect("localhost", "rodrigo", "serpell","bicicleta");

if (!$conexion) {
    echo "No pudo conectarse a la BD: " . mysql_error();
 	};



    $nombre_calle=array("a","b","c","d","e","f","g","h","i","k","l","m","n","o","p","q","r","s","t"
    ,"u","v","w","x","y","z","aa","ab","ac","ad","ae","af","ag","ah","aj","ak","al","am","an","ao",
    "ap","aq","ar","as","at","au","av","aw","ax","ay","az");
	
	
	$nodo_calles=array(
		"a" => array(1,2,7,14,25,26,49,50,71,88,100), 	
		"b" => array(1,3,5,11,18,19,36,59),
		"c" => array(3,4),
		"d" => array(5,10),
		"e" => array(2,4,6,10,12),
		"f" => array(11,12,13,17),
		"g" => array(6,9),
		"h" => array(7,8,9,112,13),
		"i" => array(112,16,23,29,46,53,52,72),
		"k" => array(8,15,24,27,48,51),
		"l" => array(14,15,16,17,22,32,33),
		"m" => array(25,24,23,30,31),
		"n" => array(26,27,28,29,43,44),
		"o" => array(28,47),
		"p" => array(46,45),
		"q" => array(49,48,47,53,54),
		"r" => array(50,51,52,70,69,68,75,76),
		"s" => array(44,45,54,70),
		"t" => array(22,30,43),
		"u" => array(18,20,21,32,31,39,40,41,42,55),
		"v" => array(55,66),
		"w" => array(19,35,34,33),
		"x" => array(60,58,37,35,20),
		"y" => array(37,38,56,64,65,66,67,75),
		"z" => array(61,57,38,33),
		"aa" => array(36,58,57,62,63,79,77,76),
		"ab" => array(81,62,56,39),
		"ac" => array(80,63,64,40),
		"ad" => array(78,79,65,42),
		"ae" => array(83,77,67),
		"af" => array(111,104,95,94,82,78,80,81,61,60,59),
		"ag" => array(82,93),
		"ah" => array(94,93),
		"aj" => array(78,83,76,84,85,92,97,101),
		"ak" => array(68,74,86,92),
		"al" => array(84,74,73),
		"am" => array(85,86,87),
		"an" => array(92,91),
		"ao" => array(69,73,87,91,97),
		"ap" => array(72,71),
		"aq" => array(90,89,88),
		"ar" => array(90,98),
		"as" => array(89,99),
		"at" => array(104,103,102,101,98,99,100),
		"au" => array(95,96),
		"av" => array(96,103,105,110),
		"aw" => array(102,106),
		"ax" => array(101,107,108),
		"ay" => array(105,106,107),
		"az" => array(111,110,109,108),
		);
		
		
		$calles_con_cambios=array(
		"a"=>array(1,71,100),
		"b"=>array(1,18,59),
		"i"=>array(112,52,72),
		"r"=>array(50,69,76),
		"y"=>array(37,38,75),
		"af"=>array(59,78,95,111),
		"az"=>array(111,109,108)
		
		);
		
		$coef_de_seguridad=array(
		"a"=>array(array(1,15,0,10),array(2,50,30,30)),
		"b"=>array(array(1,10,0,20),array(2,50,45,30)),
		"c"=>array(2,30,30,20),
		"d"=>array(2,45,30,25),
		"e"=>array(2,45,30,25),
		"f"=>array(2,45,45,20),
		"g"=>array(2,30,30,20),
		"h"=>array(2,45,45,25),
		"i"=>array(array(3,20,20,0),array(1,30,0,0)),
		"k"=>array(3,20,20,0),
		"l"=>array(1,20,0,0),
		"m"=>array(2,30,40,25),
		"n"=>array(2,45,40,30),
		"o"=>array(3,20,20,0),
		"p"=>array(3,20,20,0),
		"q"=>array(2,30,40,25),
		"r"=>array(array(1,20,0,5),array(2,50,40,50)),
		"s"=>array(3,20,35,0),
		"t"=>array(3,20,35,0),
		"u"=>array(2,50,45,30),
		"v"=>array(3,15,20,0),
		"w"=>array(2,30,40,30),
		"x"=>array(3,20,30,0),
		"y"=>array(array(3,20,30,0),array(2,25,40,25)),
		"z"=>array(1,30,0,0),
		"aa"=>array(2,25,40,30),
		"ab"=>array(2,30,40,30),
		"ac"=>array(3,15,30,0),
		"ad"=>array(2,30,45,25),
		"ae"=>array(3,20,30,0),
		"af"=>array(array(2,60,50,40),array(1,20,0,5),array(2,60,50,40)),
		"ag"=>array(2,30,40,15),
		"ah"=>array(2,30,40,15),
		"aj"=>array(1,30,0,15),
		"ak"=>array(2,25,40,15),
		"al"=>array(3,20,30,0),
		"am"=>array(3,20,30,0),
		"an"=>array(2,20,30,15),
		"ao"=>array(2,30,40,20),
		"ap"=>array(1,20,0,10),
		"aq"=>array(3,10,20,0),
		"ar"=>array(3,20,30,0),
		"as"=>array(2,30,30,15),
		"at"=>array(2,60,35,60),
		"au"=>array(3,10,20,0),
		"av"=>array(2,30,40,50),
		"aw"=>array(1,10,0,40),
		"ay"=>array(1,10,0,40),
		"ax"=>array(2,30,30,40),
		"az"=>array(array(2,50,55,30),array(2,20,35,10)),
		
		);

$ruta=array();
foreach ($nombre_calle as $codigo_calle){

	//var_dump($coef_de_seguridad[$codigo_calle][0]);
	$fs=0;
	
	//se determina si la calle es de un solo tipo o es mixta
	if (in_array($codigo_calle,array_keys($calles_con_cambios))){
		$ruta=array();
		$calle=$codigo_calle;
		$nodos=$calles_con_cambios[$codigo_calle];

			$n=0;
			
			//se asocian los coeficientes de seguridad con la ruta respectiva
			foreach($coef_de_seguridad[$calle] as $vec_seg){
				
				$ruta[]=array(
							"nodos"=>array(
									$nodos[$n],$nodos[$n+1]),
							"pos_en_calle"=>array(
											array_search($nodos[$n],$nodo_calles[$calle]),
											array_search($nodos[$n+1], $nodo_calles[$calle])
											),
							"coef_seguridad"=>$vec_seg
								);
			$n++;
			};

				//echo $ruta[0]["pos_en_calles"][0];
				//echo"<br>";
				
				
			
	foreach($ruta as $tramo=>$inf_tramo){
		$x=$inf_tramo["pos_en_calle"][0];
		$y=$inf_tramo["pos_en_calle"][1];

		//se decide cual nodo de la ruta va primero
			if($x<$y){
				//hay que sumar posiciones para seguir la calle

				$seg=$inf_tramo["coef_seguridad"];
				switch ($seg[0]){
					
			    case 1:
			        $fs=50+30*(1-($seg[1])/100)+20*(1-($seg[3])/100);
					//var_dump($fs);
			        break;
			    case 2:
					//factor de seguridad de la velocidad, considerando velocidad maxima de 60 y velocidad segura de 20 km/h
					//no se ha considerado el caso en que los autos vallan a menos de 20				
					$fsv=($seg[2]-20)/(60-20);
			        $fs=30+30*(1-($seg[1])/100)+30*(1-$fsv)+10*(1-($seg[3])/100);
					
					//fs= 30+30*fs_concentracion+30*fs_velocidad+10*fs_concentracion_personas
			        break;
			    case 3:
					
					$fsv=($seg[2]-20)/(60-20);
			        $fs=35+30*(1-($seg[1])/100)+35*(1-$fsv);
					
					//fs=35+35*fsv+30*fs_concentracion
			        break;
			    default:
			       echo "codigo de $codigo_calle mal ingresado";
			}
				
				//hay que subir la info a la base de datos
				$i=$x;
				$j=$y;
				while($i<$j){

					$origen=$nodo_calles[$calle][$i];
					$destino=$nodo_calles[$calle][$i+1];

					$cambiar_seg="UPDATE callep2 
								SET  seguridad = '$fs' 
								WHERE origen='$origen'
								AND destino='$destino'";
		
					if ($result = mysqli_query($conexion,$cambiar_seg)){
									
						//echo "<br> seguridad cambiada";
	
						}
					else {
			    		echo "Error: <br>" . mysqli_error($conexion);
						};
					
					
				$i++;	
				};
				
				
			}
			else{
				//hay que restar posiciones para seguir la calle
				
				$seg=$inf_tramo["coef_seguridad"];
				switch ($seg[0]){
					
			    case 1:
			        $fs=50+30*(1-($seg[1])/100)+20*(1-($seg[3])/100);
					//var_dump($fs);
			        break;
			    case 2:
					//factor de seguridad de la velocidad, considerando velocidad maxima de 60 y velocidad segura de 20 km/h
					//no se ha considerado el caso en que los autos vallan a menos de 20				
					$fsv=($seg[2]-20)/(60-20);
			        $fs=30+30*(1-($seg[1])/100)+30*(1-$fsv)+10*(1-($seg[3])/100);
					//fs= 30+30*fs_concentracion+30*fs_velocidad+10*fs_concentracion_personas
			        break;
			    case 3:
					
					$fsv=($seg[2]-20)/(60-20);
			        $fs=35+30*(1-($seg[1])/100)+35*(1-$fsv);
					//fs=35+35*fsv+30*fs_concentracion
			        break;
			    default:
			       echo "codigo de $codigo_calle mal ingresado";
				}
				
				//hay que subir la info a la base de datos
				$i=$inf_tramo["pos_en_calle"][0];
				$j=$inf_tramo["pos_en_calle"][1];
				while($i>$j){
					
					$origen=$nodo_calles[$calle][$i-1];
					$destino=$nodo_calles[$calle][$i];

					$cambiar_seg="UPDATE callep2 
								SET  seguridad = '$fs' 
								WHERE origen='$origen'
								AND destino='$destino'";
		
					if ($result = mysqli_query($conexion,$cambiar_seg)){
									
						//echo "<br> seguridad cambiada";
	
						}
					else {
			    		echo "Error: <br>" . mysqli_error($conexion);
						};
					
					
				$i=$i-1;	
				};
				
			};
		
	};
	
		
	}
	else{
		
		//determinado que caso es
		//echo "<br> $codigo_calle <br>";
		//var_dump($coef_de_seguridad[$codigo_calle][0]);
		switch ($coef_de_seguridad[$codigo_calle][0]){
				
		    case 1:
		        $fs=50+30*(1-($coef_de_seguridad[$codigo_calle][1])/100)+20*(1-($coef_de_seguridad[$codigo_calle][3])/100);
				//var_dump($fs);
		        break;
		    case 2:
				//factor de seguridad de la velocidad, considerando velocidad maxima de 60 y velocidad segura de 20 km/h
				//no se ha considerado el caso en que los autos vallan a menos de 20				
				$fsv=($coef_de_seguridad[$codigo_calle][2]-20)/(60-20);
		        $fs=30+30*(1-($coef_de_seguridad[$codigo_calle][1])/100)+30*(1-$fsv)+10*(1-($coef_de_seguridad[$codigo_calle][3])/100);
				
				//fs= 30+30*fs_concentracion+30*fs_velocidad+10*fs_concentracion_personas
		        break;
		    case 3:
				
				$fsv=($coef_de_seguridad[$codigo_calle][2]-20)/(60-20);
		        $fs=35+30*(1-($coef_de_seguridad[$codigo_calle][1])/100)+35*(1-$fsv);
				//fs=35+35*fsv+30*fs_concentracion
		        break;
		    default:
		       echo "codigo de $codigo_calle mal ingresado";
		}
		//hay que ingresar el fs a la matriz callep2
				$cambiar_seg="UPDATE callep2 
								SET  seguridad = '$fs' 
								WHERE nombre='$codigo_calle'";
		
			if ($result = mysqli_query($conexion,$cambiar_seg)){
							
				//echo "<br> distancia cambiada";
				//mysqli_free_result($result);
				}
			else {
	    		echo "Error: <br>" . mysqli_error($conexion);
				};
		
	};
	
	
	
	
};
	
?>