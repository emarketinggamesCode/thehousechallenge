<?php
//start session
  session_start();
  //$ssname=session_name();

$server_name=$_SERVER['SERVER_NAME'];
$_serv="http://" . $server_name;
//include_once ($_SERVER['DOCUMENT_ROOT']."/src/functions.php");
$root=dirname(__FILE__);
//echo $root;
//echo $root. "/functions.php";
include_once ($root. "/functions.php");

$houseid=$_SESSION["hid"];
$price=$_SESSION["p"];  
$result=$_SESSION["result"];
$agentid=$_SESSION["agent"];
//echo "send form";

//echo "post". $_POST["email"];

if(isset($_POST['email'])) {


    // Edit the variables below to whoever like recieve the email

    $email_to = "laellyl@gmail.com";

    $email_subject = "Contact form Test";


    function died($error) {

        // your error code can go here

        echo "We are very sorry, but there were error(s) found with the form you submitted. ";

        echo "These errors appear below.<br /><br />";

        echo $error."<br /><br />";

        echo "Please go back and fix these errors.<br /><br />";

        die();

    }

     

    // validation expected data exists

    if(!isset($_POST['name']) ||

        !isset($_POST['email']) ||

        !isset($_POST['phone']) ||

        !isset($_POST['address'])) {

        died('We are sorry, but there appears to be a problem with the form you submitted.');       

    }

     $scheduletime= $_POST['scheduletime'];
     $approved=$_POST['Pre_Approved'];
     $agreement=$_POST['buyers_agreement'];
     $showtime=$_POST["showtime"];

    $name = $_POST['name']; // required

    $email_from = $_POST['email']; // required

    $phone = $_POST['phone']; // not required

    $address = $_POST['address']; // required

     

    $error_message = "";

    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  if(!preg_match($email_exp,$email_from)) {

    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';

  }

    $string_exp = "/^[A-Za-z .'-]+$/";

  if(!preg_match($string_exp,$name)) {

    $error_message .= 'The First Name you entered does not appear to be valid.<br />';

  }

  //if(!preg_match($string_exp,$last_name)) {

  //  $error_message .= 'The Last Name you entered does not appear to be valid.<br />';

  //}


  if(strlen($error_message) > 0) {

    died($error_message);

  }

    $email_message = "Form details below.\n\n";

     

    function clean_string($string) {

      $bad = array("content-type","bcc:","to:","cc:","href");

      return str_replace($bad,"",$string);

    }

     

    $email_message .= "Name: ".clean_string($name)."\n";

   // $email_message .= "Last Name: ".clean_string($last_name)."\n";

    $email_message .= "Email: ".clean_string($email_from)."\n";

    $email_message .= "Telephone: ".clean_string($phone)."\n";

    $email_message .= "Address: ".clean_string($address)."\n";

    if (isset($scheduletime))
     { $email_message .= "Preferred scheduling time = ". $scheduletime . "\n";}
    if (isset($agreement))
      { $email_message .= "Agree to Buyer's Agreement= ". $agreement . "\n";}
    if (isset($approved))
      { $email_message .= "Pre Approved = ". $approved . "\n"; }
    if (isset($showtime))
    { 
      $email_message .= " Preferred showing time: " . $showtime . "\n";
      $email_message .= "booked for showing- House id=". $houseid;
    }
//echo "current email message: <br> " . $email_message;        

// create email headers

$headers = "From:".$email_from;
/*
$headers = 'From: '.$email_from."\r\n".

'Reply-To: '.$email_from."\r\n" .

'X-Mailer: PHP/' . phpversion();
*/

mail($email_to, $email_subject, $email_message, $headers); 

}

if (isset($showtime) ) 
{ loadPage("choiceResult.php?result=". $result."&hid=". $houseid . "&p=".$price); }
else if (isset($scheduletime))
{ loadPage("GameOver.php?result=".$result."&hid=". $houseid . "&p=".$price."&last=1"); }
else
{ loadPage("GameOver.php?result=".$result."&hid=". $houseid . "&p=".$price);}

//loadPage("choiceResult.php?result=1&hid=". $houseid . "&p=".$price);

?> 