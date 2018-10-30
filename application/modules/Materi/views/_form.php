<?php
	$id_materi = '';
	$judul = '';
	$materi = '';
	$video = '';
	$btn  = 'save';
	if (!is_null($model)) {
		$id_materi = $model->id_materi;
		$judul = $model->judul;
		$materi = $model->materi;
		$video = $model->video;
		$btn = 'update';
	}
?>

<form class="form-horizontal" id="form">
	<input type="hidden" name="kode" value="<?= $mapel->id_mapel ?>">
	<input type="hidden" name="id_materi" value="<?= $id_materi ?>">
	<div class="form-group is-empty">
		<label class="col-sm-4 control-label">Mata Pelajaran</label>
		<div class="col-sm-8">
        <input type="text" name="" class="form-control" value="<?= $mapel->nama_mapel ?>">
		</div>
	</div>
	

	<div class="form-group is-empty">
		<label class="col-sm-4 control-label">Judul Materi</label>
		<div class="col-sm-8">
        	<input type="text" name="judul" class="form-control" placeholder="Judul Materi" value="<?= $judul ?>">
		</div>
	</div>

	<label>Materi</label>
		<input type="file" name="pdf" class="form-control" value="<?= $materi ?>">
	<label>Video Materi</label>
		<input type="file" name="video" class="form-control" value="<?= $video ?>">

	<div class="col-sm-offset-5 col-sm-6">
		<button type="button" id="kr" data-action="<?= $btn ?>" class="btn btn-primary"><i class="fa fa-save"></i> save</button>
	</div>
</form>
<script type="text/javascript">
	$('#kr').click(function() {
		if ($(this).data('action') == 'save') {
			var url = '<?= base_url('administrator/materi/'.$this->ubah->encode('save')) ?>';
		}
		else{
			var url = '<?= base_url('administrator/materi/'.$this->ubah->encode('update')) ?>';
		}
		var data = new FormData( $('#form')[0] );
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
	            url : url,
	            type : 'POST',
	            data : data,
	            contentType : false,
				processData: false,
	            datatype : 'JSON',
	            success : function(data) {
	              var hasil = JSON.parse(data);
	              if(hasil.respon.execute == true){
	              	swal('Pesan','Data tersimpan','success');
	              		$('#modal-success').modal('hide');
	              	  table.api().ajax.reload();
	              }

	              else{
	                swal('Error',hasil.respon.message,'error'); 
	              }
	            }
	          })
		});	
	})
</script>