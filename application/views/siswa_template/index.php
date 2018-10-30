<div class="section">
              <p class="tri"></p>
               <span class="huruft"><b>PILIH </b></span>
               <span class="huruf1"><b>MATA PELAJARAN</b></span>
       <div class="row pas">
            <?php
            foreach ($model->result() as $key) {
              ?>
              <div class="col-md-3 col-sm-3 col-lg-3 i" data-materi="<?= $key->slug ?>">
               <div class="project">
                 <div class="photo-wrapper">
                  <div class="dmbox"style="padding: 0px;">
                   <div class="project">
                    <div class="photo-wrapper">
                     <div class="photo">
                    <a href="javascript:;"><img class="img-responsive max" src="<?= base_url('siswa_css/') ?>assets/img/mtk.png"/></a>
                    </div>
                    <div class="overlay"></div>
                    </div>
                   </div>
                  </div>
                 </div>
               </div> 
            </div>
              <?php
            }
            ?>
       </div>
    </div>
    <!-- bagian rekomendsi-->
    <div class="section" style="padding-top: 0px;">
        <div class="col-md-12 col-sm-12 " style="margin-left: -16px">
          <p class="tri"></p>
            <span class="huruft"><b>MATERI </b></span>
            <span class="huruf1req hide-sm"><b>DI REKOMENDASIKAN</b></span>
        </div>

      <div class="row pass">
            <div class="col-lg-12 col-sm-12 col-md-12 ">
               <div style="padding-top: 25px;">
                 <label class="segitigareq">1</label>
                 <label class="hurufreq">Batasi Bermain Gadget</label> <br>
               </div>
               <div style="padding-top: 10px;">
                 <label class="segitigareq">2</label>
                 <label class="hurufreq">Berdoa Kepada Allah SWT</label> <br>
               </div>
            </div>
      </div>
    </div>


<script type="text/javascript">
    $('.i').click(function() {
      $('.main').load('<?=base_url('belajar/')?>'+$(this).data('materi'),function(o,t,tr) {
        
      })
      window.history.pushState('','','<?=base_url('belajar/')?>'+$(this).data('materi'));
    })
  </script>