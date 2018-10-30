<section class="content-header">
  <h1>
    Soal
    <small>Daftar Soal [<?= $model->nama_mapel ?>]</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Soal</a></li>
    <li class="active">Daftar</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary box-solid">
	            <div class="box-header with-border">
	              <h3 class="box-title">Data Soal [<?= $model->nama_mapel ?>]</h3>
	            </div>
	            <div class="box-body">
                <?= $this->load->view('table') ?>
	            </div>
	        </div>
		</div>
	</div>
</section>

<script type="text/javascript">
  var table;
</script>