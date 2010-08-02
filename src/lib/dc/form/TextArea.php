<?php
	require_once('PASL/Web/Form/Item/TextArea.php');

	class dc_form_TextArea extends PASL_Web_Form_Item_TextArea
	{
		public function __construct()
		{
			parent::__construct();
			$this->setClassName('grey');
		}

		public function __toString()
		{
			$Input = parent::__toString();

			return $Input;
		}
	}
?>