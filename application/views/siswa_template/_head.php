<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>####</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

	<!--     Fonts and icons     -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!-- CSS Files -->
  <link href="<?= base_url('siswa_css/')?>assets/css/material-kit.css" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?= base_url('siswa_css/')?>assets/demo/demo.css" rel="stylesheet" />
  <link href="<?= base_url('siswa_css/')?>assets/css/huruf.css" rel="stylesheet" />
  <link href="<?= base_url('siswa_css/')?>assets/css/soal.css" rel="stylesheet" />
  <!-- Material Kit CSS -->
  <link rel="stylesheet" href="<?= base_url('siswa_css/')?>assets/css/materialdesignicons.min.css">
  <link href="<?= base_url('siswa_css/')?>assets/css/make.css" rel="stylesheet"/>

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="<?= base_url('siswa_css/')?>assets/css/demo.css" rel="stylesheet" />

    <!-- Themify Icons -->
    <link rel="stylesheet" href="<?= base_url('siswa_css/')?>assets/css/themify-icons.css">
    <!-- Owl carousel -->
    <link rel="stylesheet" href="<?= base_url('siswa_css/')?>assets/css/owl.carousel.min.css">
    <!-- Main css -->
    <link href="<?= base_url('siswa_css/')?>assets/css/style.css" rel="stylesheet">
    <script type="text/javascript" src="<?= base_url('siswa_css/') ?>assets/video/video.js"></script>
  <link rel="stylesheet" href="<?= base_url('siswa_css/') ?>assets/video/video.css">
    <script>
    videojs.options.flash.swf = "video-js.swf"
  </script>
</head>

<body class="index-page">
  <script type="text/javascript" src="<?= base_url('siswa_css/assets/js/core/jquery.min.js') ?>"></script>
<!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-rose fixed-top">
            <div class="container">
              <div class="navbar-translate">
                <a class="navbar-brand" href="<?= base_url('siswa_css')?>#0">UN-LEARNING</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="navbar-toggler-icon"></span>
                  <span class="navbar-toggler-icon"></span>
                  <span class="navbar-toggler-icon"></span>
                </button>
              </div>
              <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                    <a href="<?= base_url() ?>" class="nav-link">
                      <i class="mdi mdi-home mdi-18px l"></i> Home
                    </a>
                  </li>
                  <?php
                    if (!is_null($this->session->userdata('data_id'))) {
                      ?>
                      <li class="nav-item" id="score">
                    <a href="javascript:;" class="nav-link">
                      <i class="mdi mdi-file-excel mdi-18px l"></i> Nilai
                    </a>
                  </li> 
                      <?php
                    }
                  ?>
                  <?php
                  if (is_null($this->session->userdata('siswa_id'))) {
                    ?>
                    <li class="nav-item" id="log">
                    <a href="#pablo" class="nav-link" style="color:;">
                      <i class="mdi mdi-lock mdi-18px l"></i> MASUK
                    </a>
                  </li>
                    <?php
                  }
                  ?>
                  <?php
                  if (!is_null($this->session->userdata('siswa_id'))) {
                    ?>
                    <li class="dropdown nav-item">
                      <a href="#pablo" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="mdi mdi-account-convert mdi-18px"> </i><?= $this->session->userdata('siswa_nama') ?></a>
                      <div class="dropdown-menu">
                        <div class="dropdown-divider"></div>
                        <a href="<?= base_url('siswa/logout') ?>" class="dropdown-item">Keluar</a>
                        <div class="dropdown-divider"></div>
                      </div>
                  </li>
                    <?php
                  }
                  ?>
                </ul>
              </div>
            </div>
  </nav>
  <div class="page-header header-filter" data-parallax="true" style="background-image: url('<?= base_url('siswa_css/assets/img/bg-banner.jpg') ?>')">
    <div class="container">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
          <div class="brand text-center">
            <h1>UN-LEARNING</h1>
            <h3 class="title text-center">SMP 4 SINJAI</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
	<div class="main main-raised" style="background-color: white">