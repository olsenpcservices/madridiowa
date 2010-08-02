<?php
	require_once('dc/Page.php');
	require_once('dc/Navigation.php');
	require_once('dc/DB.php');
	require_once('dc/etc/Money.php');
	
	require_once('PASL/DB/DB.php');
	require_once('PASL/Web/Template/Type/Code.php');
	require_once('PASL/Web/Template/Type/Token.php');
	
	class dc_Page_OurListings extends dc_Page
	{
		public function __construct()
		{
			parent::__construct();
			
			$this->addCSSPackage('ourlistings.css');
			$this->addJSPackage('ourlistings.js');
			
			$DB = dc_DB::singleton();
			
			// Gather Data
			$query = $DB->query('SELECT Id, Address1, Address2, City, Zip, State, Price, Description, Name, Sold, Pending FROM properties where Status = 1');
			$query_result = $DB->fetchAll($query);

			$i = 0;
			foreach($query_result as $property) {
				
				$detailsquery = $DB->query('SELECT COALESCE( detail_values.Value, property_details.Value ) pValue, details.Units ' .
					'FROM property_details ' .
					'INNER JOIN details ON details.Id = property_details.dId ' .
					'LEFT OUTER JOIN detail_values ON detail_values.Id = property_details.vId ' .
					'WHERE property_details.pID = ' . $property['Id'] . ' ' .
					'AND property_details.shortdescription = 1');
				$detailsquery_result = $DB->fetchAll($detailsquery);
				unset($details);
				if(count($detailsquery_result) > 0) 
				foreach($detailsquery_result as $detail) {
					$details[] = join(" ", $detail);
				}
								
				$ourlistingsVar['PROPERTIES'][$i]['ID'] = $property['Id'];
				$ourlistingsVar['PROPERTIES'][$i]['NAME'] = $property['Name'];
				$ourlistingsVar['PROPERTIES'][$i]['PRICE'] = dc_etc_Money::FormatMoney($property['Price']);
				$ourlistingsVar['PROPERTIES'][$i]['DESCRIPTION'] = (strlen($property['Description']) > 100) ? substr($property['Description'],0,100) . "..." : $property['Description'];
				$ourlistingsVar['PROPERTIES'][$i]['DETAILS'] = (count($details) > 0) ? join(", ", $details) : "";
				$ourlistingsVar['PROPERTIES'][$i]['SOLD'] = ($property['Sold'] == 1) ? true : false;
				$i++;
			}
			
			
			$OurListingsTemplate = new PASL_Web_Template_Type_Code;
			$OurListingsTemplate->SetFile('themes/default/template/forms/ourlistings.php');
			$OurListingsTemplate->SetVariables($ourlistingsVar);
			
			$Vars['ourlistings'] = (string) $OurListingsTemplate;
			
			$Page = new PASL_Web_Template_Type_Token;
			$Page->SetFile('themes/default/template/pages/ourlistings.html');
			$Page->SetVariables($Vars);
			
			$this->SetContent($Page);
		}
	}
?>