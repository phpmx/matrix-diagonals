<?php

/**
 * Return matrix diagonals
 *
 * @see Docs at https://github.com/phpmx/matrix-diagonals
 * @author (at)richistron
 * @license MIT
 */
namespace lib\tools;

function getMatrix( $matrix ){
	// line jump
	$lineJump = "\r\n";
	// parse position 
	$parsePosition = function($r,$c){
		return "[{$r}][{$c}]";
	};
	// checamos si la matríz es cuadra
	$cols = count($matrix);
	foreach($matrix as $key => $row) {		
		$rows = count($row);
		if($rows != $cols){
			$e = true;
		}
	}

	// fisrt loop
	$results = array();
	$r = 0;
	$c = 0;			
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
	
	
	// if error
	if (isset($e)){
		echo "something went wrong $lineJump";		
	}else{
		echo print_r($results,true) . $lineJump;
	}
}

