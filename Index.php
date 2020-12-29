<?php
require_once('lib/db_config.php');

$db = DbConfig::getConnection();

$query = "select title, year, rating from cc3201.movie order by rating desc limit 5";
pg_send_query($db, "select title, year, rating from cc3201.movie order by rating desc limit 5;");
$resultado = pg_fetch_all(pg_get_result($db));

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

<!-- Header -->
<header class="w3-container w3-red w3-center" style="padding:128px 16px">
  <h1 class="w3-margin w3-jumbo">Buscador IMDB</h1>
  <p class="w3-xlarge">En esta lista estan las 5 mejor evaluadas peliculas. Para ir al buscador, presionar el boton.</p>
  <button class="w3-button w3-black w3-padding-large w3-large w3-margin-top" action="buscador.php">Get Started</button>
</header>


<?php  
echo '<table>
<tr>
 <td>Nombre</td>
 <td>Ano</td>
 <td>Rating</td>
</tr>';

foreach($resultado as $array)
{
echo '<tr>
    <td>'. $array['title'].'</td>
    <td>'. $array['year'].'</td>
    <td>'. $array['rating'].'</td>
  </tr>';
}
echo '</table>';
?>


</body>
</html>