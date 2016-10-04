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
						
	//---------------
	$distancia_calles=array(
		"a" => array(126.7,130.7,132.6,223.2,85.1,177.4,88.3,424.9,98.4,182.8), 	
		"b" => array(38.8,139.1,35.8,145.2,72,159.7,114.4),
		"c" => array(126.1),
		"d" => array(123.8),
		"e" => array(54.9,54.4,60.6,56.6),
		"f" => array(123.2,130.7,139.4),
		"g" => array(130.7),
		"h" => array(40.8,67.9,66.2,42.4),
		"i" => array(138,138.8,170.3,89.6,78,84.4,340.3),
		"k" => array(133.8,188.9,124.5,173,87.2),
		"l" => array(39.1,135.8,44.4,47,153,87),
		"m" => array(85.1,141.1,91.1,134.8),
		"n" => array(101.6,67.4,65.2,89.6,29.7,62.9),
		"o" => array(170.3),
		"p" => array(119.3),
		"q" => array(92.6,83.5,58.2,119.3),
		"r" => array(88.2,146.5,119.5,32.5,129.3,116.1,180.9),
		"s" => array(89.6,73.2,82.5),
		"t" => array(100.6,204.3),
		"u" => array(175.2,138.3,88.4,43.2,88,101.4,62.6,42.8,33.7),
		"v" => array(217.7),
		"w" => array(171.2,155.9,78.9),
		"x" => array(100,98.6,93,77.5),
		"y" => array(208.9,176.8,90,98.5,72.1,65,65),
		"z" => array(85.9,162.7,64.5),
		"aa" => array(168.7,158.6,166.3,161.9,92.6,138.2,65.4),
		"ab" => array(58.6,166.3,226.9),
		"ac" => array(106.9,157.8,224),
		"ad" => array(131.8,167.8,220.4),
		"ae" => array(42.3,177.1),
		"af" => array(267,47.8,327.7,334.2,123.3,91.9,195.1,163,122.7,157.3),
		"ag" => array(465),
		"ah" => array(268.9),
		"aj" => array(167.1,78.4,204,124.6,211.9,235.4,98.5),
		"ak" => array(154.7,119.5,177.3),
		"al" => array(185.6,129.8),
		"am" => array(116.2,129.6),
		"an" => array(129.8),
		"ao" => array(143.7,130.8,165.7,208),
		"ap" => array(253.9),
		"aq" => array(196.1,66.8),
		"ar" => array(218.1),
		"as" => array(191.9),
		"at" => array(194,251.3,157.7,99.9,220.5,53.6),
		"au" => array(245.9),
		"av" => array(136.8,95,232.5),
		"aw" => array(335.6),
		"ax" => array(324,176),
		"ay" => array(214,363.1),
		"az" => array(106,284,287),
						);
	//---------------						
	//se agrega nombre real de las calles
		$nombre_real=array(
		"a" => "pablo neruda", 	
		"b" => "ines de suarez",
		"c" => "tiburcio chandia",
		"d" => "placido villarroel",
		"e" => "juan ignacio bolivar",
		"f" => "arturo perez canto",
		"g" => "carlos morales",
		"h" => "ignacio carrera pinto",
		"i" => "lago todos los santos",
		"k" => "lago caburga",
		"l" => "javiera carrera",
		"m" => "lago calafquen",
		"n" => "tiburcio saavedra",
		"o" => "lago pullinque o lago pellaifa",
		"p" => "yulton o rosselot",
		"q" => "lago lanalhue",
		"r" => "olimpia",
		"s" => "lago llanquihue",
		"t" => "lago riñihue",
		"u" => "paula jaraquemada",
		"v" => "parque nacional san rafael",
		"w" => "francisco miranda",
		"x" => "los armiños",
		"y" => "parque nacional huerquehue",
		"z" => "javiera carrera",
		"aa" => "isabel riquelme",
		"ab" => "manantial",
		"ac" => "tiburcio ortega o monserrat",
		"ad" => "parque nacional los paraguas",
		"ae" => "pasaje b",
		"af" => "las encinas",
		"ag" => "bucalemu",
		"ah" => "bosque grande",
		"aj" => "simon bolivar",
		"ak" => "parque nacional quitraco",
		"al" => "pasaje jahuel",
		"am" => "quitral",
		"an" => "las bergonias",
		"ao" => "paula jaraquemada",
		"ap" => "entrada german becker",
		"aq" => "municipal",
		"ar" => "municipal",
		"as" => "san eugenio",
		"at" => "uruguay",
		"au" => "los crisantemos",
		"av" => "montevideo",
		"aw" => "entrada ufro",
		"ax" => "candelaria",
		"ay" => "calles de la ufro",
		"az" => "francisco salazar",
		
				
		);
		
$especiales=array(		
"i1" => "gabriel silva",		
"y1" => "los ciervos",
"az2" => "millahue",												
"i7"=>"salida de german becker"			
);

$query="DROP TABLE IF EXISTS callep2";	
if (mysqli_query($conexion,$query)){
		
		echo "Tabla callep2 antigua borrada";
		}
	else {
    	echo "Error: " . $q . "<br>" . mysqli_error($conexion);
		};

$crear="CREATE TABLE callep2 (
 id mediumint(8) unsigned default null auto_increment,
 nombre varchar(5) not null,
 nombre_real varchar(35) not null,
 origen int(3) not null,
 destino int(3) not null,
 largo float(8,1) not null,
 seguridad float(8,1) default null,
 PRIMARY KEY (id)
)";	

if (mysqli_query($conexion,$crear)){
		
		echo "Tabla callep2 creada";
		}
	else {
    	echo "Error: " . $crear . "<br>" . mysqli_error($conexion);
		};
				
foreach ($nombre_calle as $calle) {
	
	
	$i=count($nodo_calles[$calle]);

	for($j=1;$j<=$i-1;$j++){
		
		$c=$calle;
		//echo "<br>",$calle,"<br>";	
		//echo "$c$j";
		$nombre_t="$c";
		//var_dump($nombre_t);
		//echo "<br>",$nombre_t,"<br>";
		$n_real=$nombre_real[$calle];
		$origen_t=$nodo_calles[$calle][$j-1];
		$destino_t=$nodo_calles[$calle][$j];
		$distancia_t=$distancia_calles[$calle][$j-1];

		$q="INSERT INTO callep2 (nombre, nombre_real, origen , destino , largo )VALUES('$nombre_t','$n_real',$origen_t,$destino_t,$distancia_t)";

	if (mysqli_query($conexion,$q)){
    	//echo "New record created successfully";
		}
	else {
    	echo "Error: " . $q . "<br>" . mysqli_error($conexion);
		};
			
	};
	unset($calle);
	
};

//pasando por las calles mal nombradas
foreach($especiales as $calle=>$new_name){
	$cambiar_calle_real=$select="UPDATE callep2 
						SET  nombre_real = '$new_name' 
						WHERE nombre='$calle'";
				
	if ($result = mysqli_query($conexion,$cambiar_calle_real)){
									
	}
	else {
		echo "Error: <br>" . mysqli_error($conexion);
	};
};


?>