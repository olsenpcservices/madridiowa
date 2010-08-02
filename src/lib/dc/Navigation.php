<?php
	require_once('dc/URLObserver.php');

	require_once('PASL/Web/Simpl/NavMenu.php');

	class dc_Navigation
	{
		private static $Menus = Array();

		public static function AddMenu($Menu)
		{
			self::$Menus[] = $Menu;
		}

		public static function RegisterNavItem($NavItem)
		{
			$NavMenu = new PASL_Web_Simpl_NavMenu($NavItem->title);
			$NavMenu->addMenuItem($NavItem);

			self::AddMenu($NavMenu);
		}

		public static function GetSelectedNavItem()
		{
			foreach(self::$Menus AS $Menu)
			{
				if($Menu->selectedItem != null) return $Menu->selectedItem;
			}
		}

		public static function GetSelectedNavItems()
		{
			$Items = Array();
			foreach(self::$Menus AS $Menu)
			{
				if(!empty($Menu->selectedItem)) 
				{
					$Items[] = $Menu->getSelectedItem();
				}
			}

			return $Items;
		}

		public static function SelectItemByName($MenuName, $Title)
		{
			$Items = Array();
			foreach(self::$Menus AS $Menu)
			{
				foreach($Menu AS $Item)
				{
					if($Menu->name == $MenuName)
					{
						if(is_array($Item)) {
							foreach($Item AS $MenuItem)
							{
								if($MenuItem->title == $Title)
								{
									$MenuItem->selected = true;
									$Menu->selectedItem = $MenuItem;
								}
							}
						}
					}
				}
			}
		}

		public static function getMenuByName($name)
		{
			foreach(self::$Menus AS $Menu)
			{
				if($Menu->name == $name) 
				{
					return $Menu;
				}
			}

			return false;
		}
	}
?>