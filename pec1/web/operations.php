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
    addInSession();
    switch (status()) {
        case 0:
            $html = '<select name="marca">' . selectBrand() . '</select>';
            $html .= "<select disabled name='modelo'><option>No disponible</option></select>";
            $html .= "<select disabled name='age'><option>No disponible</option></select>";
            $html .= "<select disabled name='sales'><option>No disponible</option></select></fieldset>";
            $html .= reseteo();
            $html .= "<input type='submit' value='Siguiente'>";
                    /* echo '<pre>';
                     var_dump($_SESSION);
                     echo '</pre>';*/
            break;
        case 1:
            $html = $_SESSION["marca"] . "\t";
            $html .= "<select name='modelo'>" . selectModel($_SESSION["marca"]) . "</select>";
            $html .= "<select disabled name='age'><option>No disponible</option></select>";
            $html .= "<select disabled name='sales'><option>No disponible</option></select></fieldset>";
            $html .= "<input name='back' type='submit' value='Anterior'>";
            $html .= reseteo();
            $html .= "<input type='submit' value='Siguiente'>";
                    /*   echo '<pre>';
                        var_dump($_SESSION);
                        echo '</pre>';*/
            break;
        case 2:
            $html = $_SESSION["marca"] . "\t-\t";
            $html .= $_SESSION["modelo"] . "\t";
            $html .= "<select name='age'>";
            $html .= "<option value=1> > 2 años </option>";
            $html .= "<option value=2> 2 - 5 años </option>";
            $html .= "<option value=3> 6 - 10 años </option>";
            $html .= "<option value=4> > 10 </option></select>";
            $html .= "<select disabled name='sales'><option>No disponible</option></select></fieldset>";
            $html .= "<input name='back' type='submit' value='Anterior'>";
            $html .= reseteo();
            $html .= "<input type='submit' value='Siguiente'> ";
                /*    echo '<pre>';
                    var_dump($_SESSION);
                    echo '</pre>';*/
            break;
        case 3:
            $html = $_SESSION["marca"] . "\t-\t";
            $html .= $_SESSION["modelo"] . "\t-\t";
            $html .= insertAge($_SESSION["age"]) . "\t-\t";
            $html .= "<select  name='sales'>";
            $html .= "<option value=1> Menos de 1000 </option>";
            $html .= "<option value=2> Entre 1000 y 3000 </option>";
            $html .= "<option value=3> Entre 3000 y 6000</option>";
            $html .= "<option value=4> Mas de 6000</option></select></fieldset>";
            $html .= "<input name='back' type='submit' value='Anterior'>";
            $html .= reseteo();
            $html .= "<input type='submit' value='Siguiente'>";
                /* echo '<pre>';
                 var_dump($_SESSION);
                 echo '</pre>';*/
            break;
        case 4:
            $html = $_SESSION["marca"] . "\t-\t";
            $html .= $_SESSION["modelo"] . "\t-\t";
            $html .= insertAge($_SESSION["age"]) . "\t-\t";
            $html .= insertSales($_SESSION["sales"]);
            $html .= "<input name='buscar' type='submit' value='Buscar'></fieldset>";
            $html .= "<input name='back' type='submit' value='Anterior'>";
            $html .= reseteo();
            /*  echo '<pre>';
              var_dump($_SESSION);
              echo '</pre>';*/
            break;
        case 5:
            $html .= showCars();
            $html .= "<input name='back' type='submit' value='Anterior'>";
            $html .= reseteo();
            break;
        default:
            $html = reseteo();
            /*  echo '<pre>';
              var_dump($_SESSION);
              echo '</pre>';*/
            break;
    }

    return $html;
}

function status()
{
     $status = 0;
    if (!isset($_SESSION)) {
         $status = 0;
    }
   
    else if (count($_SESSION)==1) {
        $status = 1;
    } else if (count($_SESSION)==2) {
        $status = 2;
    } else if (count($_SESSION)==3) {
        $status = 3;
    } else if (count($_SESSION)==4) {
        $status = 4;
    }
   /*
   Iba 2 pasos para detras asi que el fallo ewstab aqui.
   if (isset($_POST["back"])) {
        if (isset($_SESSION)) {
            $status = count($_SESSION) - 1;
        }

        unset($_POST["back"]);
    }*/
    if (isset($_POST["buscar"]) && !isset($_POST["back"])) {
        $status = 5;
    } else if (isset($_POST["buscar"]) && isset($_POST["back"])) {
        $status = 4;
    }
    return $status;
}

