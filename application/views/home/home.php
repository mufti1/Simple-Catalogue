<div class="container" style="margin-top: 90px;">
	<div class="col-md-12">
		<div class="col-md-3">
			<form action="<?php echo base_url('home/kategori') ?>" method="get">
				<select name="kategori" class="form-control" onchange="this.form.submit();">
					<option value="">Katalog berdasar kategori</option>
					<option value="dokumen standar">dokumen standar</option>
					<option value="dokumen riset">dokumen riset</option>
					<option value="artikel">artikel</option>
				</select>
			</form>
		</div>
		<div class="col-md-3">
			<form action="<?php echo base_url('home/lab') ?>" method="get">
				<select name="laboratorium" class="form-control" onchange="this.form.submit();">
					<option value="">Katalog berdasar Lab</option>
					<option value="IIS">IIS</option>
					<option value="CNP">CNP</option>
					<option value="BCN">BCN</option>
					<option value="SOB">SOB</option>
					<option value="FMC">FMC</option>
					<option value="BAN">BAN</option>
					<option value="IXC">IXC</option>
				</select>
			</form>
		</div>
	</div>
	

	<?php

	foreach ($content as $data) {
		$desc = $data->deskripsi;
		$a = strlen($desc);
		$limit = 100;
		if ($a > 100) {
			$cetak = substr($desc, 0, $limit). "....";
		}
		else{
			$cetak = $desc;
		}
		?>


		<div class="col-md-5 panel-card" style="margin-right: 20px; width: 48.2%; padding-left: 0;">
			<div class="col-md-6" style="float: left; padding-left: 0;">
				<img src="<?php echo base_url('uploads/').$data->img_path;?>" style="width: 100%; height: 300px;">
			</div>
			<div class="col-md-6">
				<a class="card-title" href="<?php echo base_url('Home/detail/').$data->id_content; ?>"><h3><?php echo $data->judul; ?></h3></a>
				<h6 class="card-text">Dipostkan pada : <?php echo $data->time; ?></h6>
				<h6 class="card-text">Laboratorium : <?php echo $data->laboratorium; ?></h6>
				<h6 class="card-text">User Pengapload : <?php echo $data->username; ?></h6>
				<h6 class="card-text">Kategori : <?php echo $data->kategori; ?></h6>
				<p class="card-text"><?php echo $cetak; ?></p>
				<a href="<?php echo base_url('Home/detail/').$data->id_content; ?>" class="btn btn-success">Lihat Selengkapnya</a>
			</div>
		</div>


		<?php } ?>
		<div class="col-md-12">
			<div class="text-center">
				<?php
				echo $this->pagination->create_links();
				?>
			</div>

		</div>
	</div>