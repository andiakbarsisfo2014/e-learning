<?php

	$no_kk = '';
	$kepala_keluarga = '';
	$rt = '';
	$rw = '';
	$desa = '';
	$kec = '';
	$kab = '';
	$kode_pos = '';
	$prov = '';
	$btn = 'save';

	if (!is_null($model)) {
		$no_kk = $model->no_kk;
		$kepala_keluarga = $model->kepala_keluarga;
		$rt = $model->rt;
		$rw = $model->rw;
		$desa = $model->desa_kelurahan;
		$kec = $model->kec;
		$kab = $model->kab;
		$kode_pos = $model->kode_pos;
		$prov = $model->prov;
		$btn = 'update';
	}
?>
<form class="form-horizontal" id="form">
	<div class="col-sm-offset-1 col-sm-8">
		<input type="hidden" name="kode" value="<?= $no_kk ?>">
		<div class="form-group is-empty">
			<label class="col-sm-4 control-label">No. Kartu Keluarga</label>
			<div class="col-sm-8">
	        	<input type="text" name="no_kk" value="<?= $no_kk ?>" class="form-control" placeholder="No.KK">
			</div>
		</div>
		<div class="form-group is-empty">
			<label class="col-sm-4 control-label">Kepala Keluarga</label>
			<div class="col-sm-8">
	        	<input type="text" name="kepala_keluarga" value="<?= $kepala_keluarga ?>" class="form-control" placeholder="Kepala Keluarga">
			</div>
		</div>
		<div class="form-group is-empty">
			<label class="col-sm-4 control-label">No. RT</label>
			<div class="col-sm-8">
	        	<input type="text" name="rt" id="nama_berkas" value="<?= $rt ?>" class="form-control" placeholder="No. RT">
			</div>
		</div>
		<div class="form-group is-empty">
			<label class="col-sm-4 control-label">No. RW</label>
			<div class="col-sm-8">
	        	<input type="text" name="rw" id="nama_berkas" value="<?= $rw ?>" class="form-control" placeholder="No. RW">
			</div>
		</div>
		<div class="form-group is-empty">
			<label class="col-sm-4 control-label">Desa / Kelurahan</label>
			<div class="col-sm-8">
	        	<input type="text" name="desa_kelurahan" id="nama_berkas" value="<?= $rt ?>" class="form-control" placeholder="No. RT">
			</div>
		</div>
		<div class="form-group is-empty">
			<label class="col-sm-4 control-label">Kec.</label>
			<div class="col-sm-8">
	        	<input type="text" name="kec" id="nama_berkas" value="<?= $kec ?>" class="form-control" placeholder="Kec.">
			</div>
		</div>
		<div class="form-group is-empty">
			<label class="col-sm-4 control-label">Kab.</label>
			<div class="col-sm-8">
	        	<input type="text" name="kab" id="nama_berkas" value="<?= $kab ?>" class="form-control" placeholder="Kab.">
			</div>
		</div>
		<div class="form-group is-empty">
			<label class="col-sm-4 control-label">Kode Pos</label>
			<div class="col-sm-8">
	        	<input type="text" name="kode_pos" id="nama_berkas" value="<?= $kode_pos ?>" class="form-control" placeholder="Kode Pos">
			</div>
		</div>
		<div class="form-group is-empty">
			<label class="col-sm-4 control-label">Provinsi</label>
			<div class="col-sm-8">
	        	<input type="text" name="prov" id="nama_berkas" value="<?= $prov ?>" class="form-control" placeholder="Provinsi">
			</div>
		</div>

		<div class="col-sm-offset-6 col-sm-6">
			<button type="button" id="kr" data-action="<?=$btn?>" class="btn btn-primary"><i class="fa fa-save"></i> save</button>
		</div>
	</div>
</form>
<script type="text/javascript">
	$('#kr').click(function() {
		if ($(this).data('action') == 'save') {
			var url = '<?= base_url('administrator/kartu-keluarga/'.$this->ubah->encode('save')) ?>';
		}
		else{
			var url = '<?= base_url('administrator/kartu-keluarga/'.$this->ubah->encode('update')) ?>';
		}

		swal({
          title: "Perhatian",
          text: "Anda yakin data sudah benar ? ",
          type: "warning",
          showCancelButton: true,
          closeOnConfirm: false,
          showLoaderOnConfirm: true
        },function() {
            $.ajax({
            url : url,
            type : 'POST',
            data : $('#form').serialize(),
            datatype : 'JSON',
            success : function(data) {
              var hasil = JSON.parse(data);
              if(hasil.respon.execute == true){
                swal('Success','Data tersimpan','success');
                $('.value').load('<?= base_url('administrator/kartu-keluarga/'.$this->ubah->encode('table')) ?>');
              }
              else{
                swal('Error',hasil.respon.message,'error'); 
              }
            }
          })  
        })
	})
</script>