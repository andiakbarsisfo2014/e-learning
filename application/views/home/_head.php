<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="<?=base_url('admin_css/')?>assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?=base_url('admin_css/')?>assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    UN-LEARNING
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link href="<?=base_url('admin_css/')?>assets/mdi/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
  <!-- CSS Files -->
  <link href="<?=base_url('admin_css/')?>assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
  <link href="<?=base_url('additional/datatables.net-bs/css/dataTables.bootstrap.min.css')?>" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?=base_url('admin_css/')?>assets/demo/demo.css" rel="stylesheet" />
</head>

<body class=""style="margin: 0px; padding:0px">
  <script src="<?=base_url('admin_css/')?>assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="<?=base_url('additional/datatables.net/js/jquery.dataTables.min.js')?>"></script>
  <script type="text/javascript" src="<?=base_url('additional/datatables.net-bs/js/dataTables.bootstrap.min.js')?>"></script>
  <div class="wrapper ">
    <div class="sidebar" data-color="azure" data-background-color="green" data-image="<?=base_url('admin_css/')?>/assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo" style="padding-top: 0px;">
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
          <img class="responsive" src="<?=base_url('admin_css/')?>assets/img/UNLOGO.jpg" style="height: 100%; width: 100%">
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item active  ">
            <a class="nav-link" href="<?=base_url('management')?>">
              <i class="mdi mdi-view-dashboard"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item" id="data_siswa">
            <a class="nav-link" href="javascript:;">
              <i class="mdi mdi-account-box"></i>
              <p>Data Siswa</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="tables.html">
              <i class="mdi mdi-account-box"></i>
              <p>Data guru</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="data_soal.html">
              <i class="mdi mdi-file-document"></i>
              <p>Data Soal</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./icons.html">
              <i class="mdi mdi-file-pdf"></i>
              <p>Data Materi</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="./map.html">
              <i class="mdi mdi-map-marker"></i>
              <p>Maps</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar- navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="#pablo">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form">
              <div class="input-group ">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="mdi mdi-search-web mdi-24px"></i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="material-icons">dashboard</i>
                  <p class="d-lg-none d-md-block">
                    Stats
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="mdi mdi-bell-ring-outline mdi-24px"></i>
                  <span class="notification">5</span>
                  <p class="d-lg-none d-md-block">
                    Some Actions
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Mike John responded to your email</a>
                  <a class="dropdown-item" href="#">You have 5 new tasks</a>
                  <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                  <a class="dropdown-item" href="#">Another Notification</a>
                  <a class="dropdown-item" href="#">Another One</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="mdi mdi-account-circle mdi-24px"></i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        
      