<?php

/**
 * Return matrix diagonals
 *
 * @see Docs at https://github.com/phpmx/matrix-diagonals
 * @author (at)richistron
 * @license MIT
 */

namespace lib\x3{
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
		$c = $c;
		$r = $r + 1;	
		for($i = $r; $i < $cols; $i++){
			$position = array();		
			$values = array();		
			$position[] = $parsePosition($i,($c - 1));		
			$values[] = $matrix[$i][($c - 1)];		
			$k = ( $c - ($i) -1 );
			for($j = $k; $j > 0; $j--){
			 	$position[] = $parsePosition(($k +1),$k);
			 	$values[] = $matrix[($k + 1)][$k];
			}
			$results["position"][] = implode(" ", $position);
			$results["values"][] = implode(" ", $values);
		}
		
		
		// if error
		if (isset($e)){
			echo "something went wrong $lineJump";		
		}else{
			echo print_r($results,true) . $lineJump;
		}
	}
}	