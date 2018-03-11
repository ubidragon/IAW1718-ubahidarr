<?php
/*Fichero php que almacenara todas las operaciones para realizar*/
global $mysql;

function connectBBDD()
{
    global $mysql;
    session_start();
    $mysql = new mysqli("127.0.0.1", "root", "", "concesionario");
    return $mysql;
}

function desplegables()
{

    $html = "";
    $marca="";
    $modelo="";
    $age="";
    $sales="";


    if(!isset($_GET["marca"]) && !isset($_GET["modelo"]) && !isset($_GET["age"])){
        $html= '<select name="marca">' . selectBrand() . '</select>';
        $html.= "<select disabled name='modelo'>
        <option>No disponible</option>
        </select>
        <select disabled name='age'>
        <option>No disponible</option>
        </select>
        <select disabled name='sales'>
        <option>No disponible</option>
        </select>";
    } else if (isset($_COOKIE["marca"]) && !isset($_GET["modelo"]) && !isset($_GET["age"])) {

        $marca = $_GET["marca"];
        setcookie("marca", $marca);
        $html = "$marca \t";
        $html .= "<select name='modelo'>" . selectModel($marca) . "
		</select>
		<select disabled name='age'>
		<option>No disponible</option>
		</select>
		<select disabled name='sales'>
		<option>No disponible</option>
		</select>";
    } else if (isset($_COOKIE["marca"]) && isset($_GET["modelo"]) && !isset($_COOKIE["age"])) {
        $marca = $_COOKIE["marca"];
        $modelo = $_GET["modelo"];
        setcookie("modelo", $modelo);
        $html = "$marca \t-\t";
        $html .= "$modelo \t";
        $html .= "<select name='age'>
		<option value=1> > 2 años </option>
        <option value=2> 2 - 5 años </option>
        <option value=3> 6 - 10 años </option>
        <option value=4> > 10 </option>
		</select>
		<select disabled name='sales'>
		<option>No disponible</option>
		</select>";
    } else if (isset($_COOKIE["marca"]) && isset($_COOKIE["modelo"]) && isset($_GET["age"])) {
        $marca = $_COOKIE["marca"];
        $modelo = $_GET["modelo"];
        setcookie("modelo", $modelo);
        $html = " $marca\t-\t";
        $html .= " $modelo\t";
        $html .= "<select name='age'>";
        $html .= "<select name='modelo'>
		<option>No disponible</option>
		</select>
		<select name='age'>
		<option>No disponible</option>
		</select>
		<select  name='sales'>
		<option>No disponible</option>
		</select>";
    }

    return $html;

}

function selectBrand()
{
    global $mysql;
    $consulta = $mysql->query("SELECT DISTINCT Marca FROM marcamodelo ");
    $text = "";
    $fila = $consulta->fetch_assoc();
    while ($fila) {
        $text .= "<option value='{$fila["Marca"]}'>" .
            "{$fila["Marca"]}</option>";
        $fila = $consulta->fetch_assoc();
    }


    return $text;
}

function selectModel($marca)
{
    global $mysql;
    $consulta = $mysql->query("SELECT DISTINCT Modelo FROM marcamodelo WHERE Marca = '$marca'");
    $text = "";
    $fila = $consulta->fetch_assoc();
    while ($fila) {
        $text .= "<option value='{$fila["Modelo"]}'>" .
            "{$fila["Modelo"]}</option>";
        $fila = $consulta->fetch_assoc();
    }


    return $text;
}

function selectAge($age)
{
    global $mysql;
    /*Ejemplo de consulta*/
    $caso = "";

    switch ($age) {
        case 1:
            $caso = "< 2";
            break;

        case 2:
            $caso = ">=2 AND TIMESTAMPDIFF(YEAR, Fecha_Compra, NOW())<5 ";
            break;
        case 3:
            $caso = "";
            break;

        case 4:
            $caso = "";
            break;
    }

    $consulta = $mysql->query('SELECT ID,Modelo from vehiculos where TIMESTAMPDIFF(YEAR, Fecha_Compra, NOW()) $caso AND ' . selectModel($_COOKIE["modelo"]));


    $text = "";
    $fila = $consulta->fetch_assoc();
    while ($fila) {
        $text .= "<option value='{$fila["Modelo"]}'>" .
            "{$fila["Modelo"]}</option>";
        $fila = $consulta->fetch_assoc();
    }


    return $text;
}

function selectSales($precio)
{
    global $mysql;
    $rango = "";
    if ($precio < 1000) {
        $rango = "Precio < 1000";
    } elseif ($precio > 1000 && $precio < 3000) {
        $rango = "Precio > 1000 AND Precio < 3000";
    } elseif ($precio > 3000 && $precio < 6000) {
        $rango = "Precio > 3000 AND Precio < 6000";
    } elseif ($precio > 6000) {
        $rango = "Precio > 6000";
    }

    $consulta = $mysql->query("SELECT ID FROM vehiculos WHERE $rango");
    $text = "";
    $fila = $consulta->fetch_assoc();
    while ($fila) {
        $text .= "<option value='{$fila["Precio"]}'>" .
            "{$fila["Precio"]}</option>";
        $fila = $consulta->fetch_assoc();
    }


    return $text;
}

?>