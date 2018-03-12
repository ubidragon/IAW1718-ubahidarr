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


    if (isset($_GET["back"])) {
        $cookiesMem = array(1 => $_COOKIE["marca"], 2 => $_COOKIE["modelo"], 3 => $_COOKIE["age"], 4 => $_COOKIE["sales"]);
        $status = 1;
        while ($status < count($cookiesMem)) {

            if (!isset($cookiesMem[$status])) {
                $status--;
                $cookie = getCookie($status);
                setcookie($cookie, false);

                $status = (count($cookiesMem) - 1);

            }
            $status++;
        }
        /*
        $status = 1;
         while ($status < count($cookiesMem)){
            $msg = $cookiesMem[$status];
            if($cookiesMem[$status] == false ){
                $msg = "**";
            }
            echo $msg;
            $status++;
         }
         */
        

    }


    if (!isset($_GET["marca"]) && isset($_GET["modelo"])==false && !isset($_GET["age"]) && !isset($_GET["sales"]) && !isset($_GET["buscar"])) {
        $html = '<select name="marca">' . selectBrand() . '</select>';
        $html .= "<select disabled name='modelo'>
            <option>No disponible</option>
            </select>
            <select disabled name='age'>
            <option>No disponible</option>
            </select>
            <select disabled name='sales'>
            <option>No disponible</option>
            </select> </fieldset>
            <input type='submit' value='Siguiente'>";
    } else if (isset($_GET["marca"]) && !isset($_GET["modelo"]) && !isset($_GET["age"]) && !isset($_GET["sales"]) && !isset($_GET["buscar"])) {

        $marca = $_GET["marca"];
        setcookie("marca", $marca);
        $html = "$marca \t";
        $html .= "<select name='modelo'>" . selectModel($marca) . "
            </select><select disabled name='age'>
            <option>No disponible</option></select>
            <select disabled name='sales'><option>No disponible</option>
            </select> </fieldset>
             <input name='back' type='submit' value='Anterior'>
              <input type='submit' value='Siguiente'>";
    } else if (isset($_COOKIE["marca"]) && isset($_GET["modelo"]) && !isset($_GET["age"]) && !isset($_GET["sales"]) && !isset($_GET["buscar"])) {

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
            </select></fieldset>
             <input name='back' type='submit' value='Anterior'>
              <input type='submit' value='Siguiente'> ";
    } else if (isset($_COOKIE["marca"]) && isset($_COOKIE["modelo"]) && isset($_GET["age"]) && !isset($_GET["sales"]) && !isset($_GET["buscar"])) {
        $marca = $_COOKIE["marca"];
        $modelo = $_COOKIE["modelo"];
        $age = $_GET["age"];
        setcookie("age", $age);
        $html = " $marca\t-\t";
        $html .= " $modelo\t-\t";
        $html .= insertAge($age) . "\t-\t";
        $html .= "<select  name='sales'>
            <option value=1> Menos de 1000 </option>
            <option value=2> Entre 1000 y 3000 </option>
            <option value=3> Entre 3000 y 6000</option>
            <option value=4> Mas de 6000</option>
            </select></fieldset>
             <input name='back' type='submit' value='Anterior'>
              <input type='submit' value='Siguiente'>";
    } else if (isset($_COOKIE["marca"]) && isset($_COOKIE["modelo"]) && isset($_COOKIE["age"]) && isset($_GET["sales"])) {
        $marca = $_COOKIE["marca"];
        $modelo = $_COOKIE["modelo"];
        $age = $_COOKIE["age"];
        $sales = $_GET["sales"];
        setcookie("sales", $sales);
        $html = " $marca\t-\t";
        $html .= " $modelo\t-\t";
        $html .= insertAge($age) . "\t-\t";
        $html .= insertSales($sales);
        $html .= "<input name='buscar' type='submit' value='Buscar'></fieldset>
             <input name='back' type='submit' value='Anterior'>";
    } else if (isset($_COOKIE["marca"]) && isset($_COOKIE["modelo"]) && isset($_COOKIE["age"]) && isset($_COOKIE["sales"]) && isset($_GET["buscar"])) {
        #$html = "<h1> Entra? </h1>";
        $html .= showCar();
    }


    return $html;

}

