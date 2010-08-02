<?php
	require_once('dc/Page.php');
	require_once('dc/Navigation.php');
	require_once('dc/DB.php');

	require_once('PASL/DB/DB.php');
	require_once('PASL/Web/Template/Type/Token.php');
	require_once('PASL/Web/Template/Type/Code.php');
	
	class dc_Page_AboutUs extends dc_Page
	{
		public function __construct()
		{
			parent::__construct();
			
			$this->addCSSPackage('aboutus.css');
			
			$DB = dc_DB::singleton();
			
			// Gather Data
			$query = $DB->query('SELECT Text FROM aboutus LIMIT 1');
			$query_result = $DB->fetchAll($query);

			$AboutUsVars['Content'] = $query_result[0]['Text'];
			
			//$AboutUsVars['Content'] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non magna pharetra velit placerat volutpat. In tempus feugiat nisi non mattis. Nunc euismod pulvinar neque euismod congue. Maecenas orci elit, auctor sed ultrices id, vestibulum id ipsum. Nullam et tortor urna, eget hendrerit ante. Donec id augue nisl, ut varius augue. Nullam suscipit sagittis metus ac aliquet. Nulla mollis fermentum lectus in sagittis. Maecenas facilisis cursus urna quis scelerisque. Donec nec ante sodales enim euismod posuere. Morbi eu fermentum magna." .
			//"<br /><br />Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non magna pharetra velit placerat volutpat. In tempus feugiat nisi non mattis. Nunc euismod pulvinar neque euismod congue. Maecenas orci elit, auctor sed ultrices id, vestibulum id ipsum. Nullam et tortor urna, eget hendrerit ante. Donec id augue nisl, ut varius augue. Nullam suscipit sagittis metus ac aliquet. Nulla mollis fermentum lectus in sagittis. Maecenas facilisis cursus urna quis scelerisque. Donec nec ante sodales enim euismod posuere. Morbi eu fermentum magna.";
			
			$AboutUsTemplate = new PASL_Web_Template_Type_Code;
			$AboutUsTemplate->SetFile('themes/default/template/forms/aboutus.php');
			$AboutUsTemplate->SetVariables($AboutUsVars);	
			
			$vars['aboutus'] .= (string) $AboutUsTemplate;
			
			// Page template
			$Page = new PASL_Web_Template_Type_Token;
			$Page->SetFile('themes/default/template/pages/aboutus.html');
			$Page->SetVariables($vars);
			
			// Set the content
			$this->SetContent($Page);
		}
	}
?>