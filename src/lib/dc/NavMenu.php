<?php
	require_once('PASL/Web/Simpl/NavMenu.php');

	class dc_NavMenu extends PASL_Web_Simpl_NavMenu
	{
		public function display()
		{
			preg_match_all('/\/([a-zA-Z0-9+]+)/', $_SERVER['REQUEST_URI'], $matches);

			$requestURI = '/'.$matches[1][0];
			$MenuHTML = '';
			foreach($this->menuItems AS $Item)
			{
				
				if($requestURI == $Item->link) $Item->selected = true;
				$MenuHTML .= (string) $Item;
			}

			return $MenuHTML;
		}
	}
?>
