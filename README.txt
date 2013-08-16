Hace unos días me atoraron en un examen con una pregunta que no pude responder en el momento, tuve 20 minutos para responder correctamente y solo logre la mitad del algoritmo. El problema era el siguiente:

# Problema

Crea el algoritmo que regrese las diagonales de una matríz cuadrada.

## Ejemplo:

### Matríz de 4x4

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
    

# Respuesta

Para lograr responder correctamente es necesario encontrar los patrones en el resultado esperado.

### Primer patrón

El primero lo encontramos en la primera columna donde "y" siempre es 0 y "x" incrementa de 1 en uno

![patron 1][1]

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

![patron 2][2]

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

![patron 3][3]

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

![patron 4][4]

    <?php
    for($j = ($x - $y); $j > 0; $j--){
        $y = $c - $j;
        $x = $cc - $y;
        $position[] = $parsePosition($y,$x);
        $values[] = $matrix[$y][$x];
    }
    

Todo esto parece un poco complicado, pero es más facil si lo imaginanos de la siguiente manera:

**Solo es necesario recorer de esta manera el arreglo para sacar sus diagonales**

![matríz][5]

Este ejemlo si que me puse en problemas! si deseas ver el código fuente haz [click][6] aquí o síguenos en [github][7]!

# Algoritmo

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
    

# Ejemplo

    <?php
    
    require_once './lib.php';
    
    $matrix = array(
            array(1,2,3,4),
            array(2,3,4,5),     
            array(3,4,5,6),
            array(4,5,6,7),
        );
    
    print_r(getMatrixDiagonals( $matrix ));


Otras Respuestas
=================

El compa @mayoralito nos mando su respuesta en javascript. Tengo que decir que le quedó bastante bien.

	<!DOCTYPE html>
	<html lang="en">
	<head>
		<title>Matrix NxN</title>
	</head>
	<body>
		<h1>Matrix</h1>
		
		<p>Ingresa el numero para la matriz cuadrada:</p><input type="text" id="numero" value="4"/>
		<button id="generate" onclick="generateArray(); storedResult();">Generate and show Matrix!</button>
		
		<br/><h2 id="txt_mat">Matriz de NxN</h2>
		<div id="matrixof"></div>

		<br/><h2 >Resultado</h2>
		<br /><div id="result"></div>

	<script type="text/javascript">
	var array = [];

	function generateArray(){

		var number = document.getElementById('numero').value;
		if(isNaN(number)){
			alert('Debes ingresar un valor numerico.');
			return false;
		}

		if(number>28){
			if(!confirm('Ese numero es demaciado largo, puede tomar un poco de tiempo. Quieres continuar?')){
				return false;
			}
		}

		array = [];
		document.getElementById('matrixof').innerHTML = '';
		document.getElementById('txt_mat').innerHTML = 'Matriz de '+number+'x'+number;
		
		
		for(x=0; x<number; x++){
			array.push(new Array());
			for(y=0; y<number; y++){
				array[x].push(y+1);
				document.getElementById('matrixof').innerHTML += y+1 + ' ';
			}
			document.getElementById('matrixof').innerHTML += ' <br/>';
		}	

		return true;
	}

	function storedResult(){
		
		if( array.length<1 || array.length!=[array[0].length]){
			alert('La matriz no es cuadrada o no se ha inicializado.');
			return false;
		}
		
		var output1 = [], output2 = [];
		var line1 = '', line2 = '';

		for(x=0; x<array.length;x++)
		{
			line1 = '';
			for(y=x; y>=0;y--)
				line1 += array[x][y] + ' ';
			output1.push(line1.trim());
		}
		
		var tmp = output1[array.length-1].split(' ');
		for(x=0; x<tmp.length-1; x++){
			line2 = '';
			for(y=0; y<tmp.length-(x+1); y++)
				line2 += tmp[y] + ' ';
			output2.push(line2.trim());
		}

		document.getElementById('result').innerHTML = output1.join('<br />').trim() + '<br/>' + output2.join('<br />');
		return true;
	}


	</script>
	</body>
	</html>

	
    

## Se aceptan mejoras y consejos xD

# Keep Coding!

 [1]: http://i.imgur.com/FS2E8kY.png
 [2]: http://i.imgur.com/LzYWHZA.png
 [3]: http://i.imgur.com/OKodvsL.png
 [4]: http://i.imgur.com/UDtQecR.png
 [5]: http://i.imgur.com/dAmIXwT.png
 [6]: https://github.com/phpmx/matrix-diagonals
 [7]: https://github.com/phpmx