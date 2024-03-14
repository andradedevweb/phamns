<?php
	
	namespace App;

	class MySql{

		private static $pdo;

		public static function connect(){
		if(self::$pdo == null){
				self::$pdo = new \PDO('mysql:host=localhost;dbname=phamns_redesocial','root','',array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
				self::$pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
				
				
			}

			return self::$pdo;
		}

	}



?>