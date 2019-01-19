<?php
	$id_pelayanan = '';
	$jenis_pelayanan = '';
	$syarat = '';
	$nama_berkas = '';
	$btn = 'save';
	if (!is_null($model)) {
		$id_pelayanan = $model->id_pelayanan;
		$jenis_pelayanan = $model->jenis_pelayanan;
		$syarat = $model->syarat;
		$nama_berkas = $model->nama_berkas;
		$btn = 'update';
	}

?>
<form class="form-horizontal" id="form">
	<div class="col-sm-offset-1 col-sm-8">
		<input type="hidden" name="kode" value="<?= $id_pelayanan ?>">
		<div class="form-group is-empty">
			<label class="col-sm-4 control-label">Jenis Layanan</label>
			<div class="col-sm-8">
	        	<input type="text" name="jenis_pelayanan" id="jenis_pelayanan" value="<?= $jenis_pelayanan ?>" class="form-control" placeholder="Jenis Pelayanan">
			</div>
		</div>
		<div class="form-group is-empty">
			<label class="col-sm-4 control-label">Nama Berkas</label>
			<div class="col-sm-8">
	        	<input type="text" name="nama_berkas" id="nama_berkas" value="<?= $nama_berkas ?>" class="form-control" placeholder="Nama Berkas">
			</div>
		</div>
		<div class="form-group is-empty">
			<label class="col-sm-4 control-label">Syarat</label>
			<div class="col-sm-8">
	        	<textarea name="syarat" id="syarat"><?= $syarat ?></textarea>
			</div>
		</div>
		<div class="col-sm-offset-6 col-sm-6">
			<button type="button" id="kr" data-action="<?=$btn?>" class="btn btn-primary"><i class="fa fa-save"></i> save</button>
		</div>
	</div>
</form>
<script type="text/javascript">
	var a = CKEDITOR.replace('syarat');
	$('#kr').click(function() {
		if ($(this).data('action') == 'save') {
			url = '<?=base_url('administrator/layanan/'.$this->ubah->encode('save'))?>';
		}
		else{
			url = '<?=base_url('administrator/layanan/'.$this->ubah->encode('update'))?>';
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
            data : {
            	jenis_pelayanan : $('#jenis_pelayanan').val(),
            	syarat : a.getData(),
            	kode : $('input[name=kode]').val(),
            	nama_berkas : $('input[name=nama_berkas]').val(),
            },
            datatype : 'JSON',
            success : function(data) {
              var hasil = JSON.parse(data);
              if(hasil.respon.execute == true){
                swal('Success','Data tersimpan','success');
                $('.value').load('<?= base_url('administrator/layanan/'.$this->ubah->encode('table')) ?>');
              }
              else{
                swal('Error',hasil.respon.message,'error'); 
              }
            }
          })  
        })
	})
</script>