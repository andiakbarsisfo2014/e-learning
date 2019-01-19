<button type="button" id="add" class="btn bg-olive margin"><i class="fa fa-plus"></i> Tambah</button>
<table class="table" id="tbl">
	<thead>
		<th>No. KK</th>
		<th>Kepala Keluarga</th>
		<th>RT</th>
		<th>RW</th>
		<th>Desa / Kelurahan</th>
		<th>Kecamatan</th>
		<th>Kabuten</th>
		<th>Kode Pos</th>
		<th>Provinsi</th>
		<th>#Tindakan</th>
  	</thead>
</table>
<script type="text/javascript">
	
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
                $('.value').load('<?= base_url('administrator/kartu-keluarga/'.$this->ubah->encode('table')) ?>');
              }
              else{
                swal('Error',hasil.respon.message,'error'); 
              }
            }
          })  
        })
	}

	$(document).ready(function() {
		$('#add').click(function() {
			$('.value').load('<?=base_url('administrator/kartu-keluarga/'.$this->ubah->encode('_form'))  ?>');
		})
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
	        url : '<?=base_url('administrator/kartu-keluarga/'.$this->ubah->encode('get_ajax'))?>',type : 'POST'},
	        columns : [
	    		{'data' : 'no_kk'},
	    		{'data' : 'kepala_keluarga'},
	    		{'data' : 'rt'},
	    		{'data' : 'rw'},
	    		{'data' : 'desa_kelurahan'},
	    		{'data' : 'kec'},
	    		{'data' : 'kab'},
	    		{'data' : 'kode_pos'},
	    		{'data' : 'prov'},
	    		{
	    			'data' : 'url',
	    			'orderable' : false,
	    			'mRender' : function(data) {
	    				return '<a href="javascript:;" onclick=edit("'+data.edit+'")><i class="fa  fa-pencil"></i> Edit</a> <a href="javascript:;" onclick=del("'+data.delete+'")><i class="fa  fa-trash"></i> Delete</a>';
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
</script>