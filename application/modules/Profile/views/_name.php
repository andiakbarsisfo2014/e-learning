<?php
	$field = 'nama_'.strtolower($this->session->userdata('as'));
	$id = $model->$field;
var_dump($model);
?>

<form id="form">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" name="nama" class="form-control">
	</div>
	<div class="form-group">
		<label>Password Baru</label>
		<input type="password" name="password" class="form-control">
	</div>
	<div class="col-sm-offset-5 col-sm-6">
		<button id="upload" type="button" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
	</div>
</form>

<script type="text/javascript">
	$('#upload').click(function() {
		swal({
			title: "Perhatian",
			text: "Anda yakin data sudah benar ? ",
			type: "warning",
			showCancelButton: true,
			closeOnConfirm: false,
			showLoaderOnConfirm: true
		},
		function (){
			$.ajax({
				url : '<?=base_url('administrator/profile/'.$this->session->userdata('as').'/'.$this->ubah->encode('updateName'))?>',
				type : 'POST',
				data : $('#form').serialize(),
				datatype : 'JSON',
				success : function(data) {
					var a = JSON.parse(data);
					if (a.respon.execute) {
						$('#modal-success').modal('hide');
						swal('Message','Data berubah','success');
						window.location.reload();
					}
				},

			})
		});	
	})
</script>