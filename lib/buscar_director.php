<?php


function buscarPorDirector($db_conn, $nombre, $limit){
    // $db_conn = pg_connection_reset($db_conncon);
    // SELECT id FROM groups WHERE name ILIKE 'Administrator'
    if (!pg_connection_busy($db_conn)) {
        pg_send_prepare($db_conn, "my_query", 'SELECT pname, title
        FROM cc3201.Movie, cc3201.MovDirector,
        (SELECT id, pname
        FROM cc3201.Person
        WHERE pname ILIKE %$1%) Names
        WHERE 
        Names.id = d_id
        AND Movie.id = MovDirector.m_id
        LIMIT $2');
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
  
  
function printbusquedaDirector($resultado){
    // print_r($resultado);
    echo '<table>
    <tr>
    <td>Nombre Director</td>
    <td>Titulo Pelicula</td>
    </tr>';
    foreach($resultado as $array){
    echo '<tr>
        <td>'.$array['pname'].'</td>
        <td>'.$array['title'].'</td>
        </tr>';
    }
    echo '</table>';
}