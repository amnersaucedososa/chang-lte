<?php
session_start();
include "config.php";
if(!empty($_POST)){
	if($_POST["password"]!=""&&$_POST["confirm"]!=""){
		if($_POST["password"]==$_POST["confirm"]){
			$id=$_SESSION["user_id"];
			$user=mysqli_query($con, "select * from user where id=$id");
			if ($row=mysqli_fetch_array($user)) {
				$password = sha1(md5($_POST["password"]));
			}
			
			$sql = mysqli_query($con,"update user set password=\"$password\" where id=$id");
			print "<script>alert(\"Contraseña actualizada!\")</script>";
			print "<script>window.location=\"../configuration.php\"</script>";
		}else{
			print "<script>alert(\"Las contraseñas no coinciden\")</script>";
			print "<script>window.location=\"../configuration.php\"</script>";
		}	
	}else{
		print "<script>alert(\"Datos vacios!\")</script>";
		print "<script>window.location=\"../configuration.php\"</script>";
	}
}