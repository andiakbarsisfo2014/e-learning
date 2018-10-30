 <div class="container" style="padding-top: 1%;">
      <div class="row">
        <div class="col-lg-4 col-md-6 ml-auto mr-auto">
          <div class="card card-login" style="background-color: rgba(0, 0, 0, 0.6)">
            <form class="form" id="form" method="" action="">
              <div class="card-header card-header-rose text-center">
                <h4 class="card-title" style="padding:2% 0 4% 0;">MASUK</h4>
              </div>
              <div class="card-body">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="mdi mdi-account-box-outline mdi-24px m"></i>
                    </span>
                  </div>
                  <input type="text" name="username" class="form-control w" placeholder="Username...">
                </div>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="mdi mdi-lock mdi-24px m"></i>
                    </span>
                  </div>
                  <input type="password" name="password" class="form-control w" placeholder="Password...">
                </div>
              </div>
              <div class="footer text-center" style="margin-top: 10%;">
                <button type="button" id="login" class="btn btn-rose">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $('#login').click(function() {
        $.ajax({
          url : '<?= base_url('siswa/validate') ?>',
          type : 'POST',
          data : $('#form').serialize(),
          datatype : 'JSON',
          success : function(data) {
            var a = JSON.parse(data);
            if (!a.respon.execute) {
              alert(a.respon.message);
            }
            else{
              window.location = '<?= base_url() ?>';
            }
          },
          error : function(data) {
            alert(data);
          }
        })
      })
    </script>