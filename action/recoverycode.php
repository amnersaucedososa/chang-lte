<?php
session_start();
include "config.php";
if(!empty($_POST)){
	if($_POST["email"]!=""&&$_POST["code"]!=""){
		$email = $_POST["email"];
		$sql=mysqli_query($con,"select * from user where email=\"$email\"");
		if ($row=mysqli_fetch_array($sql)) {
			$id=$row['id'];
			$is_active=$row['is_active'];
		}
		
		if($is_active){
			$recover = mysqli_query($con, "select * from recover where is_used=0 and user_id=$id");
			if(mysqli_num_rows($recover)!=0){
				while ($rows=mysqli_fetch_array($recover)) {
					$code=$rows['code'];
				}
				if($code==$_POST["code"]){
					$sql = mysqli_query($con,"update recover set is_used=1 where user_id=$id");
					$_SESSION["user_id"] = $id;
					if ($sql) {
						echo "actualizo";
					}
					print "<script>alert(\"Se iniciara sesion en su cuenta, aproveche para cambiar su contrase&ntilde;a\")</script>";
					print "<script>window.location=\"../home.php\"</script>";		
				}
				else{					
					print "<script>alert(\"Codigo de recuperacion invalido\")</script>";
					print "<script>window.location=\"../recovery.php\"</script>";		
				}

			}else{					
				print "<script>alert(\"No cuenta con codigo de recuperacion, debe solicitar uno.\")</script>";
				print "<script>window.location=\"../recovery.php\"</script>";		
			}
		}else{
			print "<script>alert(\"Este usuario no esta activo\")</script>";
			print "<script>window.location=\"../activate.php\"</script>";		
		}
	}

	else{

		print "<script>alert(\"Datos vacios\")</script>";
		print "<script>window.location=\"../recovery.php\"</script>";		
	}
}
else if($_GET["e"]!=""&&$_GET["c"]!=""){

	$users = mysqli_query($con, "select * from user where is_active=1");
	$user = null;
	foreach ($users as $u) {
		$user_id=$u['id'];
		if(sha1(md5($u['email']))==$_GET["e"] ){
			$user=$u;
			break;
		}
	}
	$recover = mysqli_query($con, "select * from recover where is_used=0 and user_id=$user_id");
	if(mysqli_num_rows($recover)!=0){
		while ($rows=mysqli_fetch_array($recover)) {
			$code=$rows['code'];
		}
		if(sha1(md5($code))==$_GET["c"] ){

			$update = mysqli_query($con,"update recover set is_used=1 where user_id=$user_id");

			$_SESSION["user_id"]=$user_id;
			print "<script>alert(\"Se iniciara sesion en su cuenta, aproveche para cambiar su contraseña\")</script>";
			print "<script>window.location=\"../home.php\"</script>";

		}else{
			print "<script>alert(\"Codigo invalido\")</script>";
			print "<script>window.location=\"../recovery.php\"</script>";		
		}
	}else{
		print "<script>alert(\"No existe el codigo\")</script>";
		print "<script>window.location=\"../recovery.php\"</script>";	
	}


}else{					
	//print "<script>window.location=\"../\"</script>";
	echo "error";	
}

