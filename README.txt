Hace unos días me atoraron en un examen con una pregunta que no pude responder en el momento, tuve 20 minutos para responder correctamente y solo logre la mitad del algoritmo. El problema era el siguiente:


Problema
===========

Crea el algoritmo que regrese las diagonales de una matriz cuadrada.

## Ejemplo: 

### Matriz de 4x4 

	1 2 3 4
	1 2 3 4
	1 2 3 4
	1 2 3 4

### Resultado esperado
	1
	2 1
	3 2 1
	4 3 2 1
	4 3 2
	4 3
	4

### Vectores del arreglo

	[0][0]
	[0][1] [1][0] 
	[0][2] [1][1] [2][0]
	[0][3] [1][2] [2][1] [3][0]
	[1][3] [2][2] [3][1]
	[2][3] [3][2]
	[3][3]


Respuesta
=========

Para lograr responder correctamente es necesario encontrar los patrones en el resultado esperado. 

### Primer patrón

El primero lo encontramos en la primera columna donde "y" siempre es 0 y "x" incrementa de 1 en uno

![patron 1](http://i.imgur.com/FS2E8kY.png)

	<?php
	// fisrt loop
	$r = 0;
	$c = 0;			
	for ($c = 0; $c < $cols; $c++) {		
		$position = array();				
		$values = array();
		$position[] = $parsePosition($r,$c);
		$values[] = $matrix[$r][$c];				
		$results["position"][] = implode(" ", $position);			
		$results["values"][] = implode(" ", $values);	
	}

### Segundo patrón

Podemos ver que "y" comienza en 1 e incremanta en 1 cada vez, "x" permanece con el valor 3 siempre

![patron 2](http://i.imgur.com/LzYWHZA.png)

	<?php
	$r = $r + 1;
	$cc = $c;	
	for($i = $r; $i < $cols; $i++){
		$position = array();		
		$values = array();		
		$y = $i;
		$x = $c - 1;
	 	$position[] = $parsePosition($y,$x);
	 	$values[] = $matrix[$y][$x]; 	
		$results["position"][] = implode(" ", $position);
		$results["values"][] = implode(" ", $values);
		$cc++;
	}

### Tercer patrón

Su posición en "x" es igual a la sumatoria de sus campos, eso nos ayuda a determinar el loop hacia "x" sobre "y"

![patron 3](http://i.imgur.com/OKodvsL.png)

	<?php
	if($c > 0){	
		$k = $c;
		for($i = $k; $i > 0; $i--){
			$x = $i - 1;
			$y = $k - $i + 1;
		 	$position[] = $parsePosition($y,$x);
		 	$values[] = $matrix[$y][$x];
			
		}
	}

### Último patrón

Es igual al patrón 3 pero en "-y"

![patron 4](http://i.imgur.com/UDtQecR.png)

	<?php
	for($j = ($x - $y); $j > 0; $j--){
		$y = $c - $j;
		$x = $cc - $y;
		$position[] = $parsePosition($y,$x);
		$values[] = $matrix[$y][$x];
	}

Todo esto parece un poco complicado, pero es más facil si lo imaginanos de la siguiente manera:

**Solo es necesario recorer de esta manera el arreglo para sacar sus diagonales**

![matriz](http://i.imgur.com/dAmIXwT.png)

Este ejemlo si que me puso en problemas! si deseas ver el código fuente haz [click](https://github.com/phpmx/matrix-diagonals) aquí o síguenos en [github](https://github.com/phpmx)!


Algoritmo
=========


	<?php
	
	/**
	 * Return matrix diagonals
	 *
	 * @see Docs at https://github.com/phpmx/matrix-diagonals
	 * @author (at)richistron
	 * @license MIT
	 */
	function getMatrixDiagonals( $matrix = array() ){	
		// parse position 
		$parsePosition = function($r,$c){
			return "[{$r}][{$c}]";
		};
		// checamos si la matríz es cuadra
		$cols = count($matrix);
		foreach($matrix as $key => $row) {		
			$rows = count($row);
			if($rows != $cols){
				echo "la raíz no es cuadrada"; exit;
			}
		}
		// results array
		$results = array();
	
		// fisrt loop
		$r = 0;
		for ($c = 0; $c < $cols; $c++) {		
			$position = array();				
			$values = array();
			$position[] = $parsePosition($r,$c);
			$values[] = $matrix[$r][$c];
			if($c > 0){	
				$k = $c;
				for($i = $k; $i > 0; $i--){
					$x = $i - 1;
					$y = $k - $i + 1;
				 	$position[] = $parsePosition($y,$x);
				 	$values[] = $matrix[$y][$x];
					
				}						
			}
			// 					
			$results["position"][] = implode(" ", $position);			
			$results["values"][] = implode(" ", $values);	
		}
	
	
		// Secod loop
		$r = $r + 1;
		$cc = $c;	
		for($i = $r; $i < $cols; $i++){
			$position = array();		
			$values = array();		
			$y = $i;
			$x = $c - 1;
		 	$position[] = $parsePosition($y,$x);
		 	$values[] = $matrix[$y][$x];
		 	for($j = ($x - $y); $j > 0; $j--){
		 		$y = $c - $j;
		 		$x = $cc - $y;
		 		$position[] = $parsePosition($y,$x);
		 		$values[] = $matrix[$y][$x];
		 	}
			$results["position"][] = implode(" ", $position);
			$results["values"][] = implode(" ", $values);
			$cc++;
		}
		// print results				
		return $results;
	}


Ejemplo
=======

	<?php
	
	require_once './lib.php';
	
	$matrix = array(
			array(1,2,3,4),
			array(2,3,4,5),		
			array(3,4,5,6),
			array(4,5,6,7),
		);
	
	print_r(getMatrixDiagonals( $matrix ));


## Se aceptan mejoras y consejos xD 

# Keep Coding!
