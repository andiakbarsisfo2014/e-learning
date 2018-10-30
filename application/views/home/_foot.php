</div>
      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  Creative Tim
                </a>
              </li>
              <li>
                <a href="https://creative-tim.com/presentation">
                  About Us
                </a>
              </li>
              <li>
                <a href="http://blog.creative-tim.com">
                  Blog
                </a>
              </li>
              <li>
                <a href="https://www.creative-tim.com/license">
                  Licenses
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, made with <i class="material-icons">favorite</i> by
            <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script type="text/javascript">
    $('li#data_siswa').click(function() {
      $('li.active').removeClass('active');
      $(this).addClass('active');
      window.history.pushState('','','<?=base_url('management/siswa/'.$this->ubah->encode('list'))?>');
      $('div.content').load('<?=base_url('management/siswa/'.$this->ubah->encode('list'))?>',function(o,t,tr) {
        
      })
    })
  </script>
  <script src="<?=base_url('admin_css/')?>assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="<?=base_url('admin_css/')?>assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="<?=base_url('admin_css/')?>assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chartist JS -->
  <script src="<?=base_url('admin_css/')?>assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="<?=base_url('admin_css/')?>assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?=base_url('admin_css/')?>assets/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="<?=base_url('admin_css/')?>assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();

    });
  </script>
</body>

</html>