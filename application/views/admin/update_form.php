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
 	<h3 class="text-center">Edit Katalog</h3>
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
 	<?php echo form_open("admin/edit_katalog/".$content->id_content, array('enctype'=>'multipart/form-data')); ?>
 	<div class="form-group">
 		<label for="judul">Judul:</label>
 		<input type="text" class="form-control" name="judul" placeholder="Masukan Judul" value="<?php echo $content->judul ?>">
 	</div>
 	<div class="form-group">
 		<label for="kategori">kategori:</label>
 		<select name="kategori" class="form-control">
 			<option value="<?php echo $content->kategori ?>"><?php echo $content->kategori ?></option>
 			<option value="dokumen standar">dokumen standar</option>
 			<option value="dokumen riset">dokumen riset</option>
 			<option value="artikel">artikel</option>
 		</select>
 	</div>
 	<div class="form-group">
 		<label for="judul">Deskripsi:</label>
 		<textarea class="form-control" rows="5" name="deskripsi" placeholder="Masukan Deskripsi"><?php echo $content->deskripsi ?></textarea>
 	</div>
 	<div class="form-group">
 		<label for="judul">Gambar(JPG,PNG,JPEG):</label>
 		<input type="file" class="form-control" name="img_path" value="<?php echo $content->img_path ?>" required>
 	</div>
 	<div class="form-group">
 		<label for="judul">Lampiran(PDF):</label>
 		<input type="file" class="form-control" name="file" value="<?php echo $content->file ?>" required>
 	</div>
 	<span>*Jika ingin mengubah gambar dan lampiran harap diupload ulang kedua file tersebut</span><br>
 	<input type="submit" name="submit" class="btn btn-primary">
 	<?php echo form_close(); ?>
 </div>