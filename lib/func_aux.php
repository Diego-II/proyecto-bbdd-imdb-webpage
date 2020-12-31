<?php



function buscarPorActor($db_conn, $nombre, $limit){
  // $db_conn = pg_connection_reset($db_conncon);
  // SELECT id FROM groups WHERE name ILIKE 'Administrator'
  if (!pg_connection_busy($db_conn)) {
      pg_send_prepare($db_conn, "my_query", 'SELECT pname, role, title FROM cc3201.Movie, cc3201.MovieActor, (SELECT id, pname FROM cc3201.Person WHERE pname iLIKE %$1%) Names WHERE Names.id = a_id AND Movie.id = MovieActor.m_id ORDER BY pname ASC LIMIT $2');
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




// function busquedaPorPerson($db_conn, $nombre, $switch, $limit){
//   print_r($nombre);
//   print_r($switch);
//   // $db_conn = pg_connection_reset($db_conncon);
//   switch ($switch){
//       case "actor":
//           print_r("Antes de la query");
//           pg_send_prepare($db_conn, "query", 'SELECT pname, role, title
//           FROM cc3201.Movie, cc3201.MovieActor,
//           (SELECT id, pname
//           FROM cc3201.Person
//           WHERE pname iLIKE %$1%) Names
//           WHERE 
//           Names.id = a_id
//           AND Movie.id = MovieActor.m_id
//           ORDER BY pname ASC
//           LIMIT $2');
//           $temp = pg_get_result($db_conn);
//           pg_send_execute($db_conn, "query", array('%'.$nombre.'%', $limit));
//           return pg_fetch_all(pg_get_result($db_conn));
//           break;
            
//       case "personaje":
//           pg_send_prepare($db_conn, "query", 'SELECT * FROM cc3201.movie 
//           WHERE id IN SELECT m_id 
//           FROM cc3201.movieactor WHERE role ILIKE %$1%');
//           pg_send_execute($db_conn, "query", array('%'.$nombre.'%'));
//           break;
      
//       case "crew":
//         pg_send_prepare($db_conn, "query", 'SELECT pname, title
//         FROM cc3201.Movie, cc3201.MovieCrew,
//         (SELECT id, pname
//         FROM cc3201.Person
//         WHERE pname iLIKE %$1%) Names
//         WHERE 
//         Names.id = c_id
//         AND Movie.id = MovieCrew.m_id');
//         pg_send_execute($db_conn, "query", array('%'.$nombre.'%'));
//         break;
      
//       case "director":
//         pg_send_prepare($db_conn, "query", 'SELECT pname, title
//         FROM cc3201.Movie, cc3201.MovDirector,
//         (SELECT id, pname
//         FROM cc3201.Person
//         WHERE pname iLIKE %$1%) Names
//         WHERE 
//         Names.id = d_id
//         AND Movie.id = MovDirector.m_id');
//         pg_send_execute($db_conn, "query", array('%'.$nombre.'%'));
//         break;
//   }
  
//   $resultado = pg_fetch_all(pg_get_result($db_conn));
//   return $resultado;
// }


function printbusquedaActor($resultado){
  // print_r($resultado);
  echo '<table>
  <tr>
  <td>Nombre Actor</td>
  <td>Rol/Personaje</td>
  <td>Nombre Pelicula</td>
  </tr>';
  foreach($resultado as $array){
    echo '<tr>
        <td>'.$array['pname'].'</td>
        <td>'.$array['role'].'</td>
        <td>'.$array['title'].'</td>
      </tr>';
  }
  echo '</table>';
}
