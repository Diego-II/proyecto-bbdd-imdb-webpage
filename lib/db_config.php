<?php
class DbConfig{
	// host=sheep port=5432 dbname=mary user=lamb password=foo
	private static $db_name = "cc3201"; //Base de datos de la app
	private static $db_port =  "5432";
	private static $db_user = "cc3201"; //Usuario MySQL
	private static $db_pass = ""; //Password
	private static $db_host = "localhost";//Servidor donde esta alojado, puede ser 'localhost' o una IP (externa o interna).
	
	public static function getConnection(){
		$conn = "host=".self::$db_host." port=".self::$db_port." dbname=".self::$db_name." user=".self::$db_user." password=".self::$db_pass;
		$psql = pg_connect($conn) or die(pg_last_error());

		return $psql;
	}
}
