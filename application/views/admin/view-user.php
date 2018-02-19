 <?php
 $id_user=$this->session->userdata('id_user');
 $level = $this->session->userdata('level');

 if(!$id_user){

 	redirect('User/login_view');
 }
 else if($level == "users"){
 	redirect('/user');
 }
 else if($level == "guest"){
 	redirect('/');
 }

 ?>

 <div class="container">
 	<h3 class="text-center">Edit User</h3>
 	<h5>Admin>Dashboard>Edit</h5>
 	<?php
 	$success_msg= $this->session->flashdata('success_msg');
 	$error_msg= $this->session->flashdata('error_msg');

 	if($success_msg){
 		?>
 		<div class="alert alert-success">
 			<?php echo $success_msg; ?>
 		</div>
 		<?php
 	}
 	if($error_msg){
 		?>
 		<div class="alert alert-danger">
 			<?php echo $error_msg; ?>
 		</div>
 		<?php
 	}
 	?>
 	<?php echo form_open("admin/edit_user/".$user->id_user); ?>
 	<div class="form-group">
 		<label for="judul">Username:</label>
 		<input type="text" class="form-control" name="username" placeholder="Masukan Judul" value="<?php echo $user->username ?>">
 	</div>
 	<div class="form-group">
 		<label for="kategori">Level:</label>
 		<select name="level" class="form-control">
 			<option value="<?php echo $user->level ?>"><?php echo $user->level ?></option>
 			<option value="admins">admin</option>
 			<option value="users">user</option>
 		</select>
 	</div>
 	<div class="form-group">
 		<label for="kategori">Laboratorium:</label>
 		<select name="laboratorium" class="form-control">
 			<option value="<?php echo $user->laboratorium ?>"><?php echo $user->laboratorium ?></option>
 			<option value="IIS">IIS</option>
 			<option value="CNP">CNP</option>
 			<option value="BCN">BCN</option>
 			<option value="SOB">SOB</option>
 			<option value="FMC">FMC</option>
 			<option value="BAN">BAN</option>
 			<option value="IXC">IXC</option>
 		</select>
 	</div>
 	<input type="submit" name="submit" class="btn btn-primary">
 	<?php echo form_close(); ?>
 </div>