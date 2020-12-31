<?php

function buscarPorPapel($db_conn, $nombre, $limit){
    if (!pg_connection_busy($db_conn)) {
      pg_send_prepare($db_conn, "papel", 'SELECT title, role, rating FROM cc3201.Movie, cc3201.Person, (SELECT m_id, a_id, role FROM cc3201.MovieActor WHERE role iLIKE %1%) Names WHERE Names.a_id = Person.id AND Movie.id = m_id ORDER BY rating DESC');
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