<?php

session_start();
include "config.php";
$id=$_SESSION["user_id"];
$user = mysqli_query($con, "select * from user where id=$id");
if ($row=mysqli_fetch_array($user)) {
	$is_admin=$row['is_admin'];
}
if($is_admin){
	$del_id=$_GET["id"];

	$RecoverData=mysqli_query($con, "delete from recover where user_id=$del_id");

	$UserData=mysqli_query($con, "delete from user where id=$del_id");

	print "<script>alert(\"Usuario eliminado!\")</script>";
	print "<script>window.location=\"../home.php\"</script>";
}
print "<script>window.location=\"../\"</script>";