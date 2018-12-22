<?php 
session_start();
unset($_SESSION['uid']); //session yokedildi 
unset($_SESSION['name']);
header('LOCATION:index.php'); 

?>