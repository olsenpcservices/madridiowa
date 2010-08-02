<?php
	require_once('PASL/Web/Simpl/MainNavItem.php');

	class dc_NavItem extends PASL_Web_Simpl_MainNavItem
	{
		private $disabled = false;
		
		public function setDisabled($bool)
		{
			$this->disabled = $bool;
		}
		
		public function __toString()
		{
			preg_match_all('/\/([a-zA-Z0-9+]+)/', $_SERVER['REQUEST_URI'], $matches);

			$requestURI = '/'.$matches[1][0];
			
			if ($this->selected && $requestURI != $this->link) return "<li class='nav-item'><a href=\"{$this->link}\"><div id=\"{$this->title}\" class=\"active\"></div></a></li>";
			else if ($this->selected) return "<li class='nav-item'><div id=\"{$this->title}\" class=\"active\"></div></li>";
			else return "<li class='nav-item'><a href=\"{$this->link}\"><div id=\"{$this->title}\"></div></a></li>";
		}
	}
?>