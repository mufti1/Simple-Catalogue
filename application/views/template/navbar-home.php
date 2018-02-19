<?php 
$id_user=$this->session->userdata('id_user'); 
$username=$this->session->userdata('username');
$level = $this->session->userdata('level');
$id= substr($id_user, 1, 4);
$url = base_url();
?>
<nav class="navbar navbar-default navbar-fixed-top" style="background-color: #fff !important; height: 50px;">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand color-black" href="<?php echo base_url('/Home') ?>">E Catalouge</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
				<li><a href="#">Link</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#">Action</a></li>
						<li><a href="#">Another action</a></li>
						<li><a href="#">Something else here</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#">Separated link</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#">One more separated link</a></li>
					</ul>
				</li>
			</ul>
			<form class="navbar-form navbar-left" method="get" action="<?php echo base_url('home/search') ?>">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Cari Judul Katalog" name="judul">
				</div>
				<button type="submit" class="btn btn-default">Cari</button>
			</form>
			<ul class="nav navbar-nav navbar-right">
				<?php if ($id > 0 && $level =="users" or $level =="admins") {
					echo"<li class='dropdown'>
					<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>$username <span class='caret'></span></a>
					<ul class='dropdown-menu'>
					<li><a href='$url/User'>Dashboard</a></li>
					<li><a href='$url/user/user_logout'>Logout</a></li>
					</ul>
					</li>";
				}
				else if ($id > 0 && $level =="guest") {
					echo"
					<li><a href='$url/User/user_logout'><button class='btn btn-danger btn-nav'>Logout</button></a></li>
					";
				}
				else{
					
					echo"
					<li><a href='$url/User/login_view'><button class='btn btn-success btn-nav'>Login</button></a></li>
					";
				}

				?>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>