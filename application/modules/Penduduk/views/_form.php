<?php
	$kode_penduduk = '';
	$no_kk = '';
	$no_ktp = '';
	$nama = '';
	$pria = '';
	$wanita = '';
	$btn = 'save';

	if (!is_null($model)) {
		$kode_penduduk = $model->kode_penduduk;
		$no_kk = '<option value="'.$model->no_kk.'">'.$model->kepala_keluarga.'</option>';
		$no_ktp = $model->no_ktp;
		if ($model->jk == 'pria') {
			$pria = 'selected';
		}
		else{
			$wanita = 'selected';
		}
		$nama = $model->nama;
		$btn = 'update';		
	}
?>
<form class="form-horizontal" id="form">
	<div class="col-sm-offset-1 col-sm-8">
		<input type="hidden" name="kode" value="<?= $kode_penduduk ?>">
		<div class="form-group is-empty">
			<label class="col-sm-4 control-label">No. KK</label>
			<div class="col-sm-8">
	        	<select class="form-control" name="no_kk"> <?= $no_kk ?> </select>
			</div>
		</div>
		<div class="form-group is-empty">
			<label class="col-sm-4 control-label">No. KTP</label>
			<div class="col-sm-8">
	        	<input type="text" name="no_ktp" value="<?= $no_ktp ?>" class="form-control" placeholder="No. KTP">
			</div>
		</div>
		<div class="form-group is-empty">
			<label class="col-sm-4 control-label">Nama Penduduk</label>
			<div class="col-sm-8">
	        	<input type="text" name="nama" value="<?= $nama ?>" class="form-control" placeholder="Nama Penduduk">
			</div>
		</div>
		<div class="form-group is-empty">
			<label class="col-sm-4 control-label">Jenis Kelamin</label>
			<div class="col-sm-8">
	        	<select name="jk" class="form-control">
	        		<option value="pria" <?= $pria ?>> Pria </option>
	        		<option value="wanita" <?= $wanita ?>> Wanita </option>
	        	</select>
			</div>
		</div>
		<div class="col-sm-offset-6 col-sm-6">
			<button type="button" id="kr" data-action="<?=$btn?>" class="btn btn-primary"><i class="fa fa-save"></i> save</button>
		</div>
	</div>
</form>
<script type="text/javascript">

	function formatData (data) {
		if (!data.id) { return data.text; }
		var ra  = '<div><i class="fa fa-map" style="color:#164a0a"></i> '+data.id+' / '+data.text+'</div>';
		return $(ra);
	}

	$('#kr').click(function () {
		if ($(this).data('action') == 'save') {
			var url = '<?= base_url('administrator/data-penduduk/'.$this->ubah->encode('save')) ?>';
		}
		else{
			var url = '<?= base_url('administrator/data-penduduk/'.$this->ubah->encode('update')) ?>';
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
                $('.value').load('<?= base_url('administrator/data-penduduk/'.$this->ubah->encode('table')) ?>');
              }
              else{
                swal('Error',hasil.respon.message,'error'); 
              }
            }
          })  
        })
	});
	$('select[name=jk]').select2();
	$('select[name=no_kk]').select2({
		placeholder : '-- Pilih No.KK --',
		ajax : {
			url :'<?= base_url('administrator/data-penduduk/').$this->ubah->encode('get_penduduk') ?>',
			type : 'POST',
			dataType : 'json',
			delay : 250,
			data : function(params) {
				return {
					kode : params.term
				};
			},
			processResults : function(data) {
				var result = [];
				$.each(data,function(index,item) {
					result.push({
						id : item.no_kk,
						text : item.kepala_keluarga,
					});
				});
				return{ results : result };
			},
			cache : true,
		},
		templateResult : formatData,
		templateSelection: formatData,
	});
	$('span.select2-selection.select2-selection--single').css({
      'height' : '45px',
      'padding-top' : '10px',
    });

    $('span.select2-selection__arrow').css({
      'margin-top' : '9px',
    });
</script>