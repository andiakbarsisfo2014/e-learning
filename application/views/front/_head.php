<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>RESI - WEB</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?=base_url()?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?=base_url()?>bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?=base_url()?>dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?=base_url()?>dist/css/bootstrap-material-design.min.css">
  <link rel="stylesheet" href="<?=base_url()?>dist/css/ripples.min.css">
  <link rel="stylesheet" href="<?=base_url()?>dist/css/MaterialAdminLTE.min.css">
  <link rel="stylesheet" href="<?=base_url()?>dist/css/skins/all-md-skins.min.css">
  <link rel="stylesheet" href=<?=base_url("bower_components/select2/dist/css/select2.min.css")?>>
  <link rel="stylesheet" href=<?=base_url("plugins/sweet/dist/sweetalert.css")?>>
  <link rel="stylesheet" href=<?=base_url("bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")?>>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
    .kotak {
      border : 1px solid;
    }
  </style>
</head>
<body class="hold-transition skin-blue layout-top-nav">
<script src="<?=base_url()?>bower_components/jquery/dist/jquery.min.js"></script>
  <script src=<?=base_url("bower_components/datatables.net/js/jquery.dataTables.min.js")?>></script>
  <script src=<?=base_url("bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js")?>></script>
  <script src=<?=base_url("bower_components/select2/dist/js/select2.full.min.js")?>></script>
  <script src="<?=base_url()?>plugins/sweet/dist/sweetalert.min.js"></script>
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
		  <a href="<?=base_url()?>" class="navbar-brand"><b>WEB | RESI</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li id="terbit"><a href="javascript:;"><i class="fa fa-archive"></i> Daftar Berkas Terbit</a></li>
            <li id="antrian"><a href="javascript:;"><i class="fa fa-quote-left"></i> Nomor Antrian</a></li>
          </ul>
        </div>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li><a href="<?= base_url('user/login') ?>"><i class="fa fa-user"></i> Login</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <div class="content-wrapper">
    <div class="container bkm">