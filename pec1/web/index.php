<?php

	include 'operations.php';
	$conexion=connectBBDD();
	addInSession();
             
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
<form method="post" action='index.php'>
<fieldset>


<?php

back();
echo desplegables();

?>


</form>

	

</body>
</html>
