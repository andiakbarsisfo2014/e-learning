
<!-- <div class="col-sm-offset-1 col-sm-8">
	<div class="form-group is-empty">
		<label class="col-sm-2 control-label">Jenis Layanan</label>
		
	</div>
</div> -->
<div class="col-sm-12">
	<div class="col-sm-4">
		<div class="small-box">
			<select class="form-control" id="js_layanan"></select>
		</div>
	</div>
</div>
<table class="table" id="tbl">
	<thead>
		<th>No. KTP</th>
		<th>No. KK</th>
		<th>Nama</th>
		<th>Kepala Keluarga</th>
		<th>#action</th>
  	</thead>
</table>

<script type="text/javascript">
	function formatData (data) {
		if (!data.id) { return data.text; }
		var ra  = '<div><i class="fa fa-map" style="color:#164a0a"></i> '+ data.text +'</div>';
		return $(ra);
	}

	function proses(key,url) {
		$.ajax({
			url : url,
			type : 'POST',
			data : {
				jenis_pelayanan : $('#js_layanan').val(),
				kode_penduduk : key,
			},
			datatype : 'JSON',
			success : function(data) {
				var a = JSON.parse(data);
				if (a.respon.execute) {
					swal('Pesan','Data tersimpan','success');
				}
				else{
					alert(a.respon.message);
				}
			},
			error : function (data) {
				alert(data);
			}
		})
		
	}

	$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };

    table = $('#tbl').dataTable({
    	initComplete : function() {
        var api = this.api();
        $('#tbl_filter input').off('.DT').on('input.DT',function() {
          api.search(this.value).draw();
        })
      },
      oLanguage : {
        sProcessing : "Loadiing..."
      },
      processing : true,
      serverSide : true,
      ajax : {
        url : '<?=base_url('administrator/resi/'.$this->ubah->encode('get_ajax'))?>',type : 'POST'},
        columns : [
    		{'data' : 'no_ktp'},
    		{'data' : 'no_kk'},
    		{'data' : 'nama'},
    		{'data' : 'kepala_keluarga'},
    		{
    			'data' : 'url',
    			'orderable' : false,
    			'mRender' : function(data) {
    				return '<a href="javascript:;" onclick=proses("'+data.key+'","'+data.url+'")><i class="fa  fa-recycle"></i> Proses Resi</a>';
    			}
    		},
          
        ],
        order : [[1,'asc']],
        rowCallback : function(row,data,iDisplayIndex) {
          var info = this.fnPagingInfo();
          var page = info.iPage;
          var length = info.iLength;
          $('td:eq(0)',row).html();
        }
    });

	$('#js_layanan').select2({
		placeholder : '-- Pilih Jenis Layanan --',
		ajax : {
				url :'<?= base_url('administrator/resi/').$this->ubah->encode('get_layanan') ?>',
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
							id : item.id,
							text : item.jenis_pelayanan,
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