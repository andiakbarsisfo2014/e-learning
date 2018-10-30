<button type="button" id="add" class="btn bg-olive margin">
	<i class="fa fa-plus"></i> Soal Teks 
</button>
<table class="table" id="tbl">
	<thead>
		<th>Materi</th>
		<th>Soal</th>
		<th>A</th>
		<th>B</th>
		<th>C</th>
		<th>D</th>
		<th>Act</th>
	</thead>
</table>

<script type="text/javascript">
  var table;
	$('#add').click(function() {
      $('.box-body').load('<?= base_url('administrator/soal/'.$this->ubah->encode('_form')) ?>',function(o,t,tr) {
        
      });
    });

  function ubah(id) {
    $('.box-body').load(id,function(o,t,tr) {
      
    })
  }

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
                    swal('Pesan','terhapus','success');
                    table.api().ajax.reload();
                  }
                  else{
                    swal('Error',hasil.respon.message,'error'); 
                  }
                }
            })
      });
  }

  function detail(id) {
    $('.box-body').load(id,function(o,t,tr) {
      
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
          url : '<?=base_url('administrator/soal/'.$this->ubah->encode('get_ajax'))?>',type : 'POST'},
          columns : [
            {'data' : 'judul'},
            {'data' : 'soal'},
            {
              'data' : 'a',
              'orderable' : false,
              'mRender' : function(data) {
                return data
              }
            },
             {
              'data' : 'b',
              'orderable' : false,
              'mRender' : function(data) {
                return data
              }
            },
             {
              'data' : 'c',
              'orderable' : false,
              'mRender' : function(data) {
                return data
              }
            },
             {
              'data' : 'd',
              'orderable' : false,
              'mRender' : function(data) {
                return data
              }
            }, {
              'data' : 'url',
              'orderable' : false,
              'mRender' : function(data) {
                return '<a href="javascript:;" onclick=ubah("'+data.edit+'")> <i class ="fa fa-pencil"></i> Edit</a> <a href="javascript:;" onclick=del("'+data.delete+'")> <i class ="fa fa-trash"></i> Delete</a> <a href="javascript:;" onclick=detail("'+data.detail+'")> <i class ="fa fa-eye"></i> Detail</a>';
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