function insertAge($age)
{
    $res = "";
    switch ($age) {
        case 1:
            $res = "Menos de 2 años";
            break;
        case 2:
            $res = "Entre 2 y 5 años";
            break;
        case 3:
            $res = "Entre 6 y 10 años";
            break;
        case 4:
            $res = "Mas de 10 años";
            break;

    }

    return $res;
}
function insertSales($age)
{
    $res = "";
    switch ($age) {
        case 1:
            $res = "Menos de 1000";
            break;
        case 2:
            $res = "Entre 1000 y 3000 ";
            break;
        case 3:
            $res = "Entre 3000 y 6000";
            break;
        case 4:
            $res = "Mas de 6000";
            break;

    }

    return $res;
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
    $caso = "TIMESTAMPDIFF(YEAR, Fecha_Compra, NOW()) ";

    switch ($age) {
        case 1:
            $caso .= "< 2";
            break;

        case 2:
            $caso .= ">=2 AND $caso<5 ";
            break;
        case 3:
            $caso .= ">=5 AND $caso<10";
            break;

        case 4:
            $caso .= ">=10 ";
            break;
    }


    return $caso;
}
function selectSales($sales)
{
    global $mysql;
    /*Ejemplo de consulta*/
    $caso = "Precio";

    switch ($sales) {
        case 1:
            $caso .= "< 1000.0";
            break;

        case 2:
            $caso .= ">=1000.0 AND " . $caso . "<3000.0 ";
            break;
        case 3:
            $caso .= ">=3000.0 AND " . $caso . "<6000.0 ";
            break;

        case 4:
            $caso .= ">=6000.0 ";
            break;
    }


    return $caso;
}
function showCar()
{

    global $mysql;
    $consulta = $mysql->query('SELECT Marca from vehiculos where Marca = "'
        . $_COOKIE["marca"] . '" AND Modelo = "'
        . $_COOKIE["modelo"] . '" AND '
        . selectAge($_COOKIE["age"]) . ' AND '
        . selectSales($_COOKIE["sales"]) . ' ;');

    $consulta2 = $mysql->query('SELECT Modelo from vehiculos where Marca = "'
        . $_COOKIE["marca"] . '" AND Modelo = "'
        . $_COOKIE["modelo"] . '" AND '
        . selectAge($_COOKIE["age"]) . ' AND '
        . selectSales($_COOKIE["sales"]) . ' ;');

    $consulta3 = $mysql->query('SELECT Precio from vehiculos where Marca = "'
        . $_COOKIE["marca"] . '" AND Modelo = "'
        . $_COOKIE["modelo"] . '" AND '
        . selectAge($_COOKIE["age"]) . ' AND '
        . selectSales($_COOKIE["sales"]) . ' ;');

    $text = "<table><tr><th>Foto</th>";
    $text .= '<th>Marca</th>';
    $text .= '<th>Modelo</th>';
    $text .= '<th> Precio </th></tr>';

    $fila = $consulta->fetch_assoc();
    $fila2 = $consulta2->fetch_assoc();
    $fila3 = $consulta3->fetch_assoc();
    while ($fila) {
        $text .= "<tr><td><img src='media/" . $_COOKIE["modelo"] . ".jpg' ></td><td>" .
            "{$fila["Marca"]}</td><td>" .
            "{$fila2["Modelo"]}</td><td>" .
            "{$fila3["Precio"]}</td></tr>";

        $fila = $consulta->fetch_assoc();
        $fila2 = $consulta2->fetch_assoc();
        $fila3 = $consulta3->fetch_assoc();
    }
    $text .= "</table> ";


    return $text;
}
function getCookie($status)
{

    $res = "";
    switch ($status) {
        case 1:
            $res = "marca";
            break;
        case 2:
            $res = "modelo";
            break;
        case 3:
            $res = "age";
            break;
        case 4:
            $res = "sales";
            break;

    }

    return res;
}

?>