<?php

	$id_user = '';
	$nama = '';
	$admin = '';
	$user = '';
	$btn = 'save';
	if (!is_null($model)) {
		$id_user = $model->id_user;
		$nama = $model->nama;
		if ($model->level == 'admin') {
			$admin = 'selected';
		}
		else{
			$user = 'selected';
		}
		$btn = 'update';
	}
?>
<form class="form-horizontal" id="form">
	<input type="hidden" name="kode" value="<?= $id_user ?>">
	<div class="form-group is-empty">
		<label class="col-sm-4 control-label">ID User</label>
		<div class="col-sm-8">
        	<input type="text" name="id_user" value="<?= $id_user ?>" class="form-control" placeholder="ID User">
		</div>
	</div>
	<div class="form-group is-empty">
		<label class="col-sm-4 control-label">Nama User</label>
		<div class="col-sm-8">
        	<input type="text" name="nama" value="<?= $nama ?>" class="form-control" placeholder="Nama User">
		</div>
	</div>
	<?php
	if ($btn == 'save') {
		?>
		<div class="form-group is-empty">
		<label class="col-sm-4 control-label">Kata Sandi</label>
		<div class="col-sm-8">
        	<input type="password" name="kata_sandi" class="form-control" placeholder="Kata Sandi">
		</div>
	</div>
	<div class="form-group is-empty">
		<label class="col-sm-4 control-label">Konfirmasi Sandi</label>
		<div class="col-sm-8">
        	<input type="password" name="konfirm" class="form-control" placeholder="Konfirmasi ">
		</div>
	</div>
		<?php
	}
	?>
	<div class="form-group is-empty">
		<label class="col-sm-4 control-label">Level</label>
		<div class="col-sm-8">
        	<select class="form-control" name="level">
        		<option value="" > -- Pilih Level -- </option>
        		<option value="admin" <?= $admin ?> > Admin </option>
        		<option value="user" <?= $user ?> > User </option>
        	</select>
		</div>
	</div>
	<div class="col-sm-offset-5 col-sm-6">
		<button type="button" id="kr" data-action="<?=$btn?>" class="btn btn-primary"><i class="fa fa-save"></i> save</button>
	</div>
</form>
<script type="text/javascript">
	$('#kr').click(function() {
		if ($(this).data('action') == 'save') {
			url = '<?=base_url('administrator/management/'.$this->ubah->encode('save'))?>';
		}
		else{
			url = '<?=base_url('administrator/management/'.$this->ubah->encode('update'))?>';
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