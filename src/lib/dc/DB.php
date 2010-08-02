<?php
	require_once('PASL/DB/DB.php');

	class dc_DB extends PASL_DB
	{
		private static $instance = null;

		public static function singleton()
		{
			if(!self::$instance) self::$instance = PASL_DB::factory(DSN);

			return self::$instance;
		}
	}
?>