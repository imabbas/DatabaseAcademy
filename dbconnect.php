<?php
	class DbUtil{
		public static $user = "CS4750asg8bz";
		public static $pass = "spring2018";
		public static $host = "stardock.cs.virginia.edu";
		public static $schema = "CS4750asg8bz";

		public static function loginConnection() {
			$db = new mysqli(DbUtil::$host, DbUtil::$user, DbUtil::$pass, DbUtil::$schema);
			if($db->connect_errno) {
				echo "fail";
				$db->close();
				exit();
			}
			return $db;
		}
	}
?> 
