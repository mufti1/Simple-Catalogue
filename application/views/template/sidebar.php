<?php $id_user=$this->session->userdata('id_user'); ?>
<nav class="navbar navbar-inverse sidebar" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand">Welcome <?php echo $this->session->userdata('username'); ?> </a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo base_url('User/edit_user/'.$id_user) ?>">Profile<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a></li>
        <li><a href="<?php echo base_url('User/add') ?>">Tambah Katalog<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span></a></li>
       <!--  <li>
          <form action="<?php echo base_url('User/dashboard') ?>" method="post">
            <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
            <button type="submit" class="btn-sidebar">Katalog List</button><span style="font-size:16px;" class="span-sidebar hidden-xs showopacity glyphicon glyphicon-th-list"></span>
          </form>
        </li> -->
        <li ><a href="<?php echo base_url('User/dashboard/').$id_user ?>">Dashboard<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a></li>
        <li ><a href="<?php echo base_url('User/user_logout');?>">Logout<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-log-out"></span></a></li>
      </ul>
    </div>
  </div>
</nav>