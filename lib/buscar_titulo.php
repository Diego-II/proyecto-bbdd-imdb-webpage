<?php

function buscarPorTitulo($db_conn, $nombre, $limit){
  // $db_conn = pg_connection_reset($db_conncon);
  // SELECT id FROM groups WHERE name ILIKE 'Administrator'
  if (!pg_connection_busy($db_conn)) {
      pg_send_prepare($db_conn, "my_query", 'SELECT title, year, rating FROM cc3201.movie WHERE title ILIKE $1 order by rating desc limit $2');
      $res1 = pg_get_result($db_conn);
    }
  
    // Execute the prepared query.  Note that it is not necessary to escape
    // the string "Joe's Widgets" in any way
    if (!pg_connection_busy($db_conn)) {
      pg_send_execute($db_conn, "my_query", array('%'.$nombre.'%', $limit));
      $res2 = pg_fetch_all(pg_get_result($db_conn));
    }
    return $res2;    
}


function printbusquedaTitulo($resultado){
    // print_r($resultado);
    echo '<table>
    <tr>
    <td>Titulo de la pelicula</td>
    <td>Ano de estreno</td>
    <td>Rating en IMDB</td>
    </tr>';
    foreach($resultado as $array){
      echo '<tr>
          <td>'.$array['title'].'</td>
          <td>'.$array['year'].'</td>
          <td>'.$array['rating'].'</td>
        </tr>';
    }
    echo '</table>';
  }