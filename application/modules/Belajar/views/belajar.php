 <div class="section">
                <h2 class="centered"><div class="huruf2"><b><?= $model->nama_mapel.' ['.$model->judul.']'; ?></b></div></h2>
       <!--video -->
        <div class="row " style="margin-left: 20px; margin-right: 20px;">
          <div class="col-md-12 col-sm-12 mt mb" style="height:264px;">
            <video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered"
              controls preload="auto" poster="<?= base_url('siswa_css/assets/img/cover.png') ?>" data-setup='{"example_option":true}'>
             <source src="<?= base_url('materi/video/'.$model->video) ?>" type='video/mp4' />//isi dengan directori video yang ingin diputar(mp4)
             <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
            </video>
            <!-- <button class="btn btn-info btn-round tmb"> -->
                <a href="<?= base_url('materi/pdf/'.$model->materi) ?>" target="_blank"  class="btn btn-info btn-round tmb"><i class="mdi mdi-table-edit"></i> Materi</a>
            <!-- </button> -->
            <button class="btn btn-success btn-round tmb" id="lth">
                <i class="mdi mdi-file-pdf"></i> Latihan
            </button>
          </div>
          <div class="col-md-5">
               <div style="padding-top: 0px;">
                   
               </div>
          </div>
        </div>
        <!-- end video -->
      <div class="section">
<script type="text/javascript">
  $('#lth').click(function() {
    $('.main').load('<?= base_url('soal/'.$this->uri->segment(2).'/'.$this->uri->segment(3)) ?>');
    window.history.pushState('','','<?= base_url('soal/'.$this->uri->segment(2).'/'.$this->uri->segment(3)) ?>');
  })
</script>