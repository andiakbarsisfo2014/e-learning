<div class="section">
	<table class="table">
		<tr>
			<th>Mata Pelajaran</th>
			<th>Materi</th>
			<th>Score</th>
		</tr>
		<?php
		foreach ($model as $key) {
			?>
			<tr>
				<td><?= $key->nama_mapel ?></td>
				<td><?= $key->judul ?></td>
				<td><?= $key->nilai ?></td>
			</tr>
			<?php
		}
		?>
	</table>
</div>