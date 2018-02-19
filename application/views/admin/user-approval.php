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

  $usr = $user->id_user;
  $newus = substr($usr,1,4);

  $tambah=$newus+1;
  if ($tambah<10) {
    $id="u000".$tambah;
  }
  else if($tambah>100){
    $id="u0".$tambah;
  }
  else{
    $id="u00".$tambah;
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
        foreach ($user_temp as $data) {
          ?>
          <tr>
            <td><?php echo $data->id_user; ?></td>
            <td><?php echo $data->username; ?></td>
            <td><?php echo $data->level; ?></td>
            <td><?php echo $data->laboratorium; ?></td>
            <form action="<?php echo base_url('admin/approve') ?>" method="post">
              <input type="hidden" name="id_user" value="<?php echo $id; ?>">
              <input type="hidden" name="usr" value="<?php echo $data->id_user; ?>">
              <input type="hidden" name="username" value="<?php echo $data->username; ?>">
              <input type="hidden" name="password" value="<?php echo $data->password; ?>">
              <input type="hidden" name="level" value="<?php echo $data->level; ?>">
              <input type="hidden" name="email" value="<?php echo $data->email; ?>">
              <input type="hidden" name="laboratorium" value="<?php echo $data->laboratorium; ?>">
              <td><button type="submit" class="btn btn-success">Terima</button></td>
            </form>
            <td><a href="<?php echo base_url('admin/delete_temp/').$data->id_user;?>" class="btn btn-danger">Batal</a></td>
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
