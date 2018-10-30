<form id="form" enctype="multipart/form-data">
	<label>Foto Profile</label>
		<input type="file" name="img" class="form-control" accept="image/*">
	<div class="form-group">
		<button type="button" id="save" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
	</div>
</form>
<script type="text/javascript">
	$('#save').click(function() {
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
			            url : '<?=base_url('administrator/profile/'.$this->session->userdata('as').'/'.$this->ubah->encode('updateImg'))?>',
			            type : 'POST',
			            data : img,
			            contentType : false,
						processData: false,
			            datatype : 'JSON',
			            success : function(data) {
			              var hasil = JSON.parse(data);
			              if(hasil.respon.execute == true){
			                window.location.reload();
			              }
			              else{
			                swal('Error',hasil.respon.message,'error'); 
			              }
			            }
			          })
		});	
		// console.log($('#form')[0]);
	})
</script>