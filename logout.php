<?php
session_start();
$_SESSION["member_id"] = "";
$_SESSION["status"] = false;
session_destroy();
header("Location: ./signin.php");
?>