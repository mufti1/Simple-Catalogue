 <?php

 $level = $this->session->userdata('level');
 if($level == "users"){
 	redirect('/user/user_profile');
 }
 else if($level == "admins"){
 	redirect('/admin');
 }
 else if($level == "guest"){
 	redirect('/');
 }


 ?>
 <div class="container">
 	<div class="row">
 		<div class="col-md-4 col-md-offset-4">
 			<div class="login-panel panel panel-success">
 				<div class="panel-heading">
 					<h3 class="panel-title">
 						Registration
 						<?php 
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
 					</h3>
 				</div>
 				<div class="panel-body">
 					
 					<?php
 					$error_msg=$this->session->flashdata('error_msg');
 					if($error_msg){
 						echo $error_msg;
 					}
 					?>
 					<form action="<?php echo base_url('User/register');?>" method="post" role="form">
 						<fieldset>
 							<input type="hidden" name="id_user" value="<?php echo $id; ?>">
 							<div class="form-group">
 								<label>Username :</label>
 								<input type="text" name="username" placeholder="Masukan Username" class="form-control" autofocus required>
 							</div>
 							<div class="form-group">
 								<label>Password :</label>
 								<input type="password" name="password" placeholder="Masukan Password" class="form-control" required>
 							</div>
 							<div class="form-group">
 								<label>Peran :</label>
 								<select name="level" class="form-control" required>
 									<option value="users">Pengupload</option>
 									<option value="guest">Pendownload</option>
 								</select>
 							</div>
 							<div class="form-group">
 								<label>Email :</label>
 								<input type="email" name="email" placeholder="Masukan Email" class="form-control" required>
 							</div>
 							<div class="form-group">
 								<label>Laboratorium :</label>
 								<select name="laboratorium" class="form-control" required>
 									<option value="IIS">Laboratorium</option>
 									<option value="IIS">IIS</option>
 									<option value="CNP">CNP</option>
 									<option value="BCN">BCN</option>
 									<option value="SOB">SOB</option>
 									<option value="FMC">FMC</option>
 									<option value="BAN">BAN</option>
 									<option value="IXC">IXC</option>
 								</select>
 							</div>
 							<input type="submit" name="register" value="Register" class="btn btn-lg btn-success btn-block">
 						</fieldset>
 					</form>
 					<center><b>Already registered ?</b> <br></b><a href="<?php echo base_url('User/login_view'); ?>">Login here</a></center>
 				</div>
 			</div>
 		</div>
 	</div>
 </div>