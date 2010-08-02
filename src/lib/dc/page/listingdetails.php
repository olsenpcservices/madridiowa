<?php
	require_once('dc/Page.php');
	require_once('dc/Navigation.php');
	require_once('dc/DB.php');
	require_once('dc/form/Textbox.php');
	require_once('dc/form/TextArea.php');
	require_once('dc/form/Submit.php');
	require_once('dc/etc/Money.php');
	require_once('dc/Data/Validation/contactus.php');
	require_once('dc/etc/Email.php');
	
	require_once('PASL/DB/DB.php');
	require_once('PASL/Web/Template/Type/Token.php');
	require_once('PASL/Web/Template/Type/Code.php');
	require_once('PASL/Web/Form/Form.php');
	require_once('PASL/Data/Validation/Array.php');
	
	class dc_Page_ListingDetails extends dc_Page
	{
		public function __construct()
		{
			parent::__construct();
			
			$DB = dc_DB::singleton();
						
			$this->addCSSPackage('listingdetails.css');
			$this->addExternalJSPackage('http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=ABQIAAAA4deha_kzYVClfeJ29StKWhStZmDlv_OWr55cC3TlLjpZ9am1_BQUVQYVreFYurgEoMriJu2zW3sl-g');
			$this->addJSPackage('listingdetails.js');
			//$this->addExternalJSPackage('http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAA4deha_kzYVClfeJ29StKWhRbeySkdhQDHdNoxhNdShc_lR7LHBTloAypoWL0swTmxrUJ--eOjN-xaA');
			
			// The data validator
			$Validator = new PASL_Data_Validation_Array;
			$Validator->setData($_POST);
			$Validator->setGlobalCallback(array('dc_Data_Validation_ContactUs', 'Validate'));
			
			// Gather Data
			$contactusquery = $DB->query('SELECT Email, Phone FROM contactus LIMIT 1');
			$contactusquery_result = $DB->fetchAll($contactusquery);
			
			// Gather Data
			$query = $DB->query('SELECT Id, Address1, Address2, City, Zip, State, Price, Description, Name, Sold FROM properties where Id = ' . $_GET['id'] . ' LIMIT 1');
			$query_result = $DB->fetchAll($query);
			if(count($query_result) <= 0) {
					// Page template
					$Page = new PASL_Web_Template_Type_Token;
					$Page->SetFile('themes/default/template/pages/error.html');
					$Page->SetVariables(Array("ERROR"=>"This property does not exist."));
					
					// Set the content
					$this->SetContent($Page);	
					return;
				}
				
			$ListingDetailsTemplate = new PASL_Web_Template_Type_Token;
			$ListingDetailsTemplate->SetFile('themes/default/template/forms/listingdetails/form.html');
			//$ListingDetailsTemplate->SetVariables($ListingDetailsVars);	

			if($Validator->Validate() && !empty($_POST['form_listingdetails']))
			{
				// Email Data
				$Email = new Email;

				$Email_Message = "Name: " . $_POST['name'] . "\n";
				$Email_Message .= "Phone: " . $_POST['phone'] . "\n";
				$Email_Message .= "Email Address: " . $_POST['email'] . "\n";
				$Email_Message .= "Name of Property: " . $query_result[0]['Name'] . "\n";
				$Email_Message .= "Link to Property: http://www.doncarlosrealty.com/listingdetails/" . $query_result[0]['Id'] . "\n";
				$Email_Message .= "----------------------------------\n";
				$Email_Message .= "Comments: \n\n";
				$Email_Message .= $_POST['comments'] . "\n";
				
				$Email->SendTextEmail($contactusquery_result[0]['Email'],"Don Carlos Realty", $Email_Message,false);
				
				$success_message['success_message'] = '<h3 class="success_message"><font>You\'ve successfully sent a message to Don Carlos Realty. Thank you for your feedback.</font></h3>';
				$ListingDetailsTemplate->addVariable($success_message);
				
				$_POST = null;
			}
			

			
			$Name = new dc_form_Textbox;
			$Name->setName('name');
			$Name->setAttribute('style', 'margin-left: 9px; width: 200px;');

			$Phone = new dc_form_Textbox;
			$Phone->setName('phone');
			$Phone->setAttribute('style', 'margin-left: 9px; width: 200px;');
			
			$Email = new dc_form_Textbox;
			$Email->setName('email');
			$Email->setAttribute('style', 'margin-left: 9px; width: 200px;');

			$Comments = new dc_form_TextArea;
			$Comments->setName('comments');
			$Comments->setAttribute('style', 'width: 352px; height: 130px;');

			$Submit = new dc_form_Submit;
			$Submit->setName('submit');

			
			$Form = new PASL_Web_Form;
			$Form->setAttribute('method', 'POST');
			$Form->setAttribute('action', '');
			$Form->setAttribute('id', 'form_listingdetails');
			$Form->SetTemplate($ListingDetailsTemplate);
			$Form->SetFormData($_POST);
			$Form->SetId('form_listingdetails');
			$Form->setDataValidator($Validator);
			$Form->SetErrorClassName('large-grey-error');
			
			$Form->addItem($Name, 'name');
			$Form->addItem($Phone, 'phone');
			$Form->addItem($Email, 'email');
			$Form->addItem($Comments, 'comments');
			$Form->addItem($Submit, 'submit');


			$dir="themes/default/images/property/small/" . $query_result[0]['Id']; // Directory where files are stored
			
			if ($dir_list = opendir($dir)) {
				while(($filename = readdir($dir_list)) !== false) {
					if($filename != '..' and $filename != '.') {
						$imagevars['IMAGES'][] = $filename;
					}
				}
				closedir($dir_list);
			}
			$imagevars['ID'] = $query_result[0]['Id'];
			
			$ImagesPage = new PASL_Web_Template_Type_Code;
			$ImagesPage->SetFile('themes/default/template/forms/listingdetails/imagelist.php');
			$ImagesPage->SetVariables($imagevars);
			
			$detailsquery = $DB->query('SELECT COALESCE( detail_values.Value, property_details.Value ) Value, details.Name ' .
				'FROM property_details ' .
				'INNER JOIN details ON details.Id = property_details.dId ' .
				'LEFT OUTER JOIN detail_values ON detail_values.Id = property_details.vId ' .
				'WHERE property_details.pID = ' .  $_GET['id']);
			$detailsquery_result = $DB->fetchAll($detailsquery);
			
			$DetailsPage = new PASL_Web_Template_Type_Token;
			foreach($detailsquery_result as $detail) {
				$DetailsPage->SetFile('themes/default/template/forms/listingdetails/details.html');
				$DetailsPage->SetVariables($detail);
				$vars['DETAILS'] .= (string) $DetailsPage;
			}
				
			$vars['CONTACTEMAIL'] = $contactusquery_result[0]['Email'];
			$vars['CONTACTPHONE'] = $contactusquery_result[0]['Phone'];
			$vars['NAME'] = $query_result[0]['Name'];
			$vars['ADDRESS'] = $query_result[0]['Address1'] . ' ' . $query_result[0]['Address2'];
			$vars['LOCATION'] = $query_result[0]['City'] . ', ' . $query_result[0]['State'] . ' (' . $query_result[0]['Zip'] . ')';
			$vars['PRICE'] = dc_etc_Money::FormatMoney($query_result[0]['Price']);
			$vars['DESCRIPTION'] = $query_result[0]['Description'];
			$vars['ID'] = $query_result[0]['Id'];
			$vars['LISTINGDETAILS'] .= (string) $Form;
			$vars['IMAGES'] = (string) $ImagesPage;
			$vars['SOLD'] = ($query_result[0]['Sold'] == 1) ? true : false;
			
			
			// Page template
			$Page = new PASL_Web_Template_Type_Code;
			$Page->SetFile('themes/default/template/pages/listingdetails.php');
			$Page->SetVariables($vars);
			
			// Set the content
			$this->SetContent($Page);
		}
	}
?>