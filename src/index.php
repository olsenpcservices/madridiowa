<?php
//error_reporting(E_ALL);
ini_set('display_errors', '1');

	require_once('config.php');
	require_once('dc/URLObserver.php');
	require_once('dc/PageEngine.php');
	require_once('dc/URLObserver.php');

	$Sections = dc_URLObserver::ParseURL();
	$URLObserver = dc_URLObserver::GetInstance();
	$URLObserver->dispatchEvents();

	echo dc_PageEngine::LoadPage($Sections);
	
?>
