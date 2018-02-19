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
    <h1 class="text-center">Daftar User</h1>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Id User</th>
          <th>Username</th>
          <th>Level</th>
          <th>Laboratorium</th>
          <th colspan="2">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($user as $data) {
          ?>
          <tr>
            <td><?php echo $data->id_user; ?></td>
            <td><?php echo $data->username; ?></td>
            <td><?php echo $data->level; ?></td>
            <td><?php echo $data->laboratorium; ?></td>
            <td><a href="<?php echo base_url('admin/delete_user/').$data->id_user; ?>">hapus</a></td>
            <td><a href="<?php echo base_url('admin/edit_user/').$data->id_user;?>">edit</a></td>
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
