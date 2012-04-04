<?php
	ini_set("display_errors","Off");
	class dbconnect{
		static public function connect(){
			$hostname = 'likemyecom.db.8045435.hostedresource.com';
			$dbname = 'likemyecom';
			$username = 'likemyecom';
			$password = 'LMWadmin12345';			
		/*	$hostname = 'localhost';
			$dbname = 'ecommerce';
			$username = 'root';
			$password = ''; */
			$con = mysql_connect($hostname,$username, $password);
		    if (!$con)
			  {
			  die('Unable to connect to the database: ' . mysql_error());
			  }
		
		    mysql_select_db($dbname, $con);
			return $con;
		}
	}
	
	class Items{
		public function getItem(){
			$db = dbconnect::connect();
			$query = "select * from `automotive_items` order by LikeCount desc";
			$result = mysql_query($query);
			$arr = array();
			while($row = mysql_fetch_assoc($result)){
				array_push($arr,$row);
			}			
			return $arr;			
		}			
		
		public function getItem1($start, $limit){
			$db = dbconnect::connect();
			$query = "select * from `automotive_items` order by LikeCount desc LIMIT $start, $limit";
			$result = mysql_query($query);
			$arr = array();
			while($row = mysql_fetch_assoc($result)){
				array_push($arr,$row);
			}			
			return $arr;
		}
	}
	
	class Rating{
				
		public function add($code, $rate, $uid){
			$db = dbconnect::connect();
			$query = "insert into `auto_rating` (`Auto_Id`,`Rate`,`Uid`) values('$code', '$rate', '$uid')";
			$result = mysql_query($query);
		}
		
		public function update($code, $rate, $uid){
			$db = dbconnect::connect();
			$query = "update `auto_rating` set Rate = $rate where Auto_Id = $code and Uid = '$uid'";
			$result = mysql_query($query);
		}
		
		public function get($code){
			$db = dbconnect::connect();
			$query = "select * from `auto_rating` where Auto_Id = $code";
			$result = mysql_query($query);
			return $result;
		}
		
		public function get1($code,$uid){
			$db = dbconnect::connect();
			$query = "select * from `auto_rating` where Auto_Id = $code and Uid = '$uid'";
			$result = mysql_query($query);
			return $result;
		}
		
		public function check($code,$uid){
			$db = dbconnect::connect();
			$query = "select count(*) from `auto_rating` where `Auto_Id` = $code and `Uid` = '$uid'";
			$result = mysql_query($query);			
			return $result;
		}
		
	}
	
?>