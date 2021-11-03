<?php

$myEmail="yvonne.richardson@comcast.net";
$subject = "DSGN 233 Website contact form";
$headers = "From: $email";

/* Check for form inputs required fields */
$lastName = check_input($_POST['lastName'], "Enter last name");

/*non required fields */
$firstName = ($_POST['firstName']);
$phone = ($_POST['tel']);
$email = ($_POST['email']);
$state = ($_POST['state']);
$comments = ($_POST['comments']);

/*prepare the email message*/

$message = "Hello, 
Your contact form has been submitted by:
$firstName
$lastName
$phone 
$email 
From $state

$comments 

End of message";

/* send the email */

mail($myEmail, $subject, $message, $headers);

// redirect the user to a new page

header('Location: ../thanks.html');

/* funtion to check required fields */

function check_input($data,$problem = '') {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	if ($problem && strlen($data) == 0) {
		show_error($problem);
	}
	return $data;
	
	
}
function show_error($myError) {
	?>
<html>
<body>
	<strong>Please correct the following errors:
	</strong><br>
	<?php echo $myError; ?>
	
	</body>
</html>
	<?php
	exit();
}
?>
