</div> <!-- end main raised -->
    <footer class="footer">
	    <div class="container">
	        <nav class="pull-left">
	            <ul>
					<li>
						<a href="http://www.un-learning.com">
							un-learning
						</a>
					</li>
					<li>
						<a href="http://presentation.creative-tim.com">
						   About Us
						</a>
					</li>
					<li>
						<a href="http://blog.creative-tim.com">
						   Blog
						</a>
					</li>
					<li>
						<a href="http://www.creative-tim.com/license">
							Licenses
						</a>
					</li>
	            </ul>
	        </nav>
	        <div class="copyright pull-right">
	            &copy; 2018, made with <i class="mdi mdi-account"></i> by un-learning for a better web.
	        </div>
	    </div>
	</footer>
</div>
</body>
	<!--   Core JS Files   -->
	
	<script type="text/javascript">
		$('#log').click(function() {
			$('.main').load('<?= base_url('siswa/login') ?>',function(o,t,tr) {
				
			});
			window.history.pushState('','','<?= base_url('siswa/login') ?>')
		});
		$('#score').click(function() {
			$('.main').load('<?= base_url('nilai/test') ?>');
			window.history.pushState('','','<?= base_url('nilai/test') ?>');
		})
	</script>
	<script type="text/javascript" src="<?= base_url('siswa_css/assets/lib/bootstrap/js/bootstrap.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('siswa_css/assets/js/material.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('siswa_css/assets/js/plugins/nouislider.min.js') ?>"></script>
	<!-- <script type="text/javascript" src="<?= base_url('siswa_css/assets/js/bootstrap-datepicker.js') ?>"></script> -->
	<script type="text/javascript" src="<?= base_url('siswa_css/assets/js/material-kit.js') ?>"></script>
	<!-- <script type="text/javascript" src="<?= base_url('siswa_css/assets/js/jquery-3.2.1.min.js') ?>"></script> -->
	<script type="text/javascript" src="<?= base_url('siswa_css/assets/js/bootstrap.bundle.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('siswa_css/assets/js/owl.carousel.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('siswa_css/assets/js/script.js') ?>"></script>
	<!-- <" type="text/javascript"></script> -->
	<!-- <" type="text/javascript"></script> -->
	<!-- <"></script> -->

	<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
	<!-- <" type="text/javascript"></script> -->

	<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
	<!-- <" type="text/javascript"></script> -->

	<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
	<!-- <" type="text/javascript"></script> -->

   <!-- <"></script> -->
    <!-- <"></script> -->
    <!-- Plugins JS -->
    <!-- <"></script> -->
    <!-- Custom JS -->
    <!-- <"></script> -->
</html>