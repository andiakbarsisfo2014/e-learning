</div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
      </div>
      <strong>Copyright &copy; 2014-2018 <a href="javascript:;">Useless - Dev</a>, <a href="javascript:;">Lab-401</a> </strong> All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script type="text/javascript">

  $('#antrian').click(function() {
    $('.content-wrapper .container').load('<?= base_url('front/antrian') ?>');
    window.history.pushState('','','<?= base_url('front/antrian') ?>');
  })
  $('#terbit').click(function() {
    $('.content-wrapper .container').load('<?= base_url('front/terbit') ?>');
    window.history.pushState('','','<?= base_url('front/terbit') ?>');
  })

  
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Material Design -->
<script src="<?=base_url()?>dist/js/material.min.js"></script>
<script src="<?=base_url()?>dist/js/ripples.min.js"></script>
<script>
    $.material.init();
</script>
<!-- SlimScroll -->
<script src="<?=base_url()?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url()?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url()?>dist/js/demo.js"></script>
</body>
</html>