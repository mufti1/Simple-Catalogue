 <?php
 $id_user=$this->session->userdata('id_user');
 $level = $this->session->userdata('level');
 // untuk validasi yang bisa melihat daftar katalog hanya user itu
 $defurl = base_url('User/edit_user/'.$id_user);
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
$img=$user->img_path;
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
  <div class="container">
    <div class="row">
      <div class="col-md-11">
        <h1>User Profile</h1>
        <h5>*Jika ingin mengedit profil harap masukan kembali password dan foto profile</h5>
        <div class="form-group">
          <span for="judul"><input id="saklar" type="checkbox" onchange="Edit();">Edit Profile </span>
        </div>
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
        <?php echo form_open("User/edit_user/".$id_user, array('enctype'=>'multipart/form-data')); ?>
        <div class="form-group">
          <label for="judul">Username : </label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Masukan Judul" value="<?php echo $user->username ?>" disabled>
        </div>
        <div class="form-group">
          <label for="judul">Email : </label>
          <input type="text" class="form-control" id="email" name="email" placeholder="Masukan Judul" value="<?php echo $user->email ?>" disabled>
        </div>
        <div class="form-group">
          <label for="judul">Laboratorium : </label>
          <select id="lab" name="laboratorium" class="form-control" disabled>
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
        <div class="form-group">
          <label for="judul">Password : </label>
          <input id="pass" type="password" class="form-control" name="password" placeholder="Masukan Password lama atau baru" required disabled>
        </div>

        <div class="form-group">
          <label for="judul">Foto Profil : </label><br>
          <?php 
          if ($img=="") {
            ?>
            <img src="<?php echo base_url('uploads/profiles/avatar.png' ) ?>" width="100" height="100"><br><br><?php }else{?>
            
            <img src="<?php echo base_url('uploads/profiles/'.$img ) ?>" width="100" height="100"><br><br><?php } ?>
            <input id="foto" type="file" class="form-control" name="img_path" placeholder="Masukan Judul" value="<?php echo $user->img_path ?>" required disabled>
          </div>
          <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary" value="perbarui" disabled id="btn">
          </div>
          <?php echo form_close(); ?>


        </div>
      </div>
    </div>
  </div>

  <script>
    function Edit() {
      if(document.getElementById("pass").disabled==false){
        document.getElementById("username").disabled=true;
        document.getElementById("email").disabled=true;
        document.getElementById("lab").disabled=true;
        document.getElementById("pass").disabled=true;
        document.getElementById("foto").disabled=true;
        document.getElementById("btn").disabled=true;
      }
      else{
       document.getElementById("username").disabled=false;
       document.getElementById("email").disabled=false
       document.getElementById("lab").disabled=false;
       document.getElementById("pass").disabled=false;
       document.getElementById("foto").disabled=false;
       document.getElementById("btn").disabled=false;
     }

   }
 </script>