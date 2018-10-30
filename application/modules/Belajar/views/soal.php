<div class="section">
  <div class="row" style="padding-right: 9%; padding-left: 9%;">
    <div class="col-md-9 col-8">
      <div>
        <div class="soal">
          <div class="headoal">
            <h3>SOAL-SOAL</h3>
          </div>
          <div class="isi_soal"></div>
        </div>
        <ul class="pagination pagination-info wkt1" style="border-radius: 0px;">
        </ul>
      </div>
    </div>
    <div class="col-md-3 col-3 ket">
      <div class="head1">
          <div class="hwaktu">WAKTU</div>
      </div>
      <div class="wkt">
       <i class="mdi mdi-timer mdi-48px"></i>
       <div class="hwaktu">
         <div class="minute">00</div>
         <div class="secound">00</div>
       </div>
       <span class="mdi mdi-calendar-range" style="color: #e91e63;font-size: 1.5vw"><?= date('d-M-Y') ?></span>
        <button type="button" id="start" class="btn btn-primary btn-round">Mulai</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var myVar;
  var s = 00;
  var m = 1;
  var nomor = 1;
  var posisi = 1;
  var allow = 0;
  var allJawab = [];
  $('#start').click(function() {
    $(this).removeClass('btn-primary');
    $(this).addClass('btn-warning');
    if ($(this).text() == 'Mulai') {
      posisi = 1;
      function_name(posisi)
      myVar = setInterval(start,1000);
      $('#start').text('Selesai');
    }
    else{
      $(this).text('Mulai');
      m = 1;
      s = 0;
      clearInterval(myVar);
      send();
    }
  });
  
  function function_name(pos) {
    posisi = pos;
    var a = $.ajax({
        url : '<?= base_url('get_soal/')?>'+posisi+'/'+'<?=$this->uri->segment(3)?>',
        type : 'GET',
        datatype : 'JSON',
        success : function(data) {
          var a = JSON.parse(data);
          allow = a.respon.model.length;
          if (allow > 0) {
             if (a.respon.execute) {
                $('.wkt1').html('');
                for (var i = 1; i <= parseInt(a.respon.jml); i++) {
                  if (a.respon.current == i) {
                    $('.wkt1').append('  <li class="active page-item"><a href="javascript:void(0);" onclick=function_name("'+i+'") class="page-link pg">'+i+'</a></li>');
                  }
                  else{
                    $('.wkt1').append('  <li class="page-item"><a href="javascript:void(0);" onclick=function_name("'+i+'") class="page-link pg">'+i+'</a></li>');
                  }
                }
                $('.isi_soal').html('');
                for (var b = 0; b < a.respon.model.length; b++) {
                  var img_soal = '';
                  if (a.respon.model[b].img_soal != null) {
                    img_soal = '<img class="gbrjwb" src="<?= base_url('soal/') ?>'+a.respon.model[b].img_soal+'">';
                  }
                  var img_a = '';
                  if (a.respon.model[b].img_a != null) {
                    img_a = '<img class="gbrjwb" src="<?= base_url('soal/') ?>'+a.respon.model[b].img_a+'">';
                  }
                  var img_b = '';
                  if (a.respon.model[b].img_b != null) {
                    img_b = '<img class="gbrjwb" src="<?= base_url('soal/') ?>'+a.respon.model[b].img_b+'">';
                  }
                  var img_c = '';
                  if (a.respon.model[b].img_c != null) {
                    img_c = '<img class="gbrjwb" src="<?= base_url('soal/') ?>'+a.respon.model[b].img_c+'">';
                  }
                  var img_d = '';
                  if (a.respon.model[b].img_d != null) {
                    img_d = '<img class="gbrjwb" src="<?= base_url('soal/') ?>'+a.respon.model[b].img_d+'">';
                  }
                  $('.isi_soal').append('<p class="hsoal"> '+nomor+') '+a.respon.model[b].soal+'</p><div class="form-check jsoal"><label class="form-check-label rd"><input class="form-check-input" type="radio" name="'+a.respon.model[b].id_soal+'" onclick=jawab("'+a.respon.model[b].id_soal+'","A")> A : '+a.respon.model[b].a+'<div class="col-md-4">'+img_a+'</div><span class="circle"><span class="check"></span></span></label></div> <div class="form-check jsoal"><label class="form-check-label rd"><input class="form-check-input" type="radio" name="'+a.respon.model[b].id_soal+'" onclick=jawab("'+a.respon.model[b].id_soal+'","B")> B : '+a.respon.model[b].b+'<div class="col-md-4">'+img_b+'</div><span class="circle"><span class="check"></span></span></label></div> <div class="form-check jsoal"><label class="form-check-label rd"><input class="form-check-input" type="radio" name="'+a.respon.model[b].id_soal+'" onclick=jawab("'+a.respon.model[b].id_soal+'","C")> C : '+a.respon.model[b].c+'<div class="col-md-4">'+img_c+'</div><span class="circle"><span class="check"></span></span></label></div> <div class="form-check jsoal"><label class="form-check-label rd"><input class="form-check-input" type="radio" name="'+a.respon.model[b].id_soal+'" onclick=jawab("'+a.respon.model[b].id_soal+'","D")> D : '+a.respon.model[b].d+'<div class="col-md-4">'+img_d+'</div><span class="circle"><span class="check"></span></span></label></div>');
                  nomor++;
                }
              }
          }
          else{
            $('.isi_soal').html('Soal kosong');
          }
        },
        error : function(data) {
          alert(data);
        }
      })
  }

  function start() {
    if (s > 59) {
      s = 0;
      $('.minute').text(m);
      m++;
    }
    $('.secound').text(s);
    s++
  }

  function jawab(id,jwb) {
    var ob = new Object();
    for (var n = 0; n < allJawab.length; n++) {
      if (allJawab[n].id_soal == id) {
        allJawab.splice(n,1);
      }
    }
    ob.id_soal = id;
    ob.jawaban = jwb;
    allJawab.push(ob);
  }

  function send() {
    $.ajax({
      url : '<?= base_url('kirim_jawaban/'.$this->uri->segment(3)) ?>',
      type : 'POST',
      data : {
        jawaban : allJawab,
      },
      datatype : 'JSON',
      success : function(data) {
        var a = JSON.parse(data);
        if (a.respon.execute) {
          alert('jawaban terkirim');
          $('.main').load('<?= base_url('nilai/test') ?>');
          window.history.pushState('','','<?= base_url('nilai/test') ?>');
        }
        else{
          alert(a.respon.message);
        }
      },
      error : function(data) {
        alert(data);
      }
    })
  }
</script>