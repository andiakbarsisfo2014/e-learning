<?php
	$id_siswa = '';
	$nama_siswa = '';
	$btn = 'save';
	if (!is_null($model)) {
		$id_siswa = $model->id_siswa;
		$nama_siswa = $model->nama_siswa;
		$btn = 'update';
	}

?>
<form class="form-horizontal" id="form">
	<input type="hidden" name="kode" value="<?= $id_siswa ?>">
	<div class="form-group is-empty">
		<label class="col-sm-4 control-label">ID Siswa</label>
		<div class="col-sm-8">
        	<input type="text" name="id_siswa" value="<?=$id_siswa?>" class="form-control" placeholder="ID Siswa">
		</div>
	</div>
	<div class="form-group is-empty">
		<label class="col-sm-4 control-label">Nama Siswa</label>
		<div class="col-sm-8">
        	<input type="text" name="nama_siswa" value="<?=$nama_siswa?>" class="form-control" placeholder="Nama Siswa">
		</div>
	</div>
	<div class="col-sm-offset-5 col-sm-6">
		<button type="button" id="kr" data-action="<?=$btn?>" class="btn btn-primary"><i class="fa fa-save"></i> save</button>
	</div>
</form>
<script type="text/javascript">
	$('#kr').click(function() {
		var url;
		if ($(this).data('action') == 'save') {
			url = '<?=base_url('administrator/siswa/'.$this->ubah->encode('save'))?>';
		}
		else{
			url = '<?=base_url('administrator/siswa/'.$this->ubah->encode('update'))?>';
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
                $('#modal-success').modal('hide');
                swal('Success','Data tersimpan','success');
                table.api().ajax.reload();
              }
              else{
                swal('Error',hasil.respon.message,'error'); 
              }
            }
          })  
        })
	})
</script>