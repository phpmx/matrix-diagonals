<?php

/**
 * Return matrix diagonals
 *
 * @see Docs at https://github.com/phpmx/matrix-diagonals
 * @author (at)richistron
 * @license MIT
 */

namespace lib\x3;

require_once './lib.php';

$matrix = array(
		array(1,2,3),
		array(2,3,4),		
		array(3,4,5),
	);

/*
	Matriz cuadrada 3x3

	Resultado esperado:
	--------
	1
	2 2
	3 3 3
	4 4
	5
	---------
	[0][0]
	[0][1] [1][0]
	[0][2] [1][1] [2][0]
	[1][2] [2][1]
	[2][2]
*/

getMatrix( $matrix );