<?php
	require_once('dc/Page.php');
	require_once('dc/Navigation.php');
	require_once('dc/DB.php');
	
	require_once('PASL/DB/DB.php');
	require_once('PASL/Web/Template/Type/Token.php');
	require_once('PASL/Web/Template/Type/Code.php');
	
	class dc_Page_School extends dc_Page
	{
		public function __construct()
		{
			parent::__construct();

                        $this->addCSSPackage('content.css');
                               
                        $DB = dc_DB::singleton();
			
			// Gather Data
			$query = $DB->query('SELECT post_title,post_content FROM wp_posts WHERE ID=571 LIMIT 1');
			$query_result = $DB->fetchAll($query);
			
			$content['content'] = nl2br($query_result[0]['post_content']);
			$content['title'] = $query_result[0]['post_title'];
			
			// Page template
			$Page = new PASL_Web_Template_Type_Token;
			$Page->SetFile('themes/default/template/pages/general.html');
			$Page->SetVariables($content);
			
			// Set the content
			$this->SetContent($Page);
		}
	}
?>
