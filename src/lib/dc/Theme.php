<?php
	class dc_Theme
	{
		public static function SetTheme($ThemeName)
		{
			DEFINE('THEME_NAME', $ThemeName);
			DEFINE('THEME_PATH', 'themes/'.$ThemeName);
		}

		public static function GetTheme()
		{
			return THEME_NAME;
		}

		public static function GetThemePath()
		{
			return THEME_PATH;
		}
	}
?>