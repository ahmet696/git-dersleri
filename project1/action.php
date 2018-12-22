<?php
include 'db.php';
SESSION_START();
class MyClass{
	public $run_query;
	
	
}
if(isset($_POST['category'])){
	$run_query=mysqli_query($con,"SELECT * FROM categories");
	echo "
	<div class='nav nav-pills nav-stacked'>
	   <li class='active'><a href='#'<h4>Kategoriler</h4></a></li>
	
	";
	if(mysqli_num_rows($run_query)>0){
		while($row=mysqli_fetch_array($run_query)){
		$cid=$row["cat_id"];
		$cat_name=$row["cat_title"];
		echo "
		<li><a href='#' class='category' cid='$cid'>$cat_name</a></li>
		";
		}
		echo "</div>";
	}
}


if(isset($_POST['getProduct'])){
	
	$run_query=mysqli_query($con,"SELECT * FROM products ORDER BY RAND() LIMIT 0,9");

	    if(mysqli_num_rows($run_query)>0){
		while($row=mysqli_fetch_array($run_query)){
		
		$pro_id=$row['product_id'];
		$pro_cat=$row['product_cat'];
		$pro_brand=$row['product_brand'];
		$pro_title=$row['product_title'];
		$pro_price=$row['product_price'];
		$pro_image=$row['product_image'];
		
		echo "
		<div class='col-md-4'>
			      <div class='panel panel-info'>
				     <div class='panel-heading'>$pro_title</div>
					  <div class='panel-body'>
					   <img src='images/$pro_image' style='width:160px;height:250px;'/>
					  </div>
					  
				     </div>
			  </div>  
		
		";
		}
	}
}
 if(isset($_POST["get_selected_Category"])||isset($_POST["selectBrand"])||isset($_POST["search"])){
	 if(isset($_POST["get_selected_Category"])){
	 $id=$_POST["cat_id"];
	 $sql="SELECT * FROM products WHERE product_cat='$id'";
	 
	 }
	 else if(isset($_POST["selectBrand"])){
		  $id=$_POST["brand_id"];
	      $sql="SELECT * FROM products WHERE product_brand='$id'";
	 }else{
		  $keyword=$_POST["keyword"];
	      $sql="SELECT * FROM products WHERE product_keyword LIKE '%$keyword%'";
		 
	 }
		 
	 
	$run_query=mysqli_query($con,$sql);
	 while($row=mysqli_fetch_array($run_query)){
		 $pro_id=$row['product_id'];
		$pro_cat=$row['product_cat'];
		$pro_brand=$row['product_brand'];
		$pro_title=$row['product_title'];
		$pro_price=$row['product_price'];
		$pro_image=$row['product_image'];
		
		echo "
		<div class='col-md-4'>
			      <div class='panel panel-info'>
				     <div class='panel-heading'>$pro_title</div>
					  <div class='panel-body'>
					   <img src='images/$pro_image' style='width:160px;height:250px;'/>
					  </div>
					   
				     </div>
			  </div>  
		
		";
		 
	 }
   
 }
   if(isset($_POST["addToProduct"])){
	   
	
	 $p_id=$_POST['proId'];
	 $user_id=$_SESSION["uid"];
	 $sql="SELECT * FROM cart WHERE p_id='$p_id' AND user_id='$user_id'";
	 $run_query=mysqli_query($con,$sql);
	 $count=mysqli_num_rows($run_query);
	 if($count>0){
		
		 echo "
	             <div class='alert alert-success'>
	             <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		          <
	       ";
	 }
	 else{
		   $sql="SELECT * FROM  products WHERE product_id='$p_id'";
		   $run_query=mysqli_query($con,$sql);
		   $row=mysqli_fetch_array($run_query);
		     $id = $row["product_id"];
		     $pro_image=$row["product_image"];
			 $pro_name=$row["product_title"];
			 $pro_price=$row["product_price"];
			 $sql="INSERT INTO `cart` (`id`, `p_id`, `ip_add`, `user_id`, `product_title`, `product_image`, `qty`, `price`, `total_amount`)
			 VALUES (NULL, '$p_id', '0', '$user_id', '$pro_name', '$pro_image', '1', '$pro_price', '$pro_price')";
			 if(mysqli_query($con,$sql)){
				 echo "
	             <div class='alert alert-success'>
	            
	       ";
			 }	 
	 } 
 }
  if(isset($_POST["get_cart_product"])||isset($_POST["cart_checkout"])){
 
  $uid=$_SESSION['uid'];
  $sql="SELECT * FROM 	cart WHERE user_id='$uid'";
  $run_query=mysqli_query($con,$sql);
  $count=mysqli_num_rows($run_query);
  if($count > 0){
	  $no=1;
	  $total_amt=1;
	  while($row=mysqli_fetch_array($run_query)){
		  $id=$row["user_id"];
		  $pro_id=$row["p_id"];
		  $pro_name=$row["product_title"];
		  $pro_image=$row["product_image"];
		  $qty=$row["qty"];
		  $total=$row["total_amount"];
		  $pro_price=$row["price"];
		  $price_array=array($total);
		  $total_sum=array_sum($price_array);
		  $total_amt=$total_amt+$total_sum;
		  if(isset($_POST["get_cart_product"])){
			  echo "
		  <div class='row'>
				       <div class='col-md-3'>$no</div>
				       <div class='col-md-3'><img src='images/$pro_image' style='width:60px;height:50px;'/></div>
					   <div class='col-md-3'>$pro_name</div>
					   <div class='col-md-3'>$pro_price.'TL'</div>
				       </div>
		  ";
		  $no=$no+1;
		  }else{
			  echo "
			  <div class='row'>
		  <div class='col-md-2' >
		    <div class='btn-group'>
		     <a href='#' remove_id='$pro_id' class='btn btn-danger remove'><span class='glyphicon glyphicon-trash'></span></a>
		     <a href='#'  update_id='$pro_id' class='btn btn-primary update'><span class='glyphicon glyphicon-ok-sign'></span></a>
		  </div>
		  </div>
		 
		  <div class='col-md-2' ><img src='images/$pro_image'style='width:100px;height:100px;'></div>
		   <div class='col-md-2'>$pro_name</div>
          <div class='col-md-2' ><input type='text' class='form-control qty'    pid='$pro_id '  id='qty-$pro_id' value='$qty' ></div>		   
		   <div class='col-md-2' ><input type='text' class='form-control price'  pid='$pro_id'  id='price-$pro_id' value='$pro_price' disabled></div>
		
		   <div class='col-md-2' ><input type='text' class='form-control total'  pid='$pro_id'  id='total-$pro_id'  value='$total' disabled></div>
		  
		  </div>
			  ";
		  }
		  
	  }
	   if(isset($_POST["cart_checkout"])){
		   echo "
		   <div class='row'>
		   <div class='col-md-8'></div>
		   <div class='col-md-4'>
		   <b> Total $total_amt</b>
		   </div>
		   ";
	   }
     }
  }
 
 if(isset($_POST["removeFromCart"])){
	 $pid=$_POST["removeId"];
	 $uid=$_SESSION["uid"];
	 $sql="DELETE FROM cart WHERE user_id='$uid' AND p_id='$pid'";
	 $run_query=mysqli_query($con,$sql);
	 if($run_query){
		  echo "
	             <div class='alert alert-danger'>
	             <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		          <b>Ürün sepetten silndi.</b>
	       ";
	 }
 }
  if(isset($_POST["updateProduct"])){
	     $uid=$_SESSION['uid'];
		 $pid=$_POST["updateId"];
	     $qty=$_POST["qty"];
		 $total=$_POST["total"];
		 $price=$_POST["price"];
	    $sql="UPDATE cart SET qty='$qty',price='$price' ,total_amount='$total' WHERE user_id='$uid' AND p_id='$pid'";
		$run_query=mysqli_query($con,$sql);
		if($run_query){
			echo "
	             <div class='alert alert-success'>
	             <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		          <b>Ürün güncellendi .</b>
	       ";
			
		}
  }
 
 
?>