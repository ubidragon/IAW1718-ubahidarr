<?php
	include 'operations.php';
	connectBBDD();
	$optionMarca=selectBrand();
               
              
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
<fieldset>

<select name="marca">
<?php echo $optionMarca;?>
</select>
<select disabled name="model">
<option>No disponible</option>
</select>
<select disabled name="age">
<option>No disponible</option>
</select>
<select disabled name="$sales">
<option>No disponible</option>
</select>


</fieldset>
<a href="#" class="previous">&laquo; Previous

</a>

<?php
	if(!isset($optionMarca)){
		echo '<a href="index.php" class="next">Next &raquo;</a>';
	}
	
?>


</body>
</html>

