<?php
	
	$id_guru = '';
	$nama_guru = '';
	$btn = 'save';
	if (!is_null($model)) {
		$id_guru = $model->id_guru;
		$nama_guru = $model->nama_guru;
		$btn = 'update';
	}
	
?>
<form class="form-horizontal" id="form">
	<input type="hidden" name="kode" value="<?= $id_guru ?>">
	<div class="form-group is-empty">
		<label class="col-sm-4 control-label">ID Guru</label>
		<div class="col-sm-8">
        	<input type="text" name="id_guru" value="<?=$id_guru?>" class="form-control" placeholder="ID Guru">
		</div>
	</div>
	<div class="form-group is-empty">
		<label class="col-sm-4 control-label">Nama Guru</label>
		<div class="col-sm-8">
        	<input type="text" name="nama_guru" value="<?=$nama_guru?>" class="form-control" placeholder="Nama Guru">
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
			url = '<?=base_url('administrator/guru/'.$this->ubah->encode('save'))?>';
		}
		else{
			url = '<?=base_url('administrator/guru/'.$this->ubah->encode('update'))?>';
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