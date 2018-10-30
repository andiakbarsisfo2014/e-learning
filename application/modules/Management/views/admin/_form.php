<?php

	$id_admin = '';
	$nama_admin = '';
	$btn = 'save';
	if (!is_null($model)) {
		$id_admin = $model->id_admin;
		$nama_admin = $model->nama_admin;
		$btn = 'update';
	}
?>
<form class="form-horizontal" id="form">
	<input type="hidden" name="kode" value="<?= $id_admin ?>">
	<div class="form-group is-empty">
		<label class="col-sm-4 control-label">ID User</label>
		<div class="col-sm-8">
        	<input type="text" name="id_admin" value="<?= $id_admin ?>" class="form-control" placeholder="ID User">
		</div>
	</div>
	<div class="form-group is-empty">
		<label class="col-sm-4 control-label">Nama User</label>
		<div class="col-sm-8">
        	<input type="text" name="nama_admin" value="<?= $nama_admin ?>" class="form-control" placeholder="Nama User">
		</div>
	</div>
	<div class="col-sm-offset-5 col-sm-6">
		<button type="button" id="kr" data-action="<?=$btn?>" class="btn btn-primary"><i class="fa fa-save"></i> save</button>
	</div>
</form>
<script type="text/javascript">
	$('#kr').click(function() {
		if ($(this).data('action') == 'save') {
			url = '<?=base_url('administrator/management/user/admin/'.$this->ubah->encode('save'))?>';
		}
		else{
			url = '<?=base_url('administrator/management/user/admin/'.$this->ubah->encode('update'))?>';
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