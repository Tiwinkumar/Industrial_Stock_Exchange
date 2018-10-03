<?php
require("config.php");


if (isset($_POST['submit'])) {
	
$email = mysqli_real_escape_string($conn, $_POST['email']);

$result = mysqli_query($conn, "SELECT * FROM login WHERE email='$email'");

if($res = mysqli_fetch_array($result))
{
$password = $res['password'];

include("src/Mailjet/php-mailjet-v3-simple.class.php");
// This calls sends an email to one recipient.
$mj = new Mailjet('6769b05bbd5e29c2f3f37c5f920858a1','d53cbbab9db55ede436cdcbea70b414c');

    $params = array(
        "method" => "POST",
        "from" => "feedback@industrialstockexchange.com",
        "to" => $email,
        "subject" => "Your Account Password ",
        "text" => "Your Password is " . $password
    );

    $result = $mj->sendEmail($params);

    if ($mj->_response_code == 200)
       echo "success - email sent";
    else
       echo "error - ".$mj->_response_code;

     header("Location: signin.php");



} else {
	$password = "No Records Found";

	  header("Location: forgot.html");


}
 //echo $password;
}



?>
