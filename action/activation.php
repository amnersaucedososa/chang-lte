<?php
	session_start();
	include "config.php";
	if(!empty($_POST)){
		if($_POST["email"]!=""&&$_POST["code"]!=""){
			$email = $_POST["email"];
			$sql=mysqli_query($con,"select * from user where email=\"$email\"");
			if ($row=mysqli_fetch_array($sql)) {
				$id=$row['id'];
				$active=$row['is_active'];
				$code=$row['code'];
			}else{
				print "<script>alert(\"Este usuario no existe\")</script>";
			}
			
			if(!$active){
				if($code==$_POST["code"]){
					$sql = mysqli_query($con,"update user set is_active=1 where id=$id");	

					$_SESSION["user_id"]=$id;

					print "<script>alert(\"Cuenta activada exitosamente, se iniciara su sesion, despues podra iniciar sesion con sus datos\")</script>";
					print "<script>window.location=\"../home.php\"</script>";
				}
			}else{
				print "<script>alert(\"Este usuario esta activo\")</script>";
				print "<script>window.location=\"../login.php\"</script>";
			}
		}

		else{
			print "<script>alert(\"Datos vacios\")</script>";
			print "<script>window.location=\"../activate.php\"</script>";
		}
	}
	//activacion via email
	else if($_GET["e"]!=""&&$_GET["c"]!=""){
			$users = mysqli_query($con, "select * from user where is_active=0");
			$user = null;
			foreach ($users as $u) {
				$user_id=$u['id'];
				$user_code=$u['code'];
				if(sha1(md5($u['email']))==$_GET["e"] ){
					$user=$u;
					break;
				}
			}
			//var_dump($users);
			if(mysqli_num_rows($users)!=0){
				if(sha1(md5($user_code))==$_GET["c"] ){
					$sql = mysqli_query($con,"update user set is_active=1 where id=$user_id");	
					$_SESSION["user_id"]=$user_id;
					print "<script>alert(\"Cuenta activada exitosamente, se iniciara su sesion, despues podra iniciar sesion con sus datos\")</script>";
				    print "<script>window.location=\"../home.php\"</script>";

				}else{
					print "<script>alert(\"No se pudo activar su cuenta\")</script>";
					print "<script>window.location=\"../activate.php\"</script>";					
				}

			}else{					
				print "<script>window.location=\"../activate.php\"</script>";
			}

		}