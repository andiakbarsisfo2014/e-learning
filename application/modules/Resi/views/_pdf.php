<div style="border: 2px solid black; height: 420px; width: 700px;">
	<div style="float:left; width: 120px; padding-right: 25px;">
		<img src="<?= base_url('logo/gowa.png') ?>" style="height: 120px;">
	</div>
	<div style="float: left; line-height: 15px; width: 520.28px; height: 120px; text-align: center; font-size: 20px;">
		<p>DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</p>
		<p>KABUPATEN GOWA</p>
		<address>Jl. Tumanurung No.2 Tlp. (0411) 881 883 Sungguminasa </address>
	</div>
	<div style="border-top: 2px solid black; float: left; width: 700px;">
		<div style="width: 630px; height: 120px; margin-left: 30px; margin-top: 12px; line-height: 28px;">
			<div>
				<div>
					<i>Nomor Register : <?= $model->nama_berkas.' - '.$model->no_kk ?></i>
				</div>
			</div>
			<div>
				<i>Sudah terima berkas dari : </i>
				<div style="padding-left: 12px;">
					<table>
						<tr>
							<td>Nama</td>
							<td>:</td>
							<td><?= $model->nama ?></td>
						</tr>
						<tr>
							<td>Jenis Dokumen</td>
							<td>:</td>
							<td><?= $model->nama_berkas ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div style="float: left; width: 700px; margin-top: 15px;">
		<div style="float: left; margin-left: 30px; padding-top: 90px;">
			<div>Keterangan:</div>
			<div>1. Warna kuning untuk pemohon</div> 
			<div>2. Warna putih untuk arsip</div>
		</div>
		<div style="float: right; width: 320px;">
			<div>Sungguminasa, <?= date('d-m-Y') ?> </div>
			<div style="text-align: center; padding-top: 29px;">
				Petuga Loket
			</div>
			<div style="text-align: center; padding-top: 55px;">
				<?= $this->session->userdata('nama') ?>
			</div>
		</div>
	</div>
</div>