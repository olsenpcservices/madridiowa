<?php
	class dc_Data_Validation_ContactUs
	{
		public static function Validate($key, $value)
		{
			$error = false;

			switch($key)
			{
				case 'name':
					if(!$value) $error = 'Please fill out your Name.';
				break;

				case 'phone':
					if(!$value) $error = 'Please fill out your Phone.';
				break;

				case 'email':
					if(!$value) $error = 'Please fill out Email Address.';
				break;
				
				case 'comments':
					if(!$value) $error = 'Please fill out the Comments field.';
				break;
				
				default:
					return true;
				break;
			}

			if($error) return '<h3 class="form_error"><font class="form_error">'.$error.'</font></h1>';
			else return true;
		}
	}

?>