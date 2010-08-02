<?php
	
	class dc_PageEngine
	{
		private static function Alias()
		{

		}

		private static function PageConditions($Page)
		{

		}

		public static function LoadPage($Sections)
		{	
			// strip out any periods
			if(!is_array($Sections)) $Sections[0] = DEFAULT_PAGE;
			
			$dirstr = implode('/', $Sections);

			self::PageConditions($dirstr);

			$PageDir = 'lib/dc/page/'.$dirstr;
			for($i = count($Sections) - 1; $i >= 0; $i--)
			{
				
				if(is_file($PageDir.'.php'))
				{
					require_once($PageDir.'.php');

					$Class = 'dc_page_'.implode('_', $Sections);
					if(class_exists($Class)) 
					{
						return (string) new $Class;
					} 
					else 
					{
						header ('Location: /');
					}	
				}
				else
				{
					header ('Location: /');
				}
			}
		}
	}
?>
