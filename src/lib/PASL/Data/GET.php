<?php
	class PASL_Data_GET
	{
		public static function set($key, $value)
		{
			
		}
		
		public static function get($key)
		{
			
		}
		
		public static function getAndSetString($key=null, $value=null)
		{
			$strArray = $_GET;
			$strArray[$key] = $value;
			$i=0;
			$str = '?';
			foreach($strArray AS $key=>$val)
			{
				$str .= $key .'=' . $val;
				
				if($i != count($strArray) - 1) $str .= '&';
				
				$i++;
			}

			return $str;
		}
	}
?>