<?php
	
class Email {
	
	public function __construct() {
		define("OUTBOUND_EMAIL_NAME","Website");
		define("OUTBOUND_EMAIL","website@doncarlosrealty.com");
	}
	
	public function SendTextEmail($to, $subject, $message,$header = true) {
		$Headers .= "From: ". OUTBOUND_EMAIL_NAME . " <" . OUTBOUND_EMAIL . ">\n";
		$Headers .= "Reply-To: ". OUTBOUND_EMAIL_NAME . " <" . OUTBOUND_EMAIL . ">\n";

		
		if($header == true) {
			$message = Email::AddTextTemplate($message);
		}

		$EmailResult = @mail($to, $subject, "$message", $Headers);
		
		return ($EmailResult) ? true : false;
	}

	public function SendAdvancedHTMLTextEmail($to, $subject, $message, $html_message,$header = true) {
		$RandomHash = md5(date('r', time())); 
		$Boundary = "==Multipart_Boundary_x".$RandomHash."x";
		
		$Headers = "MIME-Version: 1.0\n";
		$Headers .= "From: ". OUTBOUND_EMAIL_NAME . " <" . OUTBOUND_EMAIL . ">\n";
		$Headers .= "Reply-To: ". OUTBOUND_EMAIL_NAME . " <" . OUTBOUND_EMAIL . ">\n";
		$Headers .= "Content-Type: multipart/alternative; boundary=\"".$Boundary."\"\nX-Priority: 3\n";
		$Headers .= "Conent-Transfer-Encoding: quoted-printable";
		
		$TextMessage = strip_tags(DataCleaner::BRP2NL($message));

		if($header == true) {
			$html_message = Email::AddHTMLTemplate($html_message);
			$TextMessage = Email::AddTextTemplate($TextMessage);
		}
		
		$Body .= "--" . $Boundary . "\n"; 
		$Body .= "Content-type: text/plain\n";
		$Body .= "Content-Transfer-Encoding: quoted-printable\n\n";
		$Body .= $TextMessage; 
		$Body .= "\n\n--" . $Boundary . "\n";
		$Body .= "Content-type: text/html\n";
		$Body .= "Content-Transfer-Encoding: 7bit\n\n";
		$Body .= $html_message;
		$Body .= "\n\n--" . $Boundary . "--\n";
		
		$EmailResult = @mail($to, $subject, $Body, $Headers);
		
		return ($EmailResult) ? true : false;		
	}
	
	public function SendHTMLTextEmail($to, $subject, $message, $header = true) {
		$RandomHash = md5(date('r', time())); 
		$Boundary = "==Multipart_Boundary_x".$RandomHash."x";
		
		$Headers = "MIME-Version: 1.0\n";
		$Headers .= "From: ". OUTBOUND_EMAIL_NAME . " <" . OUTBOUND_EMAIL . ">\n";
		$Headers .= "Reply-To: ". OUTBOUND_EMAIL_NAME . " <" . OUTBOUND_EMAIL . ">\n";
		$Headers .= "Content-Type: multipart/alternative; boundary=\"".$Boundary."\"\nX-Priority: 3\n";
		$Headers .= "Conent-Transfer-Encoding: quoted-printable";
		
		//$TextMessage = strip_tags(DataCleaner::BRP2NL($message));

		if($header == true) {
			$message = Email::AddHTMLTemplate($message);
			$TextMessage = Email::AddTextTemplate($TextMessage);
		}
		
		$Body .= "--" . $Boundary . "\n"; 
		$Body .= "Content-type: text/plain\n";
		$Body .= "Content-Transfer-Encoding: quoted-printable\n\n";
		$Body .= $TextMessage; 
		$Body .= "\n\n--" . $Boundary . "\n";
		$Body .= "Content-type: text/html\n";
		$Body .= "Content-Transfer-Encoding: 7bit\n\n";
		$Body .= $message;
		$Body .= "\n\n--" . $Boundary . "--\n";
		
		$EmailResult = @mail($to, $subject, $Body, $Headers);
		
		return ($EmailResult) ? true : false;		
	}
	
	public function SendEmailFromFile($to, $subject, $file, $EmailVariables) {
		//Preparing Variables for use in the file
		extract($EmailVariables, EXTR_OVERWRITE);
		unset($EmailVariables);
		
		//Setting Headers
		$Headers = "From: " . OUTBOUND_EMAIL;
		$Headers .= "\r\nContent-Type: multipart/alternative; boundary=\"".$Boundry."\""; 
		
		//Reading in and saving the file to a variable
		ob_start();
		eval("?>".implode("",file($actionView))."<?");
		$FileMessage = ob_get_contents();
		ob_end_clean();
		
		$EmailResult = @mail($to, $subject, $FileMessage, $headers);
		
		return ($EmailResult) ? true : false;			
	}
	
	public function AddHTMLTemplate($message) {
		//Reading in and saving the header file to a variable
		ob_start();
		eval("?>".implode("",file(EMAIL_HTMLTEMPLATE_LOCATION))."<?");
		$HeaderMessage = ob_get_contents();
		ob_end_clean();	

		return (DataCleaner::StringCompare($HeaderMessage, "") == false) ? $HeaderMessage : $message;
	}
	
	public function AddTextTemplate($message) {
		//Reading in and saving the header file to a variable
		ob_start();
		eval("?>".implode("",file(EMAIL_TEXTTEMPLATE_LOCATION))."<?");
		$HeaderMessage = ob_get_contents();
		ob_end_clean();	
		
		return (DataCleaner::StringCompare($HeaderMessage, "") == false) ? $HeaderMessage : $message;
	}
	
}

?>