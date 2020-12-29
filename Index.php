<?php
require_once('lib/db_config.php');

$db = DbConfig::getConnection();

$query = "select title, year, rating from cc3201.movie order by rating desc limit 5";
$resultado = pg_prepare($db, "get_top_mov", 'select title, year, rating from cc3201.movie order by rating desc limit 5');
$resultado = pg_execute($dbconn, "get_top_mov", '');

//  $db -> query($query);

// print_r($resultado)
?>

<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/estilo.css">

<title>
    Proyecto BBDD: Buscador peliculas IMDB
</title>

<body>
<div class="w3-top">
    <div class="w3-bar w3-red w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="Index.php" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <a href="buscador.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Buscador</a>
    </div>
</div>

<!-- <?php  foreach($resultado as $movie => $rows): ?>
  <?php  foreach($rows as $row): ?>
        <tr>
            <td><?=$country;?></td>
            <td><?=$row['Year'];?></td>
            <td><?=$row['Value'];?></td>
        </tr>
  <?php endforeach;?>
<?php endforeach;?> -->


</body>
</html>