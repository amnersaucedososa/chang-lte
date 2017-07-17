<?php
include "config.php";
	if(!empty($_POST)){
		if($_POST["email"]!=""){
			$email = $_POST["email"];
			$sql=mysqli_query($con,"select * from user where email=\"$email\"");
			if(mysqli_num_rows($sql)!=0){
				while ($rows=mysqli_fetch_array($sql)) {
					$id=$rows['id'];
					$is_active=$rows['is_active'];
				}
				if($is_active){
					$mycode = mysqli_query($con,"select * from recover where is_used=0 and user_id=$id");
					
					$code= "";
					if(mysqli_num_rows($mycode)==0){
							$str = "abcdefghijklmopqrstuvwxyz1234567890";
							$code = "";
							for ($i=0; $i < 6; $i++) { 
								$code .= $str[rand(0,strlen($str)-1)];
							}
							
							$user_id = $id;
							$code = $code;
							$created_at = "NOW()";
							$add = mysqli_query($con,"INSERT into recover (user_id,code,created_at) value (\"$user_id\",\"$code\",$created_at)");

							if($add){
								//echo "datos insertados";
							}else{
								//echo "error al insertar";
							}

						}else{
							foreach ($mycode as $codes)
							$code = $codes['code'];
							//echo "error";
						}


					$msg = "<body><h1>Codigo de recuperacion</h1>
					<p>Ahora puedes recuperar tu cuenta en el siguiente link:</p>
					<p><a href='http://youhost.com/action/recoverycode.php?e=".sha1(md5($_POST["email"]))."&c=".sha1(md5($code))."'>Activa tu cuenta:</a></p>
					<p>O tambien puedes usar el siguiente codigo de activacion: ".$code."</p>
					</body>";
	
					mail($_POST["email"], "Codigo de recuperacion", $msg);
		
					$f = fopen ("../recover.txt","w");
					fwrite($f, $msg);
					fclose($f);


					print "<script>alert(\"Se ha enviado un mensaje a tu correo electronico con los datos necesarios para recuperar su cuenta.\")</script>";
					print "<script>window.location=\"../recovery.php\"</script>";

				}else{
					print "<script>alert(\"El usuario debe estar activo\")</script>";
					print "<script>window.location=\"../activate.php\"</script>";
				}


			}else{
				print "<script>alert(\"Usuario no existe\")</script>";
				print "<script>window.location=\"../recovery.php\"</script>";
			}
			
		}else{
			print "<script>alert(\"Datos vacios\")</script>";
			print "<script>window.location=\"../recovery.php\"</script>";
		}
	}