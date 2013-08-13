<?php

/**
 * Return matrix diagonals
 *
 * @see Docs at https://github.com/phpmx/matrix-diagonals
 * @author (at)richistron
 * @license MIT
 */

/*
	Print the diagonals of a matrix.

	Example matrix:

	5 1 6
	2 9 4
	7 3 8

	Expected output:

	5
	1 2
	6 9 7
	4 3
	8	

	[0,0]
	[0,1] [1,0]
	[0,2] [1,1] [2,0]	
	[1,2] [2,1]
	[2,2]
*/

$matrix = array(
		array(5,1,6),
		array(2,9,4),
		array(7,3,8),
	);

// $matrix = array(
// 		array(5,1,6,1),
// 		array(2,9,1,0),
// 		array(7,1,8,0),
// 		array(1,3,8,0),
// 	);

$getMatrix = function( $matrix ){
	// line jump
	$lineJump = "\r\n";
	// checamos si la matríz es cuadra
	$cols = count($matrix);
	foreach($matrix as $key => $row) {		
		$rows = count($row);
		if($rows != $cols){
			$e = true;
		}
	}
	// script
	$results = array();
	$col = 0;
	$row = 0;	
	for ($col = 0; $col < $cols; $col++) {		
		$res = "{$row},{$col}  ";
		// loop
		for ($i = $col; $i > 0;$i--){
			$y = 0;
			$x = $col;
			// center
			if($i == ($cols - 1)){
				$y = ($i - 1);
				$x = ($i - 1);
			}
			$res .= "{$x},{$y}  ";
		}		
		$results[] = $res;
	}

	// second loop	
	$row = 1;
	$cols = 2;
	for ($i = $row; $i <= $cols; $i++) {
		$results[] = "{$i},{$cols}";		
	}
	echo print_r($results,true) . $lineJump;
	// if error
	if (isset($e)){
		echo "something went wrong $lineJump";
		exit;
	}
};


$getMatrix( $matrix );
