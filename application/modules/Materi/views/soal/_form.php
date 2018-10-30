<?php
	$kode = '';
	$soal = '';
	$a = '';
	$b = '';
	$c = '';
	$d = '';
	
	$img_soal = '';
	$img_a = '';
	$img_b = '';
	$img_c = '';
	$img_d = '';

	$j_a = '';
	$j_b = '';
	$j_c = '';
	$j_d = '';
	$select = '';
	$btn = 'save';
	if (!is_null($model)) {
		$kode = $model->id_soal;
		$soal = $model->soal;
		$a = $model->a;
		$b = $model->b;
		$c = $model->c;
		$d = $model->d;

		$img_soal = $model->img_soal;
		$img_a = $model->img_a;
		$img_b = $model->img_b;
		$img_c = $model->img_c;
		$img_d = $model->img_d;
		
		if (strtolower($model->benar) == 'a') {
			$j_a = 'selected';
		}
		elseif (strtolower($model->benar) == 'b') {
			$j_b = 'selected';
		}
		elseif (strtolower($model->benar) == 'c') {
			$j_c = 'selected';
		}
		elseif (strtolower($model->benar) == 'd') {
			$j_d = 'selected';
		}
		$select = '<option value="'.$model->id_materi.'">'.$model->judul.'</option>';
		$btn = 'update';
	}

?>
<form class="form-horizontal" id="form">
	<input type="hidden" name="kode" value="<?= $kode ?>">
	<div class="form-group">
		<label class="col-sm-3 control-label">Pilih Materi</label>
		<div class="col-sm-8">
        	<select name="materi" class="form-control materi" style="width: 100%;">
        		<?= $select ?>
        	</select>
		</div>
	</div>
	<div class="col-sm-offset-1 col-sm-6">
		<div class="form-group">
			<label>Soal</label>
        	<textarea class="form-control" name="soal"><?= $soal ?></textarea>
		</div>
	</div>
	<div class="col-sm-offset-1 col-sm-4">
		<label>Gambar Soal</label>
		<input type="file" name="img_soal" class="form-control" accept="image/*">
	</div>
	<div class="col-sm-offset-1 col-sm-6">
		<div class="form-group">
			<label>Pilihan A</label>
        	<textarea class="form-control" name="a"> <?= $a ?></textarea>
		</div>
	</div>
	<div class="col-sm-offset-1 col-sm-4">
		<label>Gambar Pil. A</label>
		<input type="file" name="img_a" class="form-control" accept="image/*">
	</div>

	<div class="col-sm-offset-1 col-sm-6">
		<div class="form-group">
			<label>Pilihan B</label>
        	<textarea class="form-control" name="b"><?= $b ?></textarea>
		</div>
	</div>
	<div class="col-sm-offset-1 col-sm-4">
		<label>Gambar Pil. B</label>
		<input type="file" name="img_b" class="form-control" accept="image/*">
	</div>

	<div class="col-sm-offset-1 col-sm-6">
		<div class="form-group">
			<label>Pilihan C</label>
        	<textarea class="form-control" name="c"><?= $c ?></textarea>
		</div>
	</div>
	<div class="col-sm-offset-1 col-sm-4">
		<label>Gambar Pil. C</label>
		<input type="file" name="img_c" class="form-control" accept="image/*">
	</div>

	<div class="col-sm-offset-1 col-sm-6">
		<div class="form-group">
			<label>Pilihan D</label>
        	<textarea class="form-control" name="d"><?= $d ?></textarea>
		</div>
	</div>	
	<div class="col-sm-offset-1 col-sm-4">
		<label>Gambar Pil. D</label>
		<input type="file" name="img_d" class="form-control" accept="image/*" value="akbar">
	</div>

	<div class="col-sm-offset-1 col-sm-6">
		<label class="col-sm-3 control-label">Jawaban Benar</label>
		<div class="col-sm-8">
        	<select name="true" class="form-control true" style="width: 100%;">
        		<option value="A" <?= $j_a ?>>A</option>
        		<option value="B" <?= $j_b ?>>B</option>
        		<option value="C" <?= $j_c ?>>C</option>
        		<option value="D" <?= $j_d ?>>D</option>
        	</select>
		</div>
	</div>
	<input type="hidden" name="_img_a" value="<?= $img_a ?>">
	<input type="hidden" name="_img_b" value="<?= $img_b ?>">
	<input type="hidden" name="_img_c" value="<?= $img_c ?>">
	<input type="hidden" name="_img_d" value="<?= $img_d ?>">
	<input type="hidden" name="_img_soal" value="<?= $img_soal ?>">
	<div class="col-sm-offset-5 col-sm-6">
		<button type="button" id="back" class="btn btn-danger"><i class="fa fa-backward"></i> Kembali</button>
		<button type="button" id="kr" data-action="<?= $btn ?>" class="btn btn-primary"><i class="fa fa-save"></i> save</button>
	</div>
</form>
<script type="text/javascript">
	function formatData2 (data) {
		if (!data.id) { return data.text; }
    	var ra  = '<div><i class="fa fa-map" style="color:#164a0a"></i> '+data.text+' </div>';
	    return $(ra);
	 }
	$(function() {
		$('#kr').click(function() {
			if ($(this).data('action') == 'save') {
				var url = '<?= base_url('administrator/soal/'.$this->ubah->encode('save')) ?>';
			}
			else{
				var url = '<?= base_url('administrator/soal/'.$this->ubah->encode('update')) ?>';
			}
			var img = new FormData( $('#form')[0] );
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
		            data : img,
		            contentType : false,
					processData: false,
		            datatype : 'JSON',
		            success : function(data) {
		              var hasil = JSON.parse(data);
		              if(hasil.respon.execute == true){
		                swal('Pesan','Soal tersimpan','success');
		                $('.box-body').load('<?= base_url('administrator/soal/'.$this->ubah->encode('table')) ?>')
		              }
		              else{
		                swal('Error',hasil.respon.message,'error'); 
		              }
		              // swal('s','a','success');
		              // console.log(data);
		            }
		        })
			});	
		})
		$('#back').click(function() {
			$('.box-body').load('<?= base_url('administrator/soal/'.$this->ubah->encode('table')) ?>',function(o,t,tr) {
				// body...
			})
		});



		$('.true').select2();
		$('.materi').select2({
			ajax : {
			    url :'<?= base_url('administrator/soal/').$this->ubah->encode('get_materi') ?>',
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
		              id : item.id_materi,
		              text : item.judul,
		            });
		          });
		          return{ results : result };
		        },
		        cache : true,
		      },
			templateResult : formatData2,
			templateSelection: formatData2,
		});
		$('span.select2-selection.select2-selection--single').css({
	    	'height' : '45px',
	    	'padding-top' : '10px',
	  	});
	  	
	  	$('span.select2-selection__arrow').css({
	    	'margin-top' : '9px',
	  	})
	})
</script>