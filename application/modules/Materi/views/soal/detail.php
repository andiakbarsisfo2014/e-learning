
<table class="table">
	<tr>
		<td colspan="3">
			Detail Soal
		</td>
	</tr>
	<tr>
		<td>Soal</td>
		<td>:</td>
		<td><?= $model->soal ?></td>
	</tr>
	<tr>
		<td>A</td>
		<td>:</td>
		<td>
			<?= $model->a ?>
		</td>
	</tr>
	<tr>
		<td>B</td>
		<td>:</td>
		<td><?= $model->b ?></td>
	</tr>
	<tr>
		<td>C</td>
		<td>:</td>
		<td><?= $model->c ?></td>
	</tr>
	<tr>
		<td>D</td>
		<td>:</td>
		<td><?= $model->d ?></td>
	</tr>
	<tr>
		<td>Jawaban Benar</td>
		<td>:</td>
		<td><?= $model->benar ?></td>
	</tr>
	<tr>
		<td>
			<button type="button" id="back" class="btn btn-danger"><i class="fa fa-backward"></i> Kembali </button>
		</td>
	</tr>
</table>
<script type="text/javascript">
	$('#back').click(function () {
		$('.box-body').load('<?= base_url('administrator/soal/'.$this->ubah->encode('table')) ?>',function(o,t,tr) {
			
		})
	})
</script>