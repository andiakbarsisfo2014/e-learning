<div class="content">
	<div class="box box-default">
	    <div class="box-header with-border">
	      <h3 class="box-title">Daftar Berkas Yang Terbit</h3>
	    </div>
	    <div class="box-body">
	      <table class="table" id="tbl">
	      	<thead>
	      		<th>NO. KK</th>
	      		<th>NO. KTP</th>
	      		<th>NAMA</th>
	      		<th>BERKAS</th>
	      		<th>TANGGAL MASUK</th>
	      		<th>STATUS BERKAS</th>
	      		<th></th>
	      	</thead>
	      </table>
	    </div>
	  </div>
	</div>
</div>
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
        url : '<?=base_url('front/get_ajax')?>',type : 'POST'},
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
        ],
        order : [[1,'asc']],
        rowCallback : function(row,data,iDisplayIndex) {
          var info = this.fnPagingInfo();
          var page = info.iPage;
          var length = info.iLength;
          $('td:eq(0)',row).html();
        }
    });
</script>