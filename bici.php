<?php
		echo "<p>Pagina de PHP<p>";
		$origen=$_GET["origen"];
		$destino=$_GET["destino"];
		
		echo "<br>Caractresiticas de variable origen: ",var_dump($origen),"<br>";
		echo "<br>Nodo de origen= ",$origen,"<br>";
		echo "<br>Caractresiticas de variable destino: ",var_dump($destino),"<br>";
		echo "<br>Nodo de destino= ",$destino,"<br>";
		
		settype($origen, "integer");
		settype($destino,"integer");
		echo "<br>Caractresiticas de variable origen: ",var_dump($origen),"<br>";
		echo "<br>Nodo de origen= ",$origen,"<br>";
		echo "<br>Caractresiticas de variable destino: ",var_dump($destino),"<br>";
		echo "<br>Nodo de destino= ",$destino,"<br>";
		

		
		//algoritmo ruta mas corta dijkstra
		
		//algoritmo floyd warshall
		
?>