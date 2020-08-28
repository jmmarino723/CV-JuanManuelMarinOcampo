<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address
  /*
  $receiving_email_address = '<juanmanuel723@gmail.com>';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = $_POST['subject'];

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  
  $contact->smtp = array(
    'host' => 'smtp.gmail.com',
    'username' => 'juanmanuel723',
    'password' => '92112350324Aa',
    'port' => '587'
  );
 

  $contact->add_message( $_POST['name'], 'From');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['message'], 'Message', 10);

  echo $contact->send();
  */
  $from = '<juanmanuel723@gmail.com>';
  $sendTo = '<juanmanuel723@gmail.com>';
  $subject = 'New message from contact form';
  $fields = array('name' => 'Name', 'email' => 'Email', 'subject' => 'Subject', 'message' => 'Message'); // array variable name => Text to appear in email
  $okMessage = 'Contact form successfully submitted. Thank you, I will get back to you soon!';
  $errorMessage = 'There was an error while submitting the form. Please try again later';
  
  // let's do the sending
  
  try
  {
      $emailText = "You have new message from contact form\n=============================\n";
  
      foreach ($_POST as $key => $value) {
  
          if (isset($fields[$key])) {
              $emailText .= "$fields[$key]: $value\n";
          }
      }
  
      mail($sendTo, $subject, $emailText, "From: " . $from);
  
      $responseArray = array('type' => 'success', 'message' => $okMessage);
  }
  catch (\Exception $e)
  {
      $responseArray = array('type' => 'danger', 'message' => $errorMessage);
  }
  
  if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $encoded = json_encode($responseArray);
      
      header('Content-Type: application/json');
      
      echo $encoded;
  }
  else {
      echo $responseArray['message'];
  }

?>
