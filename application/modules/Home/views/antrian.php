<div class="login-box">
  <div class="login-logo">
    <a href="javascript:;">Silahkan Ambil Antrian</a>
  </div>
  
  <div class="login-box-body">
    <div class="row">
      <div class="col-sm-offset-3 col-sm-8">
        <h3><b id="nomor">Antrian - 1</b></h3>
      </div>
      <div class="col-sm-offset-3 col-sm-6">
        <button type="button" id="cetak" class="btn btn-primary btn-raised btn-block btn-flat"> <i class="fa fa-print"></i> Cetak</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $('#cetak').click(function() {
    // var w;
    // w=window.open();
    // w.document.write(document.getElementsByClassName('ogin-box-body'));
    // w.print();
    // w.close();
    $.ajax({
      url : '<?= base_url('front/getNumber') ?>',
      type : 'GET',
      datatype : 'JSON',
      success : function(data) {
        var a = JSON.parse(data);
        $('#nomor').text('Antrian - '+a.id);
      }
    })
  })
</script>