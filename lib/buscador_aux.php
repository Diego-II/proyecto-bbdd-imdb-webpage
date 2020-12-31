<?php

require_once 'db_config.php';
// require_once 'func_aux.php';
require_once 'buscar_papel.php';
require_once 'buscar_titulo.php';
require_once 'buscar_director.php';
require_once 'buscar_actor.php';


// Cuando se levanta la solicitud post:
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["nombre-pelicula"])) {
        $nombre_pelicula = $_POST["nombre-pelicula"];
    }  else {
        $nombre_pelicula = false;
    }
    if (!empty($_POST["person"])){
        $person = $_POST["person"];
    } else{
        $person = false;
    }
    if (!empty($_POST["ano-pelicula"])){
        $ano = $_POST["ano-pelicula"];
    } else{
        $ano = false;
    }
    if (!empty($_POST["res-cant"])){
        if ($_POST['limit'] > 51){
            $limit = 50;    
        } elseif ($_POST['res-cant'] < 0){
            $limit = 10;
        } else {
            $limit = $_POST["res-cant"];
        }
    } else{
        $limit = 10;
    }
    $switch = $_POST["act-per"];
}

?>


<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/estilo.css">

<title>
    Proyecto BBDD: Buscador peliculas IMDB
</title>

<body>
<div class="w3-top">
    <div class="w3-bar w3-red w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="../Index.php" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <a href="../buscador.html" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Buscador</a>
    </div>
</div>

<div class="w3-row-padding w3-padding-64 w3-container">
<div class="w3-content">

<?php

print_r($person);
print_r($switch);
print_r($nombre_pelicula);

if ($nombre_pelicula){
    $db_titulo  = DbConfig::getConnection();
    printbusquedaTitulo(buscarPorTitulo($db_titulo, $nombre_pelicula, $limit));
}


if ($person){
    if ($switch == "personaje") {
        $db_papel  = DbConfig::getConnection();
        printbusquedapel(buscarPorPapel($db_papel, $person, $limit));
    } elseif ($switch == "director") {
        $db_director  = DbConfig::getConnection();
        printbusquedaDirector(buscarPorDirector($db_director, $person, $limit));
    } elseif ($switch == "actor") {
        $db_actor  = DbConfig::getConnection();
        printbusquedaActor(buscarPorActor($db_actor, $person, $limit));
    }
}



?>

</div>
</div>
