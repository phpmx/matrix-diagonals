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
		array(1,2),
		array(2,3),		
	);

/*
	Matriz cuadrada 2x2

	Resultado esperado:
	--------
	1
	2 2
	3
	---------
	[0][0]
	[0][1] [1][0]
	[1][1]
*/
getMatrix( $matrix );