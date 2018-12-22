
<?php

include 'db.php';
    session_start(); //seesion baslatıldı S
	
?>
<?php

      if(isset($_POST['submit'])){
      $email = $_POST['email']; 
      $password = $_POST['password'];
	  
	  $sql="SELECT * FROM user_info WHERE email='$email' AND password='$password'";

	  $run_query=mysqli_query($con,$sql);
	
	   $count=mysqli_num_rows($run_query);
	   if($count==1){
          
		    $row=mysqli_fetch_array($run_query);
		    $_SESSION['uid']=$row["user_id"]; //her sayfada session baslatılır.session baslatıldıgındA global olarak her syafadA KULLANILABİLİR 	
		   $_SESSION['name']=$row["first_name"]; //session[name ] her session _start yaptıgım yerde aldığım firstname degerine eşittir.
		  header('LOCATION:profile.php'); die(); //header yönlendirme yapar 

        }else {
			 
          echo "<div class='alert alert-danger'>Username and Password do not match.</div>"; //degilse alert yazıdrılmıs  
        }

      }
    ?>
   


