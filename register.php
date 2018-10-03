<?php
require("config.php");


if (isset($_POST['submit'])) {
	
$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
$mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$gender = mysqli_real_escape_string($conn, $_POST['radioInline2']);
$companyname = mysqli_real_escape_string($conn, $_POST['companyname']);

$sql = "INSERT INTO login (fname,lname,phone,email,password,gender,cmpname) VALUES ('$firstname', '$lastname', '$mobile', '$email', '$password', '$gender', '$companyname')";

    mysqli_query($conn, $sql);

  header("Location: signin.php");


 }

?>