 <?php
 $id_user=$this->session->userdata('id_user');
 $username=$this->session->userdata('username');
 $level = $this->session->userdata('level');
 $lab = $this->session->userdata('laboratorium');

 $date = date("Y-m-d h:i:s");

 if(!$id_user){

 	redirect('User/login_view');
 }
 else if($level == "admins"){
 	redirect('/admin');
 }
   else if($level == "guest"){
 	redirect('/');
 }

 ?>
 <div class="main">
 	<h1 class="text-center">Isi data dengan benar</h1>
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
 	<?php echo form_open("User/add", array('enctype'=>'multipart/form-data')); ?>
 	<div class="form-group">
 		<label for="judul">Judul:</label>
 		<input type="text" class="form-control" name="judul" placeholder="Masukan Judul" required autofocus="">
 	</div>
 	<div class="form-group">
 		<label for="kategori">kategori:</label>
 		<select name="kategori" class="form-control">
 			<option value="dokumen standar">dokumen standar</option>
 			<option value="dokumen riset">dokumen riset</option>
 			<option value="artikel">artikel</option>
 		</select>
 		<input type="hidden" name="laboratorium" value="<?php echo $lab; ?>">
 	</div>
 	<div class="form-group">
 		<label for="judul">Deskripsi:</label>
 		<textarea class="form-control" rows="5" name="deskripsi" placeholder="Masukan Deskripsi" required=""></textarea>
 	</div>
 	<div class="form-group">
 		<label for="judul">Gambar(JPG,PNG,JPEG):</label>
 		<input type="file" class="form-control" name="img_path" required>
 	</div>
 	<div class="form-group">
 		<label for="judul">Lampiran(PDF):</label>
 		<input type="file" class="form-control" name="file" required>
 	</div>
 	<input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
 	<input type="hidden" name="time" value="<?php echo $date; ?>">
 	<input type="hidden" name="username" value="<?php echo $username; ?>">
 	<span>*Gambar dan lampiran wajib diisi dan max file 2Mb</span><br>
 	<input type="submit" name="submit" class="btn btn-primary">
 	<?php echo form_close(); ?>
 </div>