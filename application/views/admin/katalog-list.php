    <?php
    $id_user=$this->session->userdata('id_user');
    $level = $this->session->userdata('level');

    if(!$id_user){

    	redirect('User/login_view');
    }
    else if($level == "users"){
    	redirect('/User/user_profile');
    }
    else if($level == "guest"){
        redirect('/');
    }

    ?>
    <div class="main">
    	<h1 class="text-center">Daftar Katalog yang anda buat</h1>
    	<table class="table table-hover">
    		<thead>
    			<tr>
    				<th>ID Content</th>
    				<th>Judul</th>
    				<th>Kategori</th>
    				<th>Tanggal Upload</th>
    				<th>Gambar</th>
    				<th colspan="3s">Aksi</th>
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
    					<td><a href="<?php echo base_url('admin/delete_katalog/').$data->id_content;?>">hapus</a></td>
    					<td><a href="<?php echo base_url('admin/edit_katalog/').$data->id_content;?>">edit</a></td>
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
