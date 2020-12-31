<?php

function buscarPorPapel($db_conn, $nombre, $limit){
    if (!pg_connection_busy($db_conn)) {
      pg_send_prepare($db_conn, "papel", 'SELECT * from cc3201.movie where id in 
      (SELECT m_id from cc3201.moviecrew where id in 
       (SELECT id from cc3201.person where pname ilike %1%)) 
      or id in (SELECT m_id from cc3201.movieactor where id in 
                (SELECT id from cc3201.person where pname ilike %1%) LIMIT $2');
      $result1 = pg_get_result($db_conn);
    }
  
    // Execute the prepared query.  Note that it is not necessary to escape
    // the string "Joe's Widgets" in any way
    pg_send_execute($db_conn, "papel", array('%'.$nombre.'%', $limit));
    $result2 = pg_fetch_all(pg_get_result($db_conn));
    return $result2;   
}




function printbusquedapel($resultado){
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
}