<?php

function buscarPorNombre($db, $nombre){
    // SELECT id FROM groups WHERE name ILIKE 'Administrator'
    if (!pg_connection_busy($db)) {
        pg_send_prepare($db, "my_query", 'SELECT title, year, rating FROM cc3201.movie WHERE name ILIKE $1');
        $res1 = pg_get_result($db);
      }
    
      // Execute the prepared query.  Note that it is not necessary to escape
      // the string "Joe's Widgets" in any way
      if (!pg_connection_busy($db)) {
        pg_send_execute($db, "my_query", array("Joe's Widgets"));
        $res2 = pg_fetch_all(pg_get_result($db));
      }
      return $res2;    
}