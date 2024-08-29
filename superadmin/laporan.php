        <div class="row">
          <div class="col s12 m9">
            <h3 class="blue-text"><b>Laporan</b></h3>
          </div> 
          <div class="col s12 m3">
            <div class="section"></div>
            <a class="waves-effect waves-light btn blue" href="cetak.php">
				<i class="material-icons">print</i></a>
          </div>
        </div>

        <table id="example" class="display responsive-table" style="width:100%">
          <thead>
              <tr>
				<th>No</th>
				<th>Nomor Antrian</th>
				<th>Nama Pelapor</th>
				<th>Nama Admin</th>
				<th>Tanggal Masuk</th>
				<th>Tanggal Ditanggapi</th>
				<th>Status</th>
				<th>Opsi</th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
		$no=1;
		$query = mysqli_query($koneksi,"SELECT * FROM complain INNER JOIN akun_user 
		ON complain.id_user=akun_user.id_user INNER JOIN tindak_lanjut 
		ON tindak_lanjut.no_antrian=complain.no_antrian INNER JOIN akun_admin 
		ON tindak_lanjut.id_admin=akun_admin.id_admin ORDER BY tgl_keluhan DESC");
		while ($r=mysqli_fetch_assoc($query)) { ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $r['no_antrian']; ?></td>
			<td><?php echo $r['nama_user']; ?></td>
			<td><?php echo $r['nama_admin']; ?></td>
			<td><?php echo $r['tgl_keluhan']; ?></td>
			<td><?php echo $r['tgl_tanggapan']; ?></td>
			<td><?php echo $r['status']; ?></td>
			<td><a class="btn blue modal-trigger" href="#laporan?id_tanggapan=<?php echo 
			$r['id_lanjut'] ?>">More</a></td>

<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
        <!-- Modal Structure -->
        <div id="laporan?id_tanggapan=<?php echo $r['id_lanjut'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="blue-text">Detail</h4>
            <div class="col s12 m6">
				<p>Antrian : <?php echo $r['no_antrian']; ?></p>
            	<p>Dari : <?php echo $r['nama_user']; ?></p>
            	<p>Admin : <?php echo $r['nama_admin']; ?></p>
				<p>Tanggal Masuk : <?php echo $r['tgl_keluhan']; ?></p>
				<p>Tanggal Ditanggapi : <?php echo $r['tgl_tanggapan']; ?></p>
				<?php 
					if($r['lampiran']=="kosong"){ ?>
						<img src="../img/noImage.png" width="100">
				<?php	}else{ ?>
					<img width="100" src="../img/<?php echo $r['lampiran']; ?>">
				<?php }
				 ?>
				<br><b>Pesan</b>
				<p><?php echo $r['keluhan']; ?></p>
				<br><b>Respon</b>
				<p><?php echo $r['tanggapan']; ?></p>
            </div>
          </div>
          <div class="modal-footer col s12">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->

		</tr>
            <?php  }
             ?>

          </tbody>
        </table>        