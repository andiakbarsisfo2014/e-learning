<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Web-Resi | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- <link rel=”icon” type=”image/png” href=<?=base_url('dist/img/BKM.png')?>> -->
  <link rel=”icon” type=”image/png” href=http//aplikasikita.com/images/iconkita.png>
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href=<?=base_url("bower_components/bootstrap/dist/css/bootstrap.min.css")?>>
  <!-- Font Awesome -->
  <link rel="stylesheet" href=<?=base_url("bower_components/font-awesome/css/font-awesome.min.css")?>>
  <!-- Ionicons -->
  <link rel="stylesheet" href=<?=base_url("bower_components/Ionicons/css/ionicons.min.css")?>>
  <!-- Theme style -->
  <link rel="stylesheet" href=<?=base_url("dist/css/AdminLTE.min.css")?>>
  <!-- Material Design -->
  <link rel="stylesheet" href=<?=base_url("dist/css/bootstrap-material-design.min.css")?>>
  <link rel="stylesheet" href=<?=base_url("dist/css/ripples.min.css")?>>
  <link rel="stylesheet" href=<?=base_url("dist/css/MaterialAdminLTE.min.css")?>>
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href=<?=base_url("dist/css/skins/all-md-skins.min.css")?>>
  <!-- Morris chart -->
  <link rel="stylesheet" href=<?=base_url("bower_components/morris.js/morris.css")?>>
  <!-- jvectormap -->
  <link rel="stylesheet" href=<?=base_url("bower_components/jvectormap/jquery-jvectormap.css")?>>
  <!-- Date Picker -->
  <link rel="stylesheet" href=<?=base_url("bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css")?>>
  <!-- Daterange picker -->
  <link rel="stylesheet" href=<?=base_url("bower_components/bootstrap-daterangepicker/daterangepicker.css")?>>
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href=<?=base_url("plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")?>>
  <link rel="stylesheet" href=<?=base_url("plugins/sweet/dist/sweetalert.css")?>>
  <link rel="stylesheet" href=<?=base_url("bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")?>>
   <link rel="stylesheet" href=<?=base_url("bower_components/select2/dist/css/select2.min.css")?>>
   <link rel="stylesheet" href=<?=base_url('plugins/pace/pace.min.css')?>>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?=base_url()?>bower_components/ckeditor/ckeditor.js"></script>
  <script src="<?=base_url()?>plugins/sweet/dist/sweetalert.min.js"></script>
  <script src=<?=base_url("bower_components/datatables.net/js/jquery.dataTables.min.js")?>></script>
  <script src=<?=base_url("bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js")?>></script>
  <script src=<?=base_url("bower_components/select2/dist/js/select2.full.min.js")?>></script>
<div class="wrapper" >

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">M<b>A</b>L</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">E<b> - Learning</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=base_url('logo/gowa.png')?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?=$this->session->userdata('nama')?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?=base_url('logo/gowa.png')?>" class="img-circle" alt="User Image">

                <p>
                  <?=$this->session->userdata('nama')?> - <?= $this->session->userdata('as') ?>
                  <!-- <small>Member since Nov. 2012</small> -->
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?=base_url('user/logout')?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=base_url('logo/gowa.png')?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $this->session->userdata('nama') ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <?php
          if ($this->session->userdata('level') == 'admin') {
            ?>
            <li class="treeview" id="layanan">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Layanan</span>
          </a>
        </li>
        <li class="treeview" id="master">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Master Penduduk</span>
          </a>
        </li>
        <li class="treeview" id="kk">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Master Kartu Keluarga</span>
          </a>
        </li>
        <li class="treeview" id="manuser">
          <a href="javascript:;">
            <i class="fa fa-user"></i>
            <span>Management User</span>
          </a>
        </li>
        <li class="treeview" id="reset">
          <a href="javascript:;">
            <i class="fa fa-gears"></i>
            <span>Reset Antrian</span>
          </a>
        </li>
            <?php
          }
        ?>
        <li class="treeview" id="resi">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Cetak Resi</span>
          </a>
        </li>
        <li class="treeview" id="get_file">
          <a href="javascript:;">
            <i class="fa fa-user"></i>
            <span>Pengambilan Berkas</span>
          </a>
        </li>
        <li class="treeview" id="call">
          <a href="javascript:;">
            <i class="fa"></i>
            <span>Panggil Antrian</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    
  
