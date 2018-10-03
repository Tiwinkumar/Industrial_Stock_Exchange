<?php
session_start();
  // Create database connection
require("config.php");

  // Initialize message variable
  $msg = "";

if (isset($_POST['submit'])) {
$title = mysqli_real_escape_string($conn, $_POST['title']);
$hsncode = mysqli_real_escape_string($conn, $_POST['hsncode']);
$price = mysqli_real_escape_string($conn, $_POST['price']);
$quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$companyname = mysqli_real_escape_string($conn, $_POST['companyname']);
$sellermail = mysqli_real_escape_string($conn, $_POST['sellermail']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$location = mysqli_real_escape_string($conn, $_POST['location']);
$country = mysqli_real_escape_string($conn, $_POST['country']);
$zipcode = mysqli_real_escape_string($conn, $_POST['zipcode']);

$autoinc_sql = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'industri_exchange' AND TABLE_NAME = 'advertisement'";
$autoinc_exec = mysqli_query($conn, $autoinc_sql);
$autoinc_fetch = mysqli_fetch_array($autoinc_exec);
$autoinc_id = $autoinc_fetch["AUTO_INCREMENT"];
//die($autoinc_id);
$img1 = $autoinc_id."img1".$_FILES['img1']['name'];

    $target1 = "product_image/".basename($img1);

    if (move_uploaded_file($_FILES['img1']['tmp_name'], $target1)) {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }

$img2 = $autoinc_id."img2".$_FILES['img2']['name'];

    $target2 = "product_image/".basename($img2);

    if (move_uploaded_file($_FILES['img2']['tmp_name'], $target2)) {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }


$img3 = $autoinc_id."img3".$_FILES['img3']['name'];

    $target3 = "product_image/".basename($img3);

    if (move_uploaded_file($_FILES['img3']['tmp_name'], $target3)) {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }


$img4 = $autoinc_id."img4".$_FILES['img4']['name'];

    $target4 = "product_image/".basename($img4);

    if (move_uploaded_file($_FILES['img4']['tmp_name'], $target4)) {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }

$sql = "INSERT INTO advertisement (title,hsncode,description,name,companyname,sellermail,phone,location,country,zipcode,img1,img2,img3,img4,price,quantity,userid) VALUES ('$title', '$hsncode', '$description', '$name', '$companyname', '$sellermail', '$phone', '$location', '$country', '$zipcode', '$img1', '$img2', '$img3', '$img4', '$price', '$quantity','".$_SESSION["member_id"]."')";



    mysqli_query($conn, $sql);

     header("Location: products.php");


 }

?>