<?php 
include 'db.php';
session_start();
	if(!isset($_SESSION['uid'])){
		header('LOCATION:index.php'); 
	}

?>

<html>
<head>
<meta charset="UTF-8">

<title>Page Title</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <link href="css/bootstrap.min.css" rel="stylesheet">
   <script src="main.js"></script>
      <script src="js/jquery.js"></script>
	  <script type="text/javascript">
	    <script src="js/jquery2.js"></script>
	     <script src="main.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="content-fluid">
         <div class="navbar navbar-header">
		 <a href="#" class="navbar-brand">ERDENER</a>
		 </div>
		 <ul class="nav navbar-nav">
		 <li><a href="#"><span class="glyphicon glyphicon-home"></span>Anasayfa</a></li>
		 
		 <li><a href="#"><span class="glyphicon glyphicon-modal-window"></span>Ürünler</a></li>
		 <li style="width:300px;left:10px;top:10px;"><input type="text" class="form-control" id="search"></li>
		  <li style="top:10px;left:20px;"><button class="btn btn-primary" id="Ara_btn">Ara</button></li>
		 </ul>
		 <ul class="nav navbar-nav navbar-right">
		 <li><!--<a href="#"  id="cart_container" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart"></span>Sepet <span class="badge">0</span></a>-->
		     <div  class="dropdown-menu" style="width:400px;">
			 <div class="panel panel-success">
			     <div class="panel panel-heading">
				 <div class="row">
				      <div class="col-md-3">Sl.No</div>
				       <div class="col-md-3">Ürün Resmi</div>
					   <div class="col-md-3">Ürün Ad</div>
					   <div class="col-md-3">Fiyat TL</div>
				       </div>
				    </div>
				   <div class="panel-body">
				   <div id="cart_product">
				   
				   </div> 
				   </div>
				   <div class="panel-footer"></div>
				   </div>
			 </div>
		 </li>
		 <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><?php echo   $_SESSION['name']; ?></a>
		 <ul class="dropdown-menu">
		  

		 
		  <li class="divider"> </li>
		  <li><a href="logout.php" style="text-decoration:none; color:blue;">Çıkış</a></li>
		 
		         </ul>
		 
		     </li>
		
		
		     </ul>
		 </div>
		 </div>
		 </div>
		 </div>
		 
</div>
 <p><br/></p>
 <p><br/></p>
 <p><br/></p>
 <div class="content-fluid">
 <div class="row">
    <div class="col-md-1" ></div>
	<div class="col-md-2">
    <div id="get_category">
   </div>
	
	<!--<div id="get_brand">
	</div>-->
	
     </div>
	  <div class="col-md-8" >
	    <div class="row">
	  <div class="col-md-12" id="product_msg">
	   </div>
	  </div>
	   <div class="panel panel-info">
	      <div class="panel-heading">Ürünler</div>
		  <div class="panel-body">
		  <div id="get_product">
		  </div>
		      
	     </div>
	  <div class="panel-footer">&copy;2018</div>
	  </div>
	   <div class="col-md-1" >
	   </div>
 </div>
 </div>
</body>
</html>