<?php
	require_once('PASL/Web/Form/Item/Input.php');

	class dc_form_Submit extends PASL_Web_Form_Item_Input
	{
		public function __construct()
		{
			parent::__construct();

			$this->setValue('Submit');
			$this->SetType('submit');
			$this->setClassName('submit');
		}

		public function __toString()
		{
			$Submit = parent::__toString();

			//$Wrapper = '<div class="small-green-button-cap"><div class="small-green-button-fill"><center>'.$Submit.'</center></div></div>';

			return $Submit;
		}
	}
?>