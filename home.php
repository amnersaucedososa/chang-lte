<?php 
	include "header.php";
	if (!isset($_SESSION['user_id']) && $_SESSION['user_id']==null) {
		header("location: login.php");
	}
	
	$id=$_SESSION['user_id'];
	$sql = mysqli_query($con,"select * from user where id=$id");
	if ($row=mysqli_fetch_array($sql)) {
		$name=$row['name'];
		$is_admin=$row['is_admin'];
	}
	if($is_admin==1):	
		$users = mysqli_query($con, "select * from user");
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<a class="btn btn-info pull-right" href="configuration.php">Cambiar contrase&ntilde;a</a>
			<h1>Administrador</h1>
			<?php if(count($users)>0):?>
			<table class="table table-bordered">
				<thead>
					<th>Nombre</th>
					<th>Apeliido</th>
					<th>Email</th>
					<th>Creacion</th>
					<th>Activo</th>
					<th>Administrador</th>
					<th></th>
				</thead>
				<?php foreach($users as $user):?>
				<tr>
					<td><?php echo $user['name']; ?></td>
					<td><?php echo $user['lastname']; ?></td>
					<td><?php echo $user['email']; ?></td>
					<td><?php echo $user['created_at']; ?></td>
					<td><?php if($user['is_active']){ echo "<i class='fa fa-check'></i>";}?></td>
					<td><?php if($user['is_admin']){ echo "<i class='fa fa-check'></i>";}?></td>
					<td><?php if(!$user['is_admin']):?><a href="action/deluser.php?id=<?php echo $user['id']?>" class="btn btn-xs btn-danger"><i class="fa fa-thumbs-up fa-rotate-180"></i></a><?php endif;?></td>
				</tr>
				<?php endforeach;?>
			</table>
			<?php else:?>
			<div class="jumbotron">
				<h1>No hay datos</h1>
			</div>
			<?php endif;?>
		</div>
	</div>
</div>

<?php else:?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="jumbotron">
				<h1>Hola, <?php echo $name;?></h1>
				<a href="configuration.php" class="btn btn-warning">Configurar</a>
				<a href="action/logout.php" class="btn btn-danger">Salir</a>
			</div>
		</div>
	</div>
</div>
<?php endif;?>