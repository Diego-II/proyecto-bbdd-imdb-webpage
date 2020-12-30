<?php

require_once 'db_config.php';
require_once 'func_aux.php';

$db  = DbConfig::getConnection();

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
    if(!empty($_POST["res-cant"])){
        $limit = $_POST["res-cant"];
    } else{
        $limit = 10;
    }
    $orden = $_POST["orden"]
}

if ($nombre_pelicula and $nombre_personaje and $person){
    switch ($_POST["person"]){
        case "actor":
            pg_send_prepare($db, "query1", 'SELECT * FROM cc3201.movie WHERE id IN 
            (SELECT m_id FROM cc3201.movieactor
             WHERE role ILIKE %$1%) 
             and title ILIKE %$2%');
             break;
        
        case "personaje":
            pg_send_prepare($db, "query2", 'SELECT * FROM cc3201.movie WHERE id IN 
            (SELECT m_id FROM cc3201.movieactor
             WHERE role ILIKE %$1%) 
             and title ILIKE %$2%');
             break;
    }
}

function buscarPorNombre($db, $nombre){
    // SELECT id FROM groups WHERE name ILIKE 'Administrator'
    if (!pg_connection_busy($db)) {
        pg_send_prepare($db, "my_query", 'SELECT title, year, rating FROM cc3201.movie WHERE title ILIKE $1 order by rating desc limit 10');
        $res1 = pg_get_result($db);
      }
    
      // Execute the prepared query.  Note that it is not necessary to escape
      // the string "Joe's Widgets" in any way
      if (!pg_connection_busy($db)) {
        pg_send_execute($db, "my_query", array('%'.$nombre.'%'));
        $res2 = pg_fetch_all(pg_get_result($db));
      }
      return $res2;    
}




$resultado = buscarPorNombre($db, $nombre_pelicula);
print_r($_POST["orden"]);

echo '<table>
<tr>
 <td>Nombre</td>
 <td>Ano</td>
 <td>Rating</td>
</tr>';

foreach($resultado as $array){
echo '<tr>
    <td>'.$array['title'].'</td>
    <td>'.$array['year'].'</td>
    <td>'.$array['rating'].'</td>
  </tr>';
}
echo '</table>';
?>