<button type="button" id="add" class="btn bg-olive margin"><i class="fa fa-plus"></i> Tambah</button>
<table class="table" id="tbl">
	<thead>
		<th>ID Layanan</th>
		<th>Jenis Layanan</th>
		<th>Nama Berkas</th>
		<th>Syarat</th>
		<th>#Tindakan</th>
  	</thead>
</table>
<script type="text/javascript">
	var table;
	$(document).ready(function() {
		$('#add').click(function() {
			$('.value').load('<?=base_url('administrator/layanan/'.$this->ubah->encode('_form'))?>',function(o,t,tr) {
				if (tr.status != 200) {
					$(this).html(o);
				}
			});
		});
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
	        url : '<?=base_url('administrator/layanan/'.$this->ubah->encode('get_ajax'))?>',type : 'POST'},
	        columns : [
	    		{'data' : 'id_pelayanan'},
	    		{'data' : 'jenis_pelayanan'},
	    		{'data' : 'nama_berkas'},
	    		{
	    			'data' : 'syarat',
	    			'orderable' : false,
	    			'mRender' : function(data) {
	    				return data
	    			}
	    		},
	    		{
	    			'data' : 'url',
	    			'orderable' : false,
	    			'mRender' : function(data) {
	    				return '<a href="javascript:;" onclick=view("'+data.detail+'")><i class="fa  fa-eye"></i> Detail</a> <a href="javascript:;" onclick=edit("'+data.edit+'")><i class="fa  fa-pencil"></i> Edit</a> <a href="javascript:;" onclick=del("'+data.delete+'")><i class="fa  fa-trash"></i> Delete</a>';
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
	})
	function edit(id) {
		$('.value').load(id);
	}

	function del(id) {
		swal({
          title: "Perhatian",
          text: "Anda yakin ingin hapus data ? ",
          type: "warning",
          showCancelButton: true,
          closeOnConfirm: false,
          showLoaderOnConfirm: true
        },function() {
            $.ajax({
            url : id,
            type : 'GET',
            datatype : 'JSON',
            success : function(data) {
              var hasil = JSON.parse(data);
              if(hasil.respon.execute == true){
                swal('Success','Data terhapus','success');
                table.api().ajax.reload();
              }
              else{
                swal('Error',hasil.respon.message,'error'); 
              }
            }
          })  
        })
	}

	function view(id) {
		$('.value').load(id);
	}
</script>