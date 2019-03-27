<?php
/**
 * @author Santos L. Victor
*/
class Model {
	private static $server = 'localhost';
	private static $user = 'root';
	private static $password = 'password';
	public static $conn;

	function __construct() {
		try {
		    self::$conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
		    // set the PDO error mode to exception
		    sefl::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			throw new Exception("Error Processing Request".$e->getMessage(), 1);
		}
	}

}