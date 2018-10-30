</div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy;<?=date('Y')?> <a href="#">Lab.401</a>, <a href="https://www.facebook.com/aribarji">Andi Akbar</a></strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->

<!-- jQuery UI 1.11.4 -->
<script src="<?=base_url()?>bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Material Design -->
<script src="<?=base_url()?>dist/js/material.min.js"></script>
<script src="<?=base_url()?>dist/js/ripples.min.js"></script>
<script>
    $.material.init();
</script>
<!-- Morris.js charts -->
<script src="<?=base_url()?>bower_components/raphael/raphael.min.js"></script>
<script src="<?=base_url()?>bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?=base_url()?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?=base_url()?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?=base_url()?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?=base_url()?>bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?=base_url()?>bower_components/moment/min/moment.min.js"></script>
<script src="<?=base_url()?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?=base_url()?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?=base_url()?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?=base_url()?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url()?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?=base_url()?>dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url()?>dist/js/demo.js"></script>
<script src="<?=base_url()?>bower_components/PACE/pace.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    Pace.restart()
  $('#guru').click(function() {
    $('.content-wrapper').load('<?=base_url('administrator/guru/'.$this->ubah->encode('index'))?>',function(o,t,tr) {
      if (tr.status != 200) {
        $(this).html('<h1>'+tr.status+'</h1> <h4>'+a.statusText+'</h4>');
      }
    })
    history.pushState('..','..','<?= base_url('administrator/guru/').$this->ubah->encode('index') ?>');
  });
  $('#siswa').click(function() {
    $('.content-wrapper').load('<?=base_url('administrator/siswa/'.$this->ubah->encode('index'))?>',function(o,t,tr) {
      if (tr.status != 200) {
        $(this).html('<h1>'+tr.status+'</h1> <h4>'+a.statusText+'</h4>');
      }
    })
    history.pushState('..','..','<?= base_url('administrator/siswa/').$this->ubah->encode('index') ?>');
  });
  $('#mapel').click(function() {
    $('.content-wrapper').load('<?=base_url('administrator/mata-pelajaran/'.$this->ubah->encode('index'))?>',function(o,t,tr) {
      if (tr.status != 200) {
        $(this).html('<h1>'+tr.status+'</h1> <h4>'+a.statusText+'</h4>');
      }
    })
    history.pushState('..','..','<?= base_url('administrator/mata-pelajaran/').$this->ubah->encode('index') ?>');
  });
  $('#materi').click(function() {
    $('.content-wrapper').load('<?=base_url('administrator/materi/'.$this->ubah->encode('index'))?>',function(o,t,tr) {
      if (tr.status != 200) {
        $(this).html('<h1>'+tr.status+'</h1> <h4>'+a.statusText+'</h4>');
      }
    })
    history.pushState('..','..','<?= base_url('administrator/materi/').$this->ubah->encode('index') ?>');
  });
  $('#man_guru').click(function() {
    $('.content-wrapper').load('<?=base_url('administrator/management/user/guru/'.$this->ubah->encode('index'))?>',function(o,t,tr) {
      if (tr.status != 200) {
        $(this).html('<h1>'+tr.status+'</h1> <h4>'+a.statusText+'</h4>');
      }
    })
    history.pushState('..','..','<?= base_url('administrator/management/user/guru/').$this->ubah->encode('index') ?>');
  });
  $('#man_siswa').click(function() {
    $('.content-wrapper').load('<?=base_url('administrator/management/user/siswa/'.$this->ubah->encode('index'))?>',function(o,t,tr) {
      if (tr.status != 200) {
        $(this).html('<h1>'+tr.status+'</h1> <h4>'+a.statusText+'</h4>');
      }
    })
    history.pushState('..','..','<?= base_url('administrator/management/user/siswa/').$this->ubah->encode('index') ?>');
  });
  $('#soal').click(function() {
    $('.content-wrapper').load('<?=base_url('administrator/soal/'.$this->ubah->encode('index'))?>',function(o,t,tr) {
      if (tr.status != 200) {
        $(this).html('<h1>'+tr.status+'</h1> <h4>'+a.statusText+'</h4>');
      }
    })
    history.pushState('..','..','<?= base_url('administrator/soal/').$this->ubah->encode('index') ?>');
  });
  $('#man_admin').click(function() {
    $('.content-wrapper').load('<?=base_url('administrator/management/user/admin/'.$this->ubah->encode('index'))?>',function(o,t,tr) {
      if (tr.status != 200) {
        $(this).html('<h1>'+tr.status+'</h1> <h4>'+a.statusText+'</h4>');
      }
    })
    history.pushState('..','..','<?= base_url('administrator/management/user/admin/').$this->ubah->encode('index') ?>');
  });
  $('#profile').click(function() {
    $('.content-wrapper').load('<?=base_url('administrator/profile/'.$this->session->userdata('as').'/'.$this->ubah->encode('index'))?>',function(o,t,tr) {
      if (tr.status != 200) {
        $(this).html('<h1>'+tr.status+'</h1> <h4>'+a.statusText+'</h4>');
      }
    })
    history.pushState('..','..','<?= base_url('administrator/profile/'.$this->session->userdata('as').'/').$this->ubah->encode('index') ?>');
  });
  $('li.treeview').click(function() {
    $('li.treeview').removeClass('active');
    $(this).addClass('active');
  })
  })
  
</script>
</body>
</html>