function reseteo()
{
    $html = "";
    if (!isset($_SESSION)) {
        $html .= "<input name='reset' type='submit' value='Reset' disabled>";
    } else {
        $html .= "<input name='reset' type='submit' value='Reset'>";
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

function showCars()
{
    global $mysql;
    $id = $mysql->query('SELECT ID from vehiculos where Marca = "'
        . $_SESSION["marca"] . '" AND Modelo = "'
        . $_SESSION["modelo"] . '" AND '
        . selectAge($_SESSION["age"]) . ' AND '
        . selectSales($_SESSION["sales"]) . ' ;');
    $consulta = $mysql->query('SELECT Marca from vehiculos where Marca = "'
        . $_SESSION["marca"] . '" AND Modelo = "'
        . $_SESSION["modelo"] . '" AND '
        . selectAge($_SESSION["age"]) . ' AND '
        . selectSales($_SESSION["sales"]) . ' ;');

    $consulta2 = $mysql->query('SELECT Modelo from vehiculos where Marca = "'
        . $_SESSION["marca"] . '" AND Modelo = "'
        . $_SESSION["modelo"] . '" AND '
        . selectAge($_SESSION["age"]) . ' AND '
        . selectSales($_SESSION["sales"]) . ' ;');

    $consulta3 = $mysql->query('SELECT Precio from vehiculos where Marca = "'
        . $_SESSION["marca"] . '" AND Modelo = "'
        . $_SESSION["modelo"] . '" AND '
        . selectAge($_SESSION["age"]) . ' AND '
        . selectSales($_SESSION["sales"]) . ' ;');

    $text = "<table><tr><th>Foto</th>";
    $text .= '<th>Marca</th>';
    $text .= '<th>Modelo</th>';
    $text .= '<th> Precio </th></tr>';
    $ids = $id->fetch_assoc();
    $fila = $consulta->fetch_assoc();
    $fila2 = $consulta2->fetch_assoc();
    $fila3 = $consulta3->fetch_assoc();
    while ($fila) {
        $text .= "<tr><td><a href='showCarSelect.php?id=" . $ids["ID"] . "'><img src='media/" . $_SESSION["modelo"] . ".jpg' ></a></td><td>" .
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

function addInSession()
{
    if (isset($_POST["marca"]) && !isset($_POST["modelo"]) && !isset($_POST["age"]) && !isset($_POST["sales"]) && !isset($_POST["back"]) && !isset($_POST["buscar"])) {
        $_SESSION["marca"] = $_POST["marca"];
    } else if (isset($_SESSION["marca"]) && isset($_POST["modelo"]) && !isset($_POST["age"]) && !isset($_POST["sales"]) && !isset($_POST["back"]) && !isset($_POST["buscar"])) {
        $_SESSION["modelo"] = $_POST["modelo"];
    } else if (isset($_SESSION["marca"]) && isset($_SESSION["modelo"]) && isset($_POST["age"]) && !isset($_POST["sales"]) && !isset($_POST["back"]) && !isset($_POST["buscar"])) {
        $_SESSION["age"] = $_POST["age"];
    } else if (isset($_SESSION["marca"]) && isset($_SESSION["modelo"]) && isset($_SESSION["age"]) && isset($_POST["sales"]) && !isset($_POST["back"]) && !isset($_POST["buscar"])) {
        $_SESSION["sales"] = $_POST["sales"];
    }
}

function getSession($status)
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
    return $res;
}

function back()
{
    if (isset($_POST["back"]) && isset($_POST["buscar"])) {

    } else if (isset($_POST["reset"])) {
        unset($_SESSION);
        session_destroy();
    } else if (isset($_POST["back"])) {
        for ($i = 1; $i <= 4; $i++) {
            if ($i == count($_SESSION)) {
                $status = getSession($i);
                // echo $status;
                //$status2 = "'" . getSession(--$i) . "'";
                //$wipe = $_SESSION[$status];
                // unset($_POST[$status2]);
                unset($_SESSION["$status"]);
                $i = 4;
            }
            if (count($_SESSION) == 0) {
                unset($_SESSION);
                session_destroy();
            }
        }


    }
}

function createCar($car)
{
    $text = "<table id='coche'><tr><th>Foto</th>";
    $text .= '<th>Informacion</th>';
    global $mysql;
    $consulta = $mysql->query("SELECT Marca, Modelo, Fecha_Compra, Precio FROM vehiculos Where ID = " . $car);
    $fila = $consulta->fetch_assoc();

    $text .= "<tr><td><img src='media/" . $fila["Modelo"] . ".jpg' ></td><td>" .
        "{$fila["Marca"]} <br>" .
        "{$fila["Modelo"]} <br>" .
        "{$fila["Precio"]}</td></tr>";

    $text .= "</table>";
    $text .= "<input name='back' type='submit' value='Anterior'>";
    $text .= reseteo();
    return $text;

}

?>

