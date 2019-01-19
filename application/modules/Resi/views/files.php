<section class="content-header">
  <h1>
    Berkas
    <small>Daftar Berkas</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Daftar</a></li>
    <li class="active">Berkas</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary box-solid">
	            <div class="box-header with-border">
	              <h3 class="box-title">Daftar Layanan Resi</h3>
	            </div>
	            <div class="box-body value">
	            	<?php $this->load->view('list',['kondisi' => $kondisi]) ?>
	            </div>
	        </div>
		</div>
	</div>
</section>