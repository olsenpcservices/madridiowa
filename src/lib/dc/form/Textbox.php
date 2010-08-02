<?php
	require_once('PASL/Web/Form/Item/Input.php');

	class dc_form_Textbox extends PASL_Web_Form_Item_Input
	{
		public function __construct()
		{
			parent::__construct();
			$this->SetType('text');
			$this->setClassName('grey');
		}

		public function __toString()
		{
			$Input = parent::__toString();

			return $Input;
		}
	}
?>