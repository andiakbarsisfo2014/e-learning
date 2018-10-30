<?php
	$id_mapel = '';
	$nama_mapel = '';
	$btn = 'save';
	if (!is_null($model)) {
		$id_mapel = $model->id_mapel;
		$nama_mapel = $model->nama_mapel;
		$btn = 'update';		
	}
?>

<form class="form-horizontal" id="form">
	<input type="hidden" name="kode" value="<?= $id_mapel ?>">
	<div class="form-group is-empty">
		<label class="col-sm-4 control-label">ID Mapel</label>
		<div class="col-sm-8">
        	<input type="text" name="id_mapel" value="<?=$id_mapel?>" class="form-control" placeholder="ID Mapel">
		</div>
	</div>
	<div class="form-group is-empty">
		<label class="col-sm-4 control-label">Nama Mapel</label>
		<div class="col-sm-8">
        	<input type="text" name="nama_mapel" value="<?=$nama_mapel?>" class="form-control" placeholder="Nama Mapel">
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
			url = '<?=base_url('administrator/mata-pelajaran/'.$this->ubah->encode('save'))?>';
		}
		else{
			url = '<?=base_url('administrator/mata-pelajaran/'.$this->ubah->encode('update'))?>';
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