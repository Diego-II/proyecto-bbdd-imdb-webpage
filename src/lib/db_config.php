<?php
class DbConfig{
	private static $db_name = "cc3201"; //Base de datos de la app
	private static $db_user = "cc3201"; //Usuario MySQL
	private static $db_pass = ""; //Password
	private static $db_host = "localhost";//Servidor donde esta alojado, puede ser 'localhost' o una IP (externa o interna).
	
	public static function getConnection(){
		$psql = pg_connect(self::$db_host, self::$db_user, self::$db_pass, self::$db_name);

		return $psql;
	}
}
