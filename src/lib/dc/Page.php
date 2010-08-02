<?php

	require('PASL/Web/Simpl/Page.php');

	require_once('dc/Navigation.php');
	require_once('dc/Theme.php');
	require_once('dc/URLObserver.php');
	require_once('dc/Navigation.php');

	class dc_Page extends PASL_Web_Simpl_Page
	{
		protected $PageTitleImage;

		protected $Widgets = Array();

		public function __construct()
		{
			$this->ThemePath = dc_Theme::GetThemePath();
			
			$this->SetContent('Page');
			$this->addJSPackage('jquery-1.3.2.min.js');

		}

		protected function SetupPageTitle()
		{
			$item = dc_Navigation::GetSelectedNavItem();

			$title = $item->title;

			$this->TOKENS['TITLE_IMG'] = '<img src="/'.$this->ThemePath.'/images/title_'.$title.'.png" style="margin-top: 11px; margin-left: 12px"></img>';
		}

		protected function SetupMainNavigation()
		{
			$MainNavMenu = dc_Navigation::getMenuByName('main_nav');

			$this->TOKENS['MAIN_NAVIGATION'] =  $MainNavMenu->display();
		}

		protected function SetContent($Content)
		{
			$this->TOKENS['Content'] = $Content;
		}

		public function addCSSPackage($url)
		{
			$url = '/'.$this->ThemePath.'/css/'.$url;
			parent::addCSSPackage($url);
		}

		public function addJSPackage($url)
		{
			$url = '/resource/js/'.$url;
			parent::addJSPackage($url);
		}

		public function addExternalJSPackage($url)
		{
			parent::addJSPackage($url);
		}
		
		public function __toString()
		{
			$this->SetupMainNavigation();

			$this->addCSSPackage('default.css');
			$this->addCSSPackage('form_items.css');
			$this->TOKENS['CSSPayload'] = $this->CSSPayload;
			$this->TOKENS['JSPayload'] = $this->JSPayload;
			
			
			return $this->loadAndParse($this->ThemePath.'/template/index.html', false);
		}
	}
?>
