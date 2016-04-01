<?php 
use Models\Core\Token;
use Models\Core\Validator;
use Models\Core\Mail;
use Models\Core\Contacts;

$app->get('/contacts', function() use ($app) {
$app->log->info("It is -- contacts -- router");
$token = Token::generate();
$info = array(
	'name' => "Please provide your first name *",
	'lastname' => "Please provide your last name *",
	'email' => "Please provide your new email address *",
	'phone' => "Please provide your phone *",
	'subject' => "Please provide the subject for your enquiry *",
	'type' => "Please select option type *",
	'message' => "Please provide your enquiry *");
$types = array (1 => 'Product', 2 => 'Billing', 3 => 'Support');
$selected = '3';
$app->render('contacts.html', [
	'info' => $info,
	'types' => $types,
	'selected' => $selected,
	'token' => $token]);});

$app->post('/contacts', function() use ($app) {
	if (isset($_POST['action']) and $_POST['action'] == 'Submit') {
		$name 		= stripslashes(trim($_POST['name']));
		$lastname 	= stripslashes(trim($_POST['lastname']));
		$email   	= stripslashes(trim($_POST['email']));
		$subject 	= stripslashes(trim($_POST['subject']));
		$message 	= stripslashes(trim($_POST['message']));
		$token 		= stripslashes(trim($_POST['token']));
		if (Token::check($token)
			&& Validator::checkName($name)
			&& Validator::checkLastname($lastname)			
			&& filter_var($email, FILTER_VALIDATE_EMAIL)			
			&& Validator::checkSubject($subject)
			&& Validator::checkMessage($message)
			) {
			$mail = Mail::message($name, $lastname, $email, $subject, $message);
			Contacts::add_contact($mail);
			$flash = $app->flash('success', 'Enquiry is sent!');
			echo "true";}
		else {
			$flash = $app->flash('error', 'It is not sent!');
			echo "false";}}

	if (isset($_POST['name']) and $_POST['action'] == 'onChange') {
		$name = $_POST['name'];	
		$val = Validator::checkName($name);	
		echo($val?("true"):("false"));
		}

	if (isset($_POST['lastname']) and $_POST['action'] == 'onChange') {
		$lastname = $_POST['lastname'];	
		$val = Validator::checkLastname($lastname);	
		echo($val?("true"):("false"));}

	if (isset($_POST['email']) and $_POST['action'] == 'onChange') {
		$email = $_POST['email'];	
		$val = Validator::checkEmail($email);	
		echo($val?("true"):("false"));}

	if (isset($_POST['subject']) and $_POST['action'] == 'onChange') {		
		$subject = $_POST['subject'];	
		$val = Validator::checkSubject($subject);	
		echo($val?("true"):("false"));}

	if (isset($_POST['message']) and $_POST['action'] == 'onChange') {
		$message = $_POST['message'];	
		$val = Validator::checkMessage($message);	
		echo($val?("true"):("false"));}
});