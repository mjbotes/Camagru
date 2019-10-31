<?php

class Database
{
	private static $server="localhost";
	private static $dbname="camagru";
	private static $user="root";
	private static $pass="12345678";

    private static $conn = null;

    private function __construct() {
    }

    public static function getBdd() {
        if(is_null(self::$conn)) {
            self::$conn = new PDO("mysql:host=".self::$server.";dbname=".self::$dbname, self::$user, self::$pass);
			self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
        return self::$conn;
    }
}
?>
