<title>E-Complaint Vokasi</title>
		<link rel="shortcut icon" href="https://ugc.production.linktr.ee/F3jmx8ESiKN63mYAkt2A_15EdXoLI5OxWwJx6">
<h2 style="text-align: center;">Laporan E-Complaint Vokasi</h2>
<table border="2" style="width: 100%; height: 10%;">
	<tr style="text-align: center;">
		<td>No</td>
		<td>Nomor Antrian</td>
		<td>Nama Pelapor</td>
		<td>Nama Admin</td>
		<td>Tanggal Masuk</td>
		<td>Tanggal Ditanggapi</td>
		<td>Status</td>
	</tr>
	<?php 
		include '../conn/koneksi.php';
		$no=1;
		$query = mysqli_query($koneksi,"SELECT * FROM complain INNER JOIN akun_user ON 
		complain.id_user=akun_user.id_user INNER JOIN tindak_lanjut ON 
		tindak_lanjut.no_antrian=complain.no_antrian INNER JOIN akun_admin ON 
		tindak_lanjut.id_admin=akun_admin.id_admin ORDER BY tgl_keluhan DESC");
		while ($r=mysqli_fetch_assoc($query)) { ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $r['no_antrian']; ?></td>
			<td><?php echo $r['nama_user']; ?></td>
			<td><?php echo $r['nama_admin']; ?></td>
			<td><?php echo $r['tgl_keluhan']; ?></td>
			<td><?php echo $r['tgl_tanggapan']; ?></td>
			<td><?php echo $r['status']; ?></td>
		</tr>
	<?php	}
	 ?>
</table>
<script type="text/javascript">
	window.print();
</script>