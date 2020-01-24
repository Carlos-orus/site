<?php 

	abstract class Connection
	{
		private static $conn;

		public static function getConn()
		{
			if (self::$conn == null ){
				self::$conn = new PDO ('mysql: host=locahost; dbname=criando-site;', 'root', 'senha');
			}

			return self::$conn;
		}
	}