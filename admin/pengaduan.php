        <div class="row">
          <div class="col s12 m9">
            <h3 class="blue-text"><b>Dalam Proses</b></h3>
          </div>
        </div>

        <table id="example" class="display responsive-table" style="width:100%">
          <thead>
              <tr>
				<th>No</th>
				<th>Antrian</th>
				<th>Nama</th>
				<th>Tanggal Masuk</th>
				<th>Status</th>
				<th>Opsi</th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
		$no=1;
		$query = mysqli_query($koneksi,"SELECT * FROM complain INNER JOIN akun_user ON 
		complain.id_user=akun_user.id_user WHERE complain.status='proses' ORDER BY complain.no_antrian ASC");
		while ($r=mysqli_fetch_assoc($query)) { ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $r['no_antrian']; ?></td>
			<td><?php echo $r['nama_user']; ?></td>
			<td><?php echo $r['tgl_keluhan']; ?></td>
			<td><?php echo $r['status']; ?></td>
			<td><a class="btn modal-trigger blue" href="#more?id_pengaduan=<?php echo $r['no_antrian'] ?>">More</a>  
			<a class="btn red" onclick="return confirm('Anda Yakin Ingin Menghapus?')" 
			href="index.php?p=pengaduan_hapus&no_antrian=<?php echo $r['no_antrian'] ?>">Hapus</a></td>

<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
        <!-- Modal Structure -->
        <div id="more?id_pengaduan=<?php echo $r['no_antrian'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="blue-text">Detail</h4>
            <div class="col s12 m6">
				<p>Antrian : <?php echo $r['no_antrian']; ?></p>
            	<p>Dari : <?php echo $r['nama_user']; ?></p>
				<p>Tanggal Masuk : <?php echo $r['tgl_keluhan']; ?></p>
				<?php 
					if($r['lampiran']=="kosong"){ ?>
						<img src="../img/noImage.png" width="100">
				<?php	}else{ ?>
					<img width="100" src="../img/<?php echo $r['lampiran']; ?>">
				<?php }
				 ?>
				<br><b>Pesan</b>
				<p><?php echo $r['keluhan']; ?></p>
				<p>Status : <?php echo $r['status']; ?></p>
            </div>
            <?php 
            	if($r['status']=="proses"){ ?>
	            <div class="col s12 m6">
					<form method="POST">
						<div class="col s12 input-field">
							<label for="textarea">Tanggapan</label>
							<textarea id="textarea" name="tanggapan" class="materialize-textarea" required></textarea>
						</div>
						<div class="col s12 input-field">
							<input type="submit" name="tanggapi" value="Kirim" class="btn right">
						</div>
					</form>
	            </div>
            <?php	}
             ?>

			<?php 
				if(isset($_POST['tanggapi'])){
					$tgl = date('Y-m-d');
					$query = mysqli_query($koneksi,"INSERT INTO tindak_lanjut VALUES (NULL,
					'".$r['no_antrian']."','".$_SESSION['data']['id_admin']."','".$_POST['tanggapan']."',
					'".$tgl."')");
					if($query){
						$update=mysqli_query($koneksi,"UPDATE complain SET status='selesai' 
						WHERE no_antrian='".$r['no_antrian']."'");
						if($update){
							echo "<script>alert('Tanggapan Terkirim')</script>";
							echo "<script>location='index.php?p=pengaduan';</script>";
						}
					}
				}
			 ?>
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