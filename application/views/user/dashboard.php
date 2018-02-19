 <?php
 $id_user=$this->session->userdata('id_user');
 $level = $this->session->userdata('level');
 
 // untuk validasi yang bisa melihat daftar katalog hanya user itu
 $defurl = base_url('User/dashboard/'.$id_user);
 $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

 $desc = $url;
 $a = strlen($url);
 $limit = 47;//limit panjang kata bila nanti dienabler sesuaikan dengan panjang url tersebut
 if ($a > 47) {
 	$cetak = substr($desc, 0, $limit);
 }
 else{
 	$cetak = $desc;
 }
 // echo $cetak;
 // echo "<br/>";
 // echo $defurl;
 // untuk validasi yang bisa melihat daftar katalog hanya user itu
 if(!$id_user){

 	redirect('User/login_view');
 }
 else if($level == "admins"){
 	redirect('/admin');
 }
 else if($level == "guest"){
 	redirect('/');
 }
 //cek apakah id user sesuai
 else if($cetak != $defurl){
 	redirect($defurl);
 }


 ?>
 <div class="main">
 	<h1 class="text-center">Daftar Katalog yang anda buat</h1>
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
 	<table class="table table-hover">
 		<thead>
 			<tr>
 				<th>ID Content</th>
 				<th>Judul</th>
 				<th>Kategori</th>
 				<th>Tanggal Upload</th>
 				<th>Gambar</th>
 				<th colspan="3">Aksi</th>
 			</tr>
 		</thead>
 		<tbody>
 			<?php 
 			foreach ($content as $data) {
 				?>
 				<tr>
 					<td><?php echo $data->id_content; ?></td>
 					<td><?php echo $data->judul; ?></td>
 					<td><?php echo $data->kategori; ?></td>
 					<td><?php echo $data->time; ?></td>
 					<td><img src="<?php echo base_url('uploads/').$data->img_path;?>" width="100" height = "100"/></td>
 					<td><a href="<?php echo base_url('User/hapus/').$data->id_content;?>">hapus</a></td>
 					<td><a href="<?php echo base_url('User/edit/').$data->id_content;?>">edit</a></td>
 					<td><a href="<?php echo base_url('Home/detail/').$data->id_content;?>">Lihat</a></td>
 				</tr>
 				<?php } ?>
 			</tbody>
 		</table>
 		<div class="text-center">
 			<?php
 			echo $this->pagination->create_links();
 			?>
 		</div>
 		
 	</div>
