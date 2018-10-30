<div class="section">
	<input type="hidden" name="a" value="0">
   	<div class="head4">
    	<?= $model->nama_mapel ?>
   	</div>
  	<div class="row s4">
	    <div class="value">
	    	
	    </div>
    	<div class="row s2">
      		<div class="btn_pre">
				   			
      		</div>
      		<div class="btn_next">
      			
      		</div>
      	</div> 
  	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		get('first');
	});
	function belajar(id) {
		<?php
			$w = $this->uri->segment(2);
			$a = str_replace('.html','',$w);
		?>
		$('.main').load('<?= base_url('materi/'.$a.'/') ?>'+id);
		 window.history.pushState('','','<?= base_url('materi/'.$a.'/') ?>'+id);
	}
	function get(m) {
		if (m == 'first') {
			var limit = parseInt($('input[name=a]').val());
			var method = 'first';
		}
		else if (m == 'next') {
			var method = 'next';
			var limit = parseInt($('input[name=a]').val() + 10); 
		}
		else if (m == 'pre') {
			var method = 'pre';
			var limit = parseInt($('input[name=a]').val() - 10);
		}
		$.ajax({
			url : '<?= base_url('get_belajar/'.$this->uri->segment(2)) ?>',
			type : 'POST',
			data : {
				posisi : limit , 
				url : '<?= $this->uri->segment(2)?>',
				method : method,
			},
			datatype : 'JSON',
			success : function(data) {
				var a = JSON.parse(data);
				$('input[name=a]').val(a.respon.posisi);
				$('.value').html('');
				for (var i = 0; i < a.respon.model.length; i++) {
					$('.value').append('<button class="btn btn-primary btn-round btn-block" onclick=belajar("'+a.respon.model[i].slug+'")><i class="mdi mdi-file mdi-18px"></i>'+a.respon.model[i].judul+'</button>');
				}
				if (a.respon.show_next) {
					$('.btn_next').html('<button type="button" class="btn btn-primary btn-round btn-block" id="prev" onclick=get("next")>Next</button>')
				}
				else{
					$('.btn_next').html('');
				}

				if (a.respon.show_prev) {
					$('.btn_pre').html('<button type="button" class="btn btn-primary btn-round btn-block" id="prev" onclick=get("pre")>Prev</button>')
				}
				else{
					$('.btn_pre').html('');
				}
			},
			error : function(data) {
				alert(data)
			}
		})
	}
</script>