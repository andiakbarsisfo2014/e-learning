<section class="content-header">
	<h1>
    	Materi
    	<small>Daftar Materi</small>
  	</h1>
  	<ol class="breadcrumb">
    	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    	<li><a href="#">Materi</a></li>
    	<li class="active">Daftar</li>
  	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary box-solid">
	            <div class="box-header with-border">
	              <h3 class="box-title">Data Materi</h3>
	            </div>
	            <div class="box-body">
	            	<button type="button" id="add" class="btn bg-olive margin"><i class="fa fa-plus"></i> Tambah</button>
					<table class="table" id="tbl">
						<thead>
							<th>Id Materi</th>
							<th>Mata Pelajaran</th>
							<th>Judul</th>
							<th>Materi</th>
							<th>Video</th>
							<th>#Tindakan</th>
		              	</thead>
					</table>
	            </div>
	        </div>
		</div>
	</div>
</section>
<div class="modal modal-default fade" id="modal-success">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Form Data Materi</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	function del(id) {
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
	            url : id,
	            type : 'GET',
	            datatype : 'JSON',
	            success : function(data) {
	            	var hasil = JSON.parse(data);
	              	if(hasil.respon.execute == true){
	              		swal('Pesan','Data tersimpan','success');
	              		$('#modal-success').modal('hide');
	              		table.api().ajax.reload();
	             	}
	              	else{
	                	swal('Error',hasil.respon.message,'error'); 
	              	}
	            }
	        })
		});	
	}
	function pre(id) {
		alert(id);
	}
	$('#add').click(function() {
		$('#modal-success').modal('show');
		$('.modal-body').load('<?=base_url('administrator/materi/'.$this->ubah->encode('_form'))?>');
	})
	function ubah(id) {
		$('#modal-success').modal('show');
		$('.modal-body').load(id,function(o,t,tr) {
			
		})
	}
	$(document).ready(function() {
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
	        url : '<?=base_url('administrator/materi/'.$this->ubah->encode('get_ajax'))?>',type : 'POST'},
	        columns : [
        		{'data' : 'id_materi'},
        		{'data' : 'nama_mapel'},
        		{'data' : 'judul'},
        		{
        			'data' : 'materi',
        			'orderable' : false,
        			'mRender' : function(data) {
        				return '<a href="<?=base_url('materi/pdf/')?>'+data+'" target="blank">'+data+'</a>';
        			}
        		},
        		{
        			'data' : 'video',
        			'orderable' : false,
        			'mRender' : function(data) {
        				return '<a href="<?=base_url('materi/video/')?>'+data+'" target="blank">'+data+'</a>';
        			}
        		},
        		{
        			'data' : 'url',
        			'orderable' : false,
        			'mRender' : function(data) {
        				return "<a href='javascript:;' class='btn btn-warning' onclick=ubah('"+data.edit+"')><i class='fa fa-pencil'></i> Edit</a> <a href='javascript:;' class='btn btn-danger' onclick=del('"+data.delete+"')><i class='fa fa-trash'></i> Delete</a>";
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