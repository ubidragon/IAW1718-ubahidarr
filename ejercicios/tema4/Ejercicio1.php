<?php

/*
Dados  dos  vectores  v1  y  v2  con  n  componentes  cada  uno,  realizar  una  función  que devuelva el producto cruzado de ambos vectores. Se entiende por producto cruzado la suma de los productos del primer elemento de v1 por el último de v2, del segundo de v1 por el penúltimo de v2 y así sucesivamente.
*/
$v1=array(3,4,5);
$v2=array(3,4,5);
$cruzado=array();

for ($i=0; $i < count($v1) ; $i++) { 
	$cruzado[$i]+=$v1[$i]*$v2[count($v1)-$i];
}

echo "El vector 1 es $v1 y el vector 2 es $v2, su producto cruzado es $cruzado"


?>