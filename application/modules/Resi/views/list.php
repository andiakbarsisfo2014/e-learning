<table class="table" id="tbl">
	<thead>
		<th>No. KK</th>
		<th>No. KTP</th>
		<th>Nama</th>
		<th>Berkas</th>
		<th>Tanggal</th>
		<th>Status Berkas</th>
		<th>#action </th>
	</thead>
</table>
<script type="text/javascript">
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
        url : '<?=base_url('administrator/ambil-berkas/'.$this->ubah->encode('get_berkas/'.$kondisi))?>',type : 'POST'},
        columns : [
    		{'data' : 'no_kk'},
    		{'data' : 'no_ktp'},
    		{'data' : 'nama'},
    		{'data' : 'berkas'},
    		{'data' : 'tgl'},
    		{
    			'data' : 'status',
    			'orderable' : false,
    			'mRender' : function(data) {
    				return data;
    			}
    		},
    		{
    			'data' : 'url',
    			'orderable' : false,
    			'mRender' : function(data) {
    				return '<a href="javascript:;" onclick=update_status("'+data.url+'")><i class="fa fa-pencil"></i> Kirim File </a> <a href="javascript:;" onclick=cetak_("'+data.key+'")><i class="fa fa-print"></i> Cetak Resi </a>';
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

    function cetak_(id) {
    	var page = window.open('<?= base_url('cetak/resi/') ?>'+id);
		page.focus();
		page.print();
    }

    function update_status(id) {
    	$.ajax({
    		url : id,
    		type : 'GET',
    		datatype : 'JSON',
    		success : function(data) {
    			var a = JSON.parse(data);
    			if (a.respon.execute) {
    				 table.api().ajax.reload();
    			}
    			else{
    				alert(a.respon.message);
    			}
    		},
    		error : function(data) {
    			alert(data);
    		}
    	})
    }
</script>