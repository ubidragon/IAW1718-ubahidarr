<?php
	include 'operations.php';
	$conexion=connectBBDD();
	    
             
  ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PEC IAW</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<h1>PEC Implantacion de Aplicaciones Web</h1>
<form method='get' action='index.php'>
<fieldset>


<?php
echo desplegables();

?>


</form>

	

</body>
</html>

