<?php

/**
 * Return matrix diagonals
 *
 * @see Docs at https://github.com/phpmx/matrix-diagonals
 * @author (at)richistron
 * @license MIT
 */

namespace lib\tools;

require_once './lib.php';

$matrix = array(
		array(1,2,3,4),
		array(2,3,4,5),		
		array(3,4,5,6),
		array(4,5,6,7),
	);

/*
	Matriz cuadrada 3x3

	Resultado esperado:
	--------
	1
	2 2
	3 3 3
	4 4 4 4
	5 5 5
	6 6
	7
	---------
	[0][0]
	[0][1] [1][0] 
	[0][2] [1][1] [2][0]
	[0][3] [1][2] [2][1] [3][0]
	[1][3] [2][2] [3][1]
	[2][3] [3][2]
	[3][3]
*/

getMatrix( $matrix );