<?php 
include 'db.php';

$f_name=$_POST["f_name"];
$l_name=$_POST["l_name"];
$email=$_POST["email"];
$password=$_POST["password"];
$mobile=$_POST["mobile"];
$repassword=$_POST["repassword"];
$address1=$_POST["address1"];
$address2=$_POST["address2"];
$name="/^[a-zA-Z ]*$/";
$number="/^[0-9]+$/";

$emailValidation="/^[a-z0-9-]+(\.[a-z0-9-]+)*@[a-z0-9-]+(\.[a-z]{2,4})$";

if(empty($f_name)||empty($l_name)||empty($email)||empty($password)||empty($repassword)||empty($mobile)||empty($address1)||empty($address2)){
	 echo "
	 <div class='alert alert-warning'>
	    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Lütfen Tüm Alanları Doldurunuz</b>
	 ";
}
else{

if(!preg_match($name,$f_name)){
	echo "
	 <div class='alert alert-warning'>
	    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<b>$f_name bulunamadı</b>
	 ";
	exit();
}
if(!preg_match($name,$l_name)){
echo "
	 <div class='alert alert-warning'>
	    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<b>$l_name bulunamadı</b>
	 ";
	exit();
}
 /*  if(!preg_match($emailValidation,$email)){
	echo"$email bulunamadı";
	exit();
}*/
if(strlen($password)<4){
	echo "
	 <div class='alert alert-warning'>
	    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<b>Şifre Çok kolay</b>
	 ";
	exit();
}
if($password!=$repassword){
	echo "
	 <div class='alert alert-warning'>
	    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<b>Şifreler farklı</b>
	 ";
	exit();
}
if(!preg_match($number,$mobile)){
	echo "
	 <div class='alert alert-warning'>
	    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<b>$mobile bulunamadı</b>
	 ";
	exit();
}
if(!(strlen($mobile)==10)){
echo "
	 <div class='alert alert-warning'>
	    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<b>Telefon numarası 10 rakamdan oluşmalı</b>
	 ";
	
	exit();
}
 $sql="SELECT user_id FROM user_info WHERE email='$email' LIMIT 1";
 $check_query=mysqli_query($con,$sql);
 if(mysqli_num_rows($check_query)>0){
	 echo "
	 <div class='alert alert-warning'>
	    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<b>Eposta adresi zaten mevcut Lütfen başka bir adres deneyin</b>
	 ";
	
	 exit();
 }
 else{
	 
	 $sql="INSERT INTO `user_info` (`user_id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `address1`, `address2`)
	 VALUES (NULL, '$f_name', '$l_name', '$email', '$password', '$mobile', '$address1', '$address2')";
	 $run_query=mysqli_query($con,$sql);
	 if($run_query){
		  echo "
	 <div class='alert alert-success'>
	    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<b>Üye Kaydı Başarılı</b>
	 ";
		 
	 }
 }
 
}


?>