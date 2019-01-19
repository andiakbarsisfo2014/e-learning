<div class="content">
  <?php
  	foreach ($model as $key) {
  		?>
  		<div class="col-md-4">
		  	<div class="box box-default">
			    <div class="box-header with-border">
			      <h3 class="box-title"><?= $key->jenis_pelayanan ?></h3>
			    </div>
			    <div class="box-body">
			      <?= $key->syarat ?>
			    </div>
			  </div>
		  </div>
  		<?php
  	}
  ?>
</div>