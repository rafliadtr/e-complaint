<table class="responsive-table" border="2" style="width: 100%;">
	<tr>
		<td><h4 class="blue-text hide-on-med-and-down"><b>Ajukan Keluhan</b></h4></td>
		<td><h4 class="blue-text hide-on-med-and-down"><b>Riwayat Keluhan</b></h4></td>
	</tr>
	<tr>
	<td style="padding: 20px;">
			<form method="POST" enctype="multipart/form-data">
			<label for="tujuan">Tujuan:</label>
            <select id="tujuan" name="tujuan" placeholder="tujuan" required>
                <option value="">- pilih tujuan -</option>
                <?php
				$sql_tujuan = mysqli_query($koneksi, "SELECT * FROM tjn_keluhan");
				while($tujuan = mysqli_fetch_array($sql_tujuan)){
					echo '<option value="'.$tujuan['id_tujuan'].'">'.$tujuan['nama_unit'].'
					</option>';
				}?>
            </select><br>
            <label for="jenis">Jenis Keluhan:</label>
            <select id="jenis" name="jenis" placeholder="jenis" required>
                <option value="">- pilih jenis -</option>
                <?php
				$sql_jenis = mysqli_query($koneksi, "SELECT * FROM jns_keluhan");
				while($jenis = mysqli_fetch_array($sql_jenis)){
					echo '<option value="'.$jenis['id_jenis'].'">'.$jenis['nama_jenis'].
					'</option>';
				}?>
            </select>

				<textarea class="materialize-textarea"name="keluhan"placeholder="Tulis Keluhan"required></textarea><br><br>
				<label>Gambar</label>
				<input type="file" name="lampiran"><br><br>
				<input type="submit" name="kirim" value="Kirim" class="btn blue">
			</form>
		</td>

		<td>
			
			<table border="3" class="responsive-table striped highlight">
				<tr>
					<td>No</td>
					<td>Antrian</td>
					<td>Nama</td>
					<td>Tanggal Masuk</td>
					<td>Status</td>
					<td>Opsi</td>
				</tr>
				<?php 
					$no=1;
					$sql = "SELECT * FROM complain INNER JOIN akun_user ON complain.id_user=akun_user.id_user
					WHERE complain.id_user='".$_SESSION['data']['id_user']."' 
					ORDER BY complain.no_antrian DESC";
					$pengaduan = mysqli_query($koneksi,$sql);
					
					//echo $sql;
					while ($r=mysqli_fetch_assoc($pengaduan)) { ?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $r['no_antrian']; ?></td>
						<td><?php echo $r['nama_user']; ?></td>
						<td><?php echo $r['tgl_keluhan']; ?></td>
						<td><?php echo $r['status']; ?></td>
						
						<td>
						<?php
						if ($r['status'] == 'proses') {
							echo '<a class="btn grey modal-trigger" href="#tanggapan&id_pengaduan=' 
							. $r['no_antrian'] . '">More</a>';
						} elseif ($r['status'] == 'selesai') {
							echo '<a class="btn blue modal-trigger" href="#tanggapan&id_pengaduan=' 
							. $r['no_antrian'] . '">More</a>';
						}
       					?>
							<a class="btn red" onclick="return confirm('Anda Yakin Ingin Menghapus?')" 
							href="index.php?p=pengaduan_hapus&no_antrian=
							<?php echo $r['no_antrian'] ?>">Hapus</a>
						</td>

<!-- ditanggapi -->
 <!-- buat query memanggil tindak lanjut berdasarkan no antrian dari yang atas-->
 						<?php
 						$query_tindak_lanjut = "SELECT * FROM tindak_lanjut 
                           INNER JOIN akun_admin ON tindak_lanjut.id_admin = akun_admin.id_admin
                           WHERE tindak_lanjut.no_antrian = '" . $r['no_antrian'] . "'";
   						   $result_tindak_lanjut = mysqli_query($koneksi, $query_tindak_lanjut);
   						while ($t = mysqli_fetch_assoc($result_tindak_lanjut)) { ?>
		<div id="tanggapan&id_pengaduan=<?php echo $t['no_antrian'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="blue-text">Detail</h4>
            <div class="col s12">
				<p>No Antrian : <?php echo $t['no_antrian']; ?></p>
            	<p>Dari : <?php echo $r['nama_user']; ?></p>
            	<p>Admin : <?php echo $t['nama_admin']; ?></p>
				<p>Tanggal Masuk : <?php echo $r['tgl_keluhan']; ?></p>
				<p>Tanggal Ditanggapi : <?php echo $t['tgl_tanggapan']; ?></p>
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
				<p><?php echo $t['tanggapan']; ?></p> 
            </div>
          </div>
          <div class="modal-footer col s12">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>
		<?php }
			?>
<!-- ditanggapi -->

					</tr>
				<?php	}
				 ?>
			</table>

		</td>
	</tr>
</table>
<?php 
	
	 if(isset($_POST['kirim'])){
	 	$nik = $_SESSION['data']['id_user'];
	 	$tgl = date('Y-m-d');


	 	$foto = $_FILES['lampiran']['name'];
	 	$source = $_FILES['lampiran']['tmp_name'];
	 	$folder = './../img/';
	 	$listeks = array('jpg','png','jpeg');
	 	$pecah = explode('.', $foto);
	 	$eks = $pecah['1'];
	 	$size = $_FILES['lampiran']['size'];
	 	$nama = date('dmYis').$foto;

		if($foto !=""){
		 	if(in_array($eks, $listeks)){
		 		if($size<=1000000){
					move_uploaded_file($source, $folder.$nama);
					$query = mysqli_query($koneksi,"INSERT INTO complain VALUES (NULL, 
					'$nik', '".$_POST['keluhan']."','$nama', '$tgl', '".$_POST['tujuan']."', 
					'".$_POST['jenis']."', 'proses')");

		 			if($query){
			 			echo "<script>alert('Keluhan Akan Segera di Proses')</script>";
			 			echo "<script>location='index.php';</script>";
		 			}

		 		}
		 		else{
		 			echo "<script>alert('Ukuran Gambar Tidak Lebih Dari 1MB')</script>";
		 		}
		 	}
		 	else{
		 		echo "<script>alert('Format File Tidak Di Dukung')</script>";
		 	}
		}
		else{
			$query = mysqli_query($koneksi,"INSERT INTO complain VALUES (NULL,'$nik',
			'".$_POST['keluhan']."','noImage.png','$tgl','".$_POST['tujuan']."', 
			'".$_POST['jenis']."', 'proses')");
			if($query){
			 	echo "<script>alert('Keluhan Akan Segera Ditanggapi')</script>";
	 			echo "<script>location='index.php';</script>";
 			}
		}

	 }

 ?>