<?php
include("src/Mailjet/php-mailjet-v3-simple.class.php");
// This calls sends an email to one recipient.
$mj = new Mailjet('6769b05bbd5e29c2f3f37c5f920858a1','d53cbbab9db55ede436cdcbea70b414c');

    $params = array(
        "method" => "POST",
        "from" => "tiwinkumar.tk@gmail.com",
        "to" => "tiwin1998@gmail.com",
        "subject" => "Hello World!",
        "text" => "Greetings from Mailjet."
    );

    $result = $mj->sendEmail($params);

    if ($mj->_response_code == 200)
       echo "success - email sent";
    else
       echo "error - ".$mj->_response_code;
   ?>