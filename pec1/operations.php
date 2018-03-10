<?php
/*Fichero php que almacenara todas las operaciones para realizar*/
 global $mysql ;

function connectBBDD(){
	global $mysql;
	$mysql = new mysqli("127.0.0.1","root","","concesionario");
	return $mysql;
}
function selectBrand(){
 global $mysql;
	$consulta = $mysql->query("SELECT DISTINCT Marca FROM marcamodelo ");
	$text="";
 	$fila=$consulta->fetch_assoc();
                while($fila){
                    $text.= "<option value='{$fila["Marca"]}'>".
                        "{$fila["Marca"]}</option>";
                    $fila=$consulta->fetch_assoc();
                }


	return $text;
}

function selectModel($Marca){
	global $mysql;
	$consulta = $mysql->query("SELECT Modelo FROM marcamodelo WHERE Marca = $Marca ");
	$text="";
 	$fila=$consulta->fetch_assoc();
                while($fila){
                    $text.= "<option value='{$fila["Modelo"]}'>".
                        "{$fila["Modelo"]}</option>";
                    $fila=$consulta->fetch_assoc();
                }


	return $text;
}
function selectAge($age){
	global $mysql;
	$consulta = $mysql->query("SELECT  FROM marcamodelo WHERE Marca = $Marca ");
	$text="";
 	$fila=$consulta->fetch_assoc();
                while($fila){
                    $text.= "<option value='{$fila["Modelo"]}'>".
                        "{$fila["Modelo"]}</option>";
                    $fila=$consulta->fetch_assoc();
                }


	return $text;
}
function selectSales($precio){
	$consulta="";
}

?>