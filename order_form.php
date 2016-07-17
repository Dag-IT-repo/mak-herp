<?php
if(isset($_POST['email'])) {
     
    $email_to = "maphuti.setumu@mak-herp.co.za";  
    $email_subject = "Mak-Herp Book Order Form";
     
     
    function died($error) {
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "The below error(s) were found.<br /><br />";
        echo $error."<br /><br />";
        echo "Please click back and rectify these errors.<br /><br />";
        die();
    }
		if(!isset($_POST['name']) ||
		!isset($_POST['email']) ||
		!isset($_POST['telephone']) ||
		!isset($_POST['address']) ||
		!isset($_POST['book']) ||
		!isset($_POST['message'])) {
    died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }

	$name = $_POST['name']; // required
	$email_from = $_POST['email']; // required
	$telephone = $_POST['telephone']; // not required
	$address = $_POST['address']; // required
    $message = $_POST['message']; // required
	$book = $_POST['book']; // required


    $error_message = "Form fields not completed successfully.<br />";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid. Please use the following format email@domain.com/co.za/.org/.net, etc.<br />';
  }
	$string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'The Name you entered does not appear to be valid.<br />';
  }
	if(!preg_match($string_exp,$address)) {
		$error_message .= 'The Subject you entered does not appear to be valid.<br />';
	}
	if(strlen($telephone) < 10) {	
    $error_message .= 'The Telephone number you entered does not appear to be valid.<br />';
  }	
  	if(strlen($book) < 3) {	
    $error_message .= 'The Book you entered does not appear to be valid.<br />';
  }	
  if(strlen($message) < 5) {
    $error_message .= 'The message you entered does not appear to be valid.<br />';
  }
	if(strlen($error_message) < 2) {
    died($error_message);
  }
  $email_message = "Book Order Enquiry form. \nAn order was placed for the following book(s):\n\n";
	
	function clean_string($string) {
		$bad = array("content-type","bcc:","to:","cc:","href");
		return str_replace($bad,"",$string);
	}
     
	$email_message .= "Name: ".clean_string($name)."\n";
	$email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
	$email_message .= "Address: ".clean_string($address)."\n";
    $email_message .= "Book: ".clean_string($book)."\n";
	$email_message .= "Message: ".clean_string($message)."\n\nSyntax Systems automated mail delivery system";
    
     
	// create email headers
	$headers = 'From: '.$email_from."\r\n".
		'Reply-To: '.$email_from."\r\n" .
		'X-Mailer: PHP/' . phpversion();
	@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- Success -->
 
Thank you for contacting us. Your details have been submitted. <br><br>
We will be in touch with you soon.<br><br>
Hit back to return to the previous screen
 
<?php
}
die();
?>