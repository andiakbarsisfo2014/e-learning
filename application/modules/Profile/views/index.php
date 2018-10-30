<div class="col-sm-offset-3 col-sm-6">
	<div class="box box-widget widget-user-2">
	    <div class="widget-user-header bg-yellow">
	      <div class="widget-user-image">
	        <img class="img-circle" src="<?=base_url('dist/img/').$this->session->userdata('img')?>" alt="User Avatar">
	      </div>
	      <!-- /.widget-user-image -->
	      <h3 class="widget-user-username"><?=$this->session->userdata('nama')?></h3>
	      <h5 class="widget-user-desc"><?=$this->session->userdata('as')?></h5>
	    </div>
	    <div class="box-footer no-padding">
	      <ul class="nav nav-stacked">
	        <li id="img"><a href="javascript:;">Ganti Foto</a></li>
	        <li id="name"><a href="javascript:;">Ganti Nama</a></li>
	      </ul>
	    </div>
	  </div>
</div>
<div class="modal modal-default fade" id="modal-success">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Form Data Profile</h4>
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
	$('#img').click(function() {
		$('#modal-success').modal('show');
		$('.modal-body').load('<?=base_url('administrator/profile/'.$this->session->userdata('as').'/'.$this->ubah->encode('img'))?>',function(o,t,tr) {
			if (tr.status != 200) {
				$(this).html(o);
			}
		})
	})
	$('#name').click(function() {
		$('#modal-success').modal('show');
		$('.modal-body').load('<?=base_url('administrator/profile/'.$this->session->userdata('as').'/'.$this->ubah->encode('name'))?>',function(o,t,tr) {
			if (tr.status != 200) {
				$(this).html(o);
			}
		})
	})
</script>
