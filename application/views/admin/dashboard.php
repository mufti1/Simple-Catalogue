 <?php
 $id_user=$this->session->userdata('id_user');
 $level = $this->session->userdata('level');

 if(!$id_user){

  redirect('user/login_view');
}
else if($level == "users"){
  redirect('/user/user_profile');
}
else if($level == "guest"){
  redirect('/');
}

?>
<div class="main">
  <div class="container">
    <div class="row">
      <div class="col-md-4">

        <table class="table table-bordered table-striped">


          <tr>
            <th colspan="2"><h4 class="text-center">User Info</h3></th>

            </tr>
            <tr>
              <td>User Name</td>
              <td><?php echo $this->session->userdata('username'); ?></td>
            </tr>
            <tr>
              <td>User Email</td>
              <td><?php echo $this->session->userdata('level');  ?></td>
            </tr>
            <tr>
              <td>User Id</td>
              <td><?php echo $this->session->userdata('id_user');  ?></td>
            </tr>
          </table>


        </div>
        <a href="<?php echo base_url('User/user_logout');?>" >  <button type="button" class="btn-primary">Logout</button></a>
      </div>
    </div>