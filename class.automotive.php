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
			$password = '';  */
			$con = mysql_connect($hostname,$username, $password);
		    if (!$con)
			  {
			  die('Unable to connect to the database: ' . mysql_error());
			  }
		
		    mysql_select_db($dbname, $con);
			return $con;
		}
	}
	
	class main_Items{
		public function getMainItems(){
			$db = dbconnect::connect();
			$query = "select * from `media_main_items`";
			$result = mysql_query($query);
			$arr = array();
			while($row = mysql_fetch_assoc($result)){
				array_push($arr,$row);
			}			
			return $arr;
		}
		
		public function getMainItems1($start,$limit){
			$db = dbconnect::connect();
			$query = "select * from `media_main_items` order by Id desc LIMIT $start, $limit";
			$result = mysql_query($query);
			$arr = array();
			while($row = mysql_fetch_assoc($result)){
				array_push($arr,$row);
			}			
			return $arr;
		}				
	}
	
	class Items{
		public function getItem($type){
			$db = dbconnect::connect();
			$query = "select * from `media_items` where Type = '$type' order by LikeCount desc";
			$result = mysql_query($query);
			$arr = array();
			while($row = mysql_fetch_assoc($result)){
				array_push($arr,$row);
			}			
			return $arr;			
		}			
		
		public function getItem1($type, $start, $limit){
			$db = dbconnect::connect();
			$query = "select * from `media_items` where Type = '$type' order by LikeCount desc LIMIT $start, $limit";
			$result = mysql_query($query);
			$arr = array();
			while($row = mysql_fetch_assoc($result)){
				array_push($arr,$row);
			}			
			return $arr;
		}
		
		public function getItem2($type, $start, $limit){
			$db = dbconnect::connect();
			$query = "select * from `media_items` where Type = '$type' order by Rating desc LIMIT $start, $limit";
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
			$query = "insert into `media_rating` (`Media_Id`,`Rate`,`Uid`) values('$code', '$rate', '$uid')";
			$result = mysql_query($query);
		}
		
		public function update($code, $rate, $uid){
			$db = dbconnect::connect();
			$query = "update `media_rating` set Rate = $rate where Media_Id = $code and Uid = '$uid'";
			$result = mysql_query($query);
		}
		
		public function get($code){
			$db = dbconnect::connect();
			$query = "select * from `media_rating` where Media_Id = $code";
			$result = mysql_query($query);
			return $result;
		}
		
		public function get1($code,$uid){
			$db = dbconnect::connect();
			$query = "select * from `media_rating` where Media_Id = $code and Uid = '$uid'";
			$result = mysql_query($query);
			return $result;
		}
		
		public function check($code,$uid){
			$db = dbconnect::connect();
			$query = "select count(*) from `media_rating` where `Media_Id` = $code and `Uid` = '$uid'";
			$result = mysql_query($query);			
			return $result;
		}
		
	}
	
?>