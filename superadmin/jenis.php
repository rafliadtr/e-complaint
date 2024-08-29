<div class="row">
          <div class="col s12 m9">
            <h3 class="blue-text"><b>Jenis</b></h3>
          </div>  
          <div class="col s12 m3">
            <div class="section"></div>
            <a class="waves-effect waves-light btn modal-trigger blue" href="#modal1">
				<i class="material-icons">add</i></a>
          </div>
        </div>

        <table id="example" class="display responsive-table" style="width:100%">
          <thead>
              <tr>
					<th>No</th>
					<th>Nama Jenis</th>
                	<th>Opsi</th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
		$no=1;
		$query = mysqli_query($koneksi,"SELECT * FROM jns_keluhan ORDER BY nama_jenis ASC");
		while ($r=mysqli_fetch_assoc($query)) { ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $r['nama_jenis']; ?></td>
			<td><a class="btn teal modal-trigger" href="#jenis_edit=<?php echo $r['id_jenis'] ?>">Edit</a>
			<a class="red btn" onclick="return confirm('Anda Yakin Ingin Menghapus?')" 
			href="index.php?p=jenis_hapus&id_jenis=<?php echo $r['id_jenis'] ?>">Hapus</a></td>

<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
        <!-- Modal Structure -->
        <div id="jenis_edit=<?php echo $r['id_jenis'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="blue-text">Edit</h4>
			<form method="POST">
				<div class="col s12 input-field">
					<label for="nama">Nama Jenis</label>
					<input hidden type="text" name="id_jenis" value="<?php echo $r['id_jenis']; ?>">
					<input id="nama" type="text" name="nama" value="<?php echo $r['nama_jenis']; ?>">
				</div>
				<div class="col s12 input-field">
					<input type="submit" name="Update" value="Simpan" class="btn right">
				</div>
			</form>

			<?php 
				if(isset($_POST['Update'])){
					$update=mysqli_query($koneksi,"UPDATE jns_keluhan SET nama_jenis='".$_POST['nama']."' 
					WHERE id_jenis='".$_POST['id_jenis']."' ");
					if($update){
						echo "<script>alert('Data Tersimpan')</script>";
						echo "<script>location='index.php?p=jenis';</script>";
					}
				}
			 ?>
          </div>
          <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->

		</tr>
            <?php  }
             ?>

          </tbody>
        </table>        

        <!-- Modal Structure -->
        <div id="modal1" class="modal">
          <div class="modal-content">
            <h4 class="blue-text">Add</h4>
			<form method="POST">
				<div class="col s12 input-field">
					<label for="nama">Nama Jenis</label>
					<input id="nama" type="text" name="nama" required>
				</div>
				<div class="col s12 input-field">
					<input type="submit" name="simpan" value="Simpan" class="btn right">
				</div>
			</form>

			<?php 
				if(isset($_POST['simpan'])){
					$query=mysqli_query($koneksi,"INSERT INTO jns_keluhan VALUES (NULL,'".$_POST['nama']."')");
					if($query){
						echo "<script>alert('Data Tesimpan')</script>";
						echo "<script>location='index.php?p=jenis';</script>";
					}
				}
			 ?>
          </div>
          <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>