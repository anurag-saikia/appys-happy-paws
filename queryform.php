<?php
if(isset($_POST['email'])) {


    $email_to = "appyshappypaws@gmail.com";
    $email_subject = "Query";

    function died($error) {

        echo '<div style="font-size:1.75em;color:#29a19c;font-weight:bold;">
              <br/>We are very sorry, but there were error(s) found with the form you submitted.<br/>
              </div>';
        echo '<div style="font-size:1.75em;color:#29a19c;font-weight:bold;">
              These errors appear below<br/><br/>
              </div>';
        echo  "<h3 style='color:red;'>".$error."</h3>";

        echo '<div style="font-size:1.75em;color:#ee4540;font-weight:bold;">
              Please go back and fix these errors<br/>
              </div>';
        echo "<br/>" . "<h3><a href='sendquery.html' style='text-decoration:underline;color:#ff0099;'> Return Form</a></h3>";
        die();
    }



    if(!isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['comments'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');
    }



    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email_from = $_POST['email'];
    $telephone = $_POST['telephone'];
    $comments = $_POST['comments'];

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }

  $num_exp = "/^[0-9]+$/";

if(!preg_match($num_exp,$telephone)) {
  $error_message .= 'The Mobile Number you entered does not appear to be valid.<br />';
}

    $string_exp = "/^[A-Za-z .'-]+$/";

  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }

  if(!preg_match($string_exp,$last_name)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }

  if(strlen($comments) < 2) {
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }

  if(strlen($error_message) > 0) {
    died($error_message);
  }

    $email_message = "Form details below.\n\n";


    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }



    $email_message .= "First Name: ".clean_string($first_name)."\n";
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";


$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
?>


<?php
    echo '<div style="font-size:1.75em;color:#3fc5f0;font-weight:bold;">
          <br/><br/>Thank you for contacting us. We will be in touch with you very soon<br/>
          </div>';
    echo "<br/>" . "<h3><a href='index.html' style='text-decoration:underline;color:#ff0099;'> Return Home</a></h3>";
 ?>



<?php

}
?>
