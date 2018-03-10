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
	/*Ejemplo de consulta*/
	SELECT ID,Modelo from vehiculos where TIMESTAMPDIFF(YEAR, Fecha_Compra, NOW()) = 2 AND Marca='SEAT' 


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
	global $mysql;
	$rango;
	if($precio<1000){
	$rango = "Precio < 1000";
	}elseif ($precio>1000 && $precio<3000) {
		$rango = "Precio > 1000 AND Precio < 3000";
	}elseif ($precio>3000 && $precio<6000) {
		$rango = "Precio > 3000 AND Precio < 6000";
	}elseif ($precio>6000) {
		$rango = "Precio > 6000";
	}

	$consulta = $mysql->query("SELECT ID FROM vehiculos WHERE $rango");
	$text="";
 	$fila=$consulta->fetch_assoc();
                while($fila){
                    $text.= "<option value='{$fila["Precio"]}'>".
                        "{$fila["Precio"]}</option>";
                    $fila=$consulta->fetch_assoc();
                }


	return $text;
}

?>