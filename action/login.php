<?php
	include "config.php";
	if(!empty($_POST)){
		session_start();
		if($_POST["email"]!=""&&$_POST["password"]!=""){

			$email=$_POST['email'];
			$password = sha1(md5($_POST["password"]));
			$user = mysqli_query($con,"select * from user where email=\"$email\" and password=\"$password\"");
			if ($row=mysqli_fetch_array($user)) {
				$id=$row['id'];
				$is_active=$row['is_active'];
				$name=$row['name'];
				$is_admin=$row['is_admin'];
			}
			
			if(mysqli_num_rows($user)!=0){
				if($is_active){
					$_SESSION['user_id']=$id;

					header("location: ../home.php");
				}else{						
					print "<script>alert(\"El usuario debe estar activo\")</script>";
					print "<script>window.location=\"../activate.php\"</script>";
				}
			}else{
				print "<script>alert(\"Datos incorrectos\")</script>";
				print "<script>window.location=\"../login.php\"</script>";
			}
		}else{
			print "<script>alert(\"Datos vacios\")</script>";
			print "<script>window.location=\"../login.php\"</script>";
		}
	}