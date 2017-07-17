<?php
	include "config.php";
	if(!empty($_POST)){
		if($_POST["name"]!=""&&$_POST["lastname"]!=""&&$_POST["email"]!=""&&$_POST["password"]!=""){

			$email = $_POST["email"];
			$sql=mysqli_query($con,"select * from user where email=\"$email\"");
			if(mysqli_num_rows($sql)==0){
				$str = "abcdefghijklmopqrstuvwxyz1234567890";
				$code = "";
				for ($i=0; $i < 6; $i++) { 
					$code .= $str[rand(0,strlen($str)-1)];
				}
				
				$name = $_POST["name"];
				$lastname = $_POST["lastname"];
				$email = $_POST["email"];
				$password = sha1(md5($_POST["password"]));
				$code = $code;
				$created_at = "NOW()";

				$query = mysqli_query($con, "INSERT into user (name,lastname,email,code,password,created_at) value (\"$name\",\"$lastname\",\"$email\",\"$code\",\"$password\",$created_at)");

				$msg = "<body><h1>Registro Exitoso</h1>
				<p>Ahora debes activar tu cuenta en el siguiente link:</p>
				<p><a href='http://youhost.com/action/activation.php?e=".sha1(md5($_POST["email"]))."&c=".sha1(md5($code))."'>Activa tu cuenta:</a></p>
				<p>O tambien puedes usar el siguiente codigo de activacion: ".$code."</p>
				</body>";

				mail($_POST["email"], "Registro Exitoso", $msg);

				$f = fopen ("../register.txt","w");
				fwrite($f, $msg);
				fclose($f);
				print "<script>alert(\"Registro Exitoso!, se ha enviado un correo electronico con los datos necesarios para activar su cuenta.\")</script>";


				print "<script>window.location=\"../login.php\"</script>";
			}else{

				print "<script>alert(\"El email proporcionado ya esta registrado.\")</script>";
				print "<script>window.location=\"../register.php\"</script>";
			}
		}else{
			print "<script>alert(\"No puede dejar campos vacios.\")</script>";
			print "<script>window.location=\"../register.php\"</script>";
		}
	}