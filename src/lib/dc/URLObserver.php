<?php
	require_once('PASL/Event/aObservable.php');
	require_once('PASL/Data/Session.php');

	class dc_URLObserver extends PASL_Event_aObservable
	{
		private static $instance = null;

		public static function ParseURL()
		{
			preg_match_all('/\/([a-zA-Z_-]+)/', $_SERVER['REQUEST_URI'], $matches);

			return (!empty($matches[1])) ? $matches[1] : false;
		}
		
		public static function toArray()
		{
			return explode('/', $_SERVER['REQUEST_URI']);
		}
	
		public static function toString()
		{
			return $_SERVER['REQUEST_URI'];
		}
		
		public static function AppendStaticValue($value)
		{
			$sections = self::ParseURL();
			
			$key = count($sections);
			
			$sections[$key] = $value;
			
			$str = '/' . implode('/', $sections);

			return $str;
		}

		public function dispatchEvents()
		{
			$obj = new stdClass;
			$obj->type = 'onswitch';

			$this->dispatch($obj);
		}
		
		public static function GetInstance()
		{
			if(!self::$instance)  self::$instance = new self;
			return self::$instance;
		}
	}
?>