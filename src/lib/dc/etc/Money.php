<?php
	class dc_etc_Money
	{
		public function FormatMoney($money) {
			return "$" . number_format($money);
		}
	}
?>