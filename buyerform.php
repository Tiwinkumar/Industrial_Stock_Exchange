<?php
session_start();
require("config.php");


if (isset($_POST['submit'])) {
	
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
$subject = mysqli_real_escape_string($conn, $_POST['subject']);
$hsncode = mysqli_real_escape_string($conn, $_POST['hsncode']);
$message = mysqli_real_escape_string($conn, $_POST['message']);
$price = mysqli_real_escape_string($conn, $_POST['price']);
$quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
$location = mysqli_real_escape_string($conn, $_POST['location']);
$company = mysqli_real_escape_string($conn, $_POST['cname']);

$sql = "INSERT INTO enquiry (name,email,mobile,subject,hsncode,message,price,quantity,userid,location,cmpname) VALUES ('$name', '$email', '$mobile', '$subject', '$hsncode', '$message', '$price', '$quantity','".$_SESSION["member_id"]."','".$location."','".$company."')";



    mysqli_query($conn, $sql);

    header("Location: buyerview.php");


 }

?>