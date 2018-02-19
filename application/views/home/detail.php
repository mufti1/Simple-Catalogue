<?php 
$id_user=$this->session->userdata('id_user');
$username=$this->session->userdata('username');
$img=$this->session->userdata('img_path');
$id= substr($id_user, 1, 4);

if (!isset($id_user)) {
	$id_user = 0;
}
else{
	$id_user=$this->session->userdata('id_user');
}
?>
<img src="<?php echo base_url('uploads/').$content->img_path;?>" style="width: 100%; height: 500px;">

<div class="container">
	<?php  
	$url = base_url();
	?>

	<h1><?php echo $content->judul; ?></h1>
	<h6>Diposkan oleh : <?php echo $content->username; ?></h6>
	<h6>Pada : <?php echo $content->time; ?></h6>
	<h6>Laboratorium : <?php echo $content->laboratorium; ?></h6>
	<h6>Kategori : <?php echo $content->kategori; ?></h6>
	<p class="text-justify" style="margin-bottom: 20px;"><?php echo $content->deskripsi; ?></p>

	<?php 
	if ($id == 0) {
		echo " 
		<div class='form-group'>
		<label for='Komentar'>Komentar:</label>
		<input type='text' class='form-control' name='komentar' placeholder='Masukan Komentar' disabled>
		</div>

		";
	}
	else{
		echo "
		<a href='$url/uploads/$content->file' class='btn btn-primary' style='margin-bottom: 40px;'>Download Katalog</a>
		<form method='post' action='$url/Home/detail/$content->id_content'>
		<div class='form-group'>
		<label for='Komentar'>Komentar:</label>
		<textarea style='width: 103%;' class='form-control form-block' name='komentar' placeholder='Masukan Komentar'></textarea>
		</div>
		<input type='hidden' name='username' value='$username'>
		<input type='hidden' name='id_content' value='$content->id_content;'>
		<input type='hidden' name='img_path' value='$img'>
		<input type='submit' name='submit' class='btn btn-success'>
		</form>

		";
	}
	?>
	<?php 
	foreach ($comment as $data) {
		
		?>
		<div class="card-comment container">
			<h4 ><?php echo $data->username; ?></h4>
			<?php if ($data->img_path =="") { ?>
			<img src="<?php echo base_url('uploads/profiles/avatar.png'); ?>" width="50" height="50"><?php } else{ ?>
			<img src="<?php echo base_url('uploads/profiles/'.$data->img_path); ?>" width="50" height="50"><?php } ?>
			<hr class="text-center" style="border-color: #adb2b2;">
			<span ><?php echo htmlspecialchars($data->komentar, ENT_QUOTES); ?></span>
		</div>
		

		<?php } ?>
	</div>