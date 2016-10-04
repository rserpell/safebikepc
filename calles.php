<?php
    
/*
	
	//creando calles como arreglos
	/*$origen=array();
	$destino=array();
	$nombre[]=array();
	//definiendo las calles como arreglos partiendo por a
	$origen[0]=1;
	$destino[0]=2;
	$nombre[0]="a1";
	//-----
	$origen[1]=2;
	$destino[1]=7;
	$nombre[1]="a2";
	//-----
	$origen[2]=7;
	$destino[2]=14;
	$nombre[2]="a3";
	//-----
	$origen[3]=14;
	$destino[3]=25;
	$nombre[3]="a4";
	//-----
	$origen[4]=25;
	$destino[4]=26;
	$nombre[4]="a5";
	//-----
	$origen[5]=26;
	$destino[5]=49;
	$nombre[5]="a6";
	//-----
	$origen[1]=49;
	$destino[6]=50;
	$nombre[6]="a7";
	//-----
	$origen[1]=2;
	$destino[2]=7;
	$nombre[7]="a2";
*/
	
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
	//i es la cantidad de nodos en la calle
	$i=count($nodo_calles[$calle]);
	//si hay n nodos en la calle, hay n-1 cuadras en la calle
	$$calle=array();
	//se parte desde el segundo nodo
	for($j=1;$j<=$i-1;$j++){
		//a la calle "nombre calle", se le asignan sus caracteristicas origen, destino y distancia (todo queda almacenado en )
		
		/*
		$$calle[]=array(
			"origen"=>$nodo_calles[$calle][$j-1],
			"destino"=>$nodo_calles[$calle][$j],
			"distancia"=>$distancia_calles[$calle][$j-1]
			);
		*/
		
		array_push($$calle,array(
			$j,
			"origen"=>$nodo_calles[$calle][$j-1],
			"destino"=>$nodo_calles[$calle][$j],
			"distancia"=>$distancia_calles[$calle][$j-1]
			));
		echo"<br>",$j;"<br>";
		
		
		/*$$calle= array(
			$j,
			"origen"=>$nodo_calles[$calle][$j-1],
			"destino"=>$nodo_calles[$calle][$j],
			"distancia"=>$distancia_calles[$calle][$j-1]
			);*/
	};
	unset($calle);
	//luego del for, la info de las calles queda almacenada como: $nombredecalle[parte de la calle]=(parte de la calle,origen,destino,distancia)
};
//var_dump($nombre_calle);
//var_dump($i);
var_dump($a);
echo "<p>",print_r($a[0]),"</p>";
echo "<p>",print_r($a[1]),"</p>";




