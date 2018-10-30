<section class="content-header">
  <h1>
    Guru
    <small>Daftar User</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">User</a></li>
    <li class="active">Admin</li>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary box-solid">
	            <div class="box-header with-border">
	              <h3 class="box-title">Data User [Admin]</h3>
	            </div>
	            <div class="box-body">
	            	<button type="button" id="add" class="btn bg-olive margin"><i class="fa fa-plus"></i> Tambah</button>
					<table class="table" id="tbl">
						<thead>
							<th>ID User</th>
							<th>Nama User</th>
							<th>Status User</th>
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
        <h4 class="modal-title">Form Data User</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
	var table;
	$(document).ready(function() {
		$('#add').click(function() {
			$('#modal-success').modal('show');
			$('.modal-body').load('<?=base_url('administrator/management/user/admin/'.$this->ubah->encode('_form'))?>',function(o,t,tr) {
				if (tr.status != 200) {
					$(this).html(o);
				}
			});
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
	        url : '<?=base_url('administrator/management/user/admin/'.$this->ubah->encode('get_ajax'))?>',type : 'POST'},
	        columns : [
        		{'data' : 'id_admin'},
        		{'data' : 'nama_admin'},
        		{
        			'data' : 'active',
        			'orderable' : false,
        			'mRender' : function(active) {
        				if (active == 'true') {
        					return '<small class="label label-success"><i class="fa  fa-check-square-o"></i> Active</small>';
        				}
        				else{
        					return '<small class="label label-warning"><i class="fa  fa-times"></i> Non Active</small>';
        				}
        			}
        		},
        		{
        			'data' : 'url',
        			'orderable' : false,
        			'mRender' : function(data) {
        				return '<a href="javascript:;" onclick=repair("'+data.reset+'") class="btn btn-primary"><i class="fa  fa-recycle"></i> Reset Sandi</a> <a href="javascript:;" onclick=change("'+data.switch+'") class="btn btn-primary"><i class="fa  fa-recycle"></i> Ganti Status</a> <a href="javascript:;" onclick=edit("'+data.edit+'") class="btn btn-warning"><i class="fa  fa-pencil"></i> Edit</a> <a href="javascript:;" onclick=del("'+data.delete+'") class="btn btn-danger"><i class="fa  fa-trash"></i> Delete</a>';
        				// return data.action;
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
	function change(id) {
		swal({
          title: "Perhatian",
          text: "Anda yakin ingin ganti sandi ? ",
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
					var a = JSON.parse(data);
					if (a.respon.execute) {
	                	table.api().ajax.reload();
	                	swal('Message','Data berubah','success');
					}
				},
				error : function (o,t,tr) {
					swal('Error',"#"+o.status+' '+o.statusText,'error');
				}
			}) 
        })
	}

	function repair(id) {
		swal({
          title: "Perhatian",
          text: "Anda yakin ingin ganti sandi ? ",
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
					// var a = JSON.parse(data);
					// if (a.respon.execute) {
	    //             	table.api().ajax.reload();
	    //             	swal('Message',a.respon.message,'success');
					// }
					swal('pems',data,'success');
				},
				error : function (o,t,tr) {
					swal('Error',"#"+o.status+' '+o.statusText,'error');
				}
			}) 
        })
	}
	function edit(id) {
		$('#modal-success').modal('show');
		$('.modal-body').load(id,function(o,t,tr) {
			if (tr.status != 200) {
				$(this).html(o);
			}
		})
	}
	function del(id) {
		swal({
          title: "Perhatian",
          text: "Anda yakin ingin Hapus ? ",
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
					var a = JSON.parse(data);
					if (a.respon.execute) {
	                	table.api().ajax.reload();
	                	swal('Message','Data terhapus','success');
					}
				},
				error : function (o,t,tr) {
					swal('Error',"#"+o.status+' '+o.statusText,'error');
				}
			}) 
        })
	}
</script>