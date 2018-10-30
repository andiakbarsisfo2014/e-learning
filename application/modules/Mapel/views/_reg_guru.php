<form id="form" class="form-horizontal">
	<input type="hidden" name="id_mapel" value="<?=$model->id_mapel?>">
	<div class="form-group">
		<label>Nama Guru</label>
		<select class="form-control" name="nama_guru" style="width: 100%;"></select>
	</div>
	<div class="col-sm-offset-5 col-sm-6">
		<button type="button" id="regs" data-action="save" class="btn btn-primary"><i class="fa fa-save"></i> save</button>
	</div>
</form>
<script type="text/javascript">
	function formatData1 (data) {
		if (!data.id) { return data.text; }
    	var ra  = '<div><i class="fa fa-map" style="color:#164a0a"></i> '+data.text+'</div>';

	    return $(ra);
	 }
	 $('#regs').click(function() {
	 	swal({
          title: "Perhatian",
          text: "Anda yakin data sudah benar ? ",
          type: "warning",
          showCancelButton: true,
          closeOnConfirm: false,
          showLoaderOnConfirm: true
        },function() {
            $.ajax({
            url : '<?=base_url('administrator/mata-pelajaran/'.$this->ubah->encode('reg'))?>',
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
	$('select[name=nama_guru]').select2({
		ajax : {
        url :'<?= base_url('administrator/mata-pelajaran/').$this->ubah->encode('get_guru') ?>',
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
              id : item.id_guru,
              text : item.nama_guru,
            });
          });
          return{ results : result };
        },
        cache : true,
      },
      templateResult : formatData1,
      templateSelection: formatData1,
  	});


  	$('span.select2-selection.select2-selection--single').css({
	    'height' : '45px',
	    'padding-top' : '10px',
	});
	  $('span.select2-selection__arrow').css({
	    'margin-top' : '9px',
	  })
</script>