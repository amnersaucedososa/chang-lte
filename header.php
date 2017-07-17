<?php 
	session_start(); 
	include "action/config.php";
?>
<head>
	<meta charset="UTF-8">
	<title>Chang LTE</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
</head>
<header class="navbar navbar-inverse navbar-static-top" role="banner">
  	<div class="container">
		<div class="navbar-header">
		  	<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		  	<a class="navbar-brand" href="./">Chang LTE</a>
		</div>
		<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
		  	<ul class="nav navbar-nav">
		        <?php if(isset($_SESSION['user_id'])):
		          	$id=$_SESSION['user_id'];
		          	$user=mysqli_query($con,"select * from user where id=$id");
		          	if ($row=mysqli_fetch_array($user)) {
		          		$name=$row['name'];
		          	}
		          	
		        ?>
		          <li><a href="./"><i class="glyphicon glyphicon-user"></i> <?php echo $name; ?></a></li>
		          <li><a href="action/logout.php"><i class="glyphicon glyphicon-off"></i> Salir</a></li>
		        <?php else:?>
				<li><a href="./">Inicio</a></li>
			  	<li><a href="register.php">Registro</a></li>
			   	<li><a href="activate.php">Activar</a></li>
			  	<li><a href="login.php">Login</a></li>
			  	<li><a href="recovery.php">Recuperar</a></li>
			  	  <?php endif;?>
		  	</ul>
		</nav>
  	</div>
</header>
<div class="clearfix"></div>