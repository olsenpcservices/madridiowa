<?php
	require_once('dc/Page.php');
	require_once('dc/Navigation.php');
	require_once('dc/DB.php');
	require_once('dc/form/Textbox.php');
	require_once('dc/form/TextArea.php');
	require_once('dc/form/Submit.php');
	require_once('dc/etc/Email.php');
	require_once('dc/Data/Validation/contactus.php');
	
	require_once('PASL/DB/DB.php');
	require_once('PASL/Web/Template/Type/Token.php');
	require_once('PASL/Web/Template/Type/Code.php');
	require_once('PASL/Data/Validation/Array.php');
	require_once('PASL/Web/Form/Form.php');
	
	class dc_Page_ContactUs extends dc_Page
	{
		public function __construct()
		{
			parent::__construct();
			
			$this->addCSSPackage('contactus.css');
			
			// The data validator
			$Validator = new PASL_Data_Validation_Array;
			$Validator->setData($_POST);
			$Validator->setGlobalCallback(array('dc_Data_Validation_ContactUs', 'Validate'));
			
			$DB = dc_DB::singleton();
			
			// Gather Data
			$query = $DB->query('SELECT Email, Phone, Address FROM contactus LIMIT 1');
			$query_result = $DB->fetchAll($query);
			
			$ContactUsVars['EMAIL'] = $query_result[0]['Email'];
			$ContactUsVars['PHONE'] = $query_result[0]['Phone'];
			$ContactUsVars['ADDRESS'] = $query_result[0]['Address'];
			
			$ContactUsTemplate = new PASL_Web_Template_Type_Token;
			$ContactUsTemplate->SetFile('themes/default/template/forms/contactus.html');
			
			if($Validator->Validate() && !empty($_POST['form_contactus']))
			{
				// Email Data
				$Email = new Email;

				$Email_Message = "Name: " . $_POST['name'] . "\n";
				$Email_Message .= "Phone: " . $_POST['phone'] . "\n";
				$Email_Message .= "Email Address: " . $_POST['email'] . "\n";
				$Email_Message .= "----------------------------------\n";
				$Email_Message .= "Comments: \n\n";
				$Email_Message .= $_POST['comments'] . "\n";
				
				$Email->SendTextEmail($ContactUsVars['ADDRESS'],"Don Carlos Realty", $Email_Message,false);
				
				$success_message['success_message'] = '<h3 class="success_message"><font>You\'ve successfully sent a message to Don Carlos Realty. Thank you for your feedback.</font></h3>';
				$ContactUsTemplate->addVariable($success_message);
				
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
			$Form->setAttribute('id', 'form_contactus');
			$Form->SetTemplate($ContactUsTemplate);
			$Form->SetFormData($_POST);
			$Form->SetId('form_contactus');
			$Form->setDataValidator($Validator);
			$Form->SetErrorClassName('large-grey-error');
			
			$Form->addItem($Name, 'name');
			$Form->addItem($Phone, 'phone');
			$Form->addItem($Email, 'email');
			$Form->addItem($Comments, 'comments');
			$Form->addItem($Submit, 'submit');
			

			$ContactUsVars['contactus'] .= (string) $Form;
			
			// Page template
			$Page = new PASL_Web_Template_Type_Token;
			$Page->SetFile('themes/default/template/pages/contactus.html');
			$Page->SetVariables($ContactUsVars);
			
			// Set the content
			$this->SetContent($Page);
		}
	}
?>