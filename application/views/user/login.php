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
 						Login
 					</h3>
 				</div>
 				<div class="panel-body">
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
 					<div class="panel-body">
 						<form role="form" method="post" action="<?php echo base_url('User/login_user'); ?>">
 							<fieldset>
 								<div class="form-group"  >
 									<input class="form-control" placeholder="Username" name="username" type="text" autofocus>
 								</div>
 								<div class="form-group">
 									<input class="form-control" placeholder="Password" name="password" type="password">
 								</div>


 								<input class="btn btn-lg btn-success btn-block" type="submit" value="login" name="login" >

 							</fieldset>
 						</form>
 						<center><b>Not registered ?</b> <br></b><a href="<?php echo base_url('User'); ?>">Register here</a></center>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>