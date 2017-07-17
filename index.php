<?php  include "header.php"; 

	if (isset($_SESSION['user_id']) && $_SESSION['user_id']!=null) {
		header("location: home.php");
	}

?>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="jumbotron">
				<h2><i class="fa fa-dashboard"></i> Registro, Login, Recuperación &amp; Admin</h2>
				<p>Chang-LTE es un sistema que cuenta con la funcion basica de registro de usuarios, activacion, login, recuperacion y administracion.</p>
			</div>
		</div>
	</div>
  	<div class="row">
		<div class="col-md-12">
			<h2>MODO USUARIO</h2>
			<p>Las acciones que puede hacer el usuario son las siguientes:</p>
		</div>
  	</div>
  	<div class="row">
		<div class="col-md-3">
			<h4>REGISTRO</h4>
			<p>Los usuarios se pueden registrar en el sitio insertando su nombre, apellidos, correo electronico y contrase&ntilde;a.</p>
			<br><a href="register.php" class="btn btn-primary">Registrarse</a>
		</div>
		<div class="col-md-3">
			<h4>ACTIVACI&Oacute;N</h4>
			<p>Una vez que el usuario esta registrado debe activar su cuenta, usando el link generado o con el codigo de activacion.</p>
			<br><a href="activate.php" class="btn btn-primary">Activar</a>
		</div>
		<div class="col-md-3">
			<h4>LOGIN</h4>
			<p>Los usuarios pueden acceder usando email y contrase&ntilde;a, siempre y cuando hayan activado su cuenta.</p>
			<br><a href="login.php" class="btn btn-primary">Login</a>
		</div>
		<div class="col-md-3">
			<h4>RECOVER</h4>
			<p>En caso de que el usuario haya olvidado su contrase&ntilde;a puede usar los codigos de recuperacion.</p>
			<br><a href="recovery.php" class="btn btn-primary">Recover</a>
		</div>
  	</div>
  	<div class="row">
		<div class="col-md-12">
			<h2>MODO ADMINISTRADOR</h2>
			<p>Las acciones que puede hacer el administrador son las siguientes:</p>
		</div>
  	</div>
	<div class="row">
		<div class="col-md-3">
			<h4>ADMINISTRAR</h4>
			<p>Ver Editar, activar y eliminar usuarios y otros administradores.</p>
		</div>
		<div class="col-md-3">
			<h4>BLOQUEAR</h4>
			<p>Bloquear usuarios inabilita que puedan entrar, activar o recuperar contrase&ntilde;a.</p>
		</div>
		<div class="col-md-3">
			<h4>ALGO MAS?</h4>
			<p>Pedid y se os dara!.</p>
		</div>
	</div>
</div>
<br><br>
</body>
</html>