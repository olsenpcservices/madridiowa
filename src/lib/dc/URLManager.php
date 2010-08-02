<?php
	class dc_URLManager
	{
		public static function AppendValue($value)
		{
			$_SERVER['REQUEST_URI'] = $_SERVER['REQUEST_URI'] . '/' . $value;
		}
	}
?>