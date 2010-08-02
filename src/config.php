<?php
	session_start();

	// Add a new path for lib/
	$lib_path = realpath('lib/');
	$etc_path = realpath('../../etc/');
	$oldpath = ini_get('include_path');

	ini_set('include_path', $etc_path .':' . $lib_path.':.');

	require_once('dc/NavItem.php');
	require_once('dc/NavMenu.php');
	require_once('dc/Theme.php');
	require_once('dc/Navigation.php');

	require_once('PASL/DB/DB.php');
	require_once('PASL/Data/Session.php');
	
	require_once('PASL/Log.php');

	//////////////////////////////////
	// Define goodies	        	//
	//////////////////////////////////
	DEFINE('DB_USERNAME', 'madridiowa');
	DEFINE('DB_PASSWORD', 't1g3r5');
	DEFINE('DB_HOST', 'localhost');
	DEFINE('DB_NAME', 'madridiowa');
	DEFINE('DSN', 'mysql://madridiowa:t1g3r5@localhost/madridiowa');
	
	DEFINE('DEFAULT_PAGE', 'laborday');
	dc_Theme::SetTheme('default');

	if($_SERVER['REQUEST_URI'] == '/')
	{
		$_SERVER['REQUEST_URI'] = '/' . DEFAULT_PAGE;
	}

	//////////////////////////////////
	// Register navigation sections //
	//////////////////////////////////

	// Main Navigation
	$MainNavMenu = new dc_NavMenu('main_nav');

	$MainNavMenu->addMenuItem(new dc_NavItem('laborday', 'Labor Day', '/laborday', null));
	$MainNavMenu->addMenuItem(new dc_NavItem('aboutus', 'About Us', '/aboutus', null));
	$MainNavMenu->addMenuItem(new dc_NavItem('contactus', 'Contact Us', '/contactus', null));
	$MainNavMenu->addMenuItem(new dc_NavItem('ourlistings', 'Our Listings', '/ourlistings', null));

	dc_Navigation::AddMenu($MainNavMenu);

	unset($MainNavMenu);
?>
