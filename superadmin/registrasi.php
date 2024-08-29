        <div class="row">
          <div class="col s12 m9">
            <h3 class="blue-text"><b>User</b></h3>
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
					<th>Nama</th>
					<th>Username</th>
                	<th>Opsi</th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
		$no=1;
		$tampil = mysqli_query($koneksi,"SELECT * FROM akun_user ORDER BY nama_user ASC");
		while ($r=mysqli_fetch_assoc($tampil)) { ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $r['nama_user']; ?></td>
			<td><?php echo $r['username']; ?></td>
			<td><a class="btn teal modal-trigger" href="#regis_edit<?php echo $r['id_user'] ?>">Edit</a> 
			<a class="red btn" onclick="return confirm('Anda Yakin Ingin Menghapus?')"
			href="index.php?p=regis_hapus&id_user=<?php echo $r['id_user'] ?>">Hapus</a></td>

<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
        <!-- Modal Structure -->
        <div id="regis_edit<?php echo $r['id_user'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="blue-text">Edit</h4>
			<form method="POST">
				<div class="col s12 input-field">
					<label for="nama">Nama</label>
					<input hidden type="text" name="id_user" value="<?php echo $r['id_user']; ?>">
					<input id="nama" type="text" name="nama" value="<?php echo $r['nama_user']; ?>">
				</div>
				<div class="col s12 input-field">
					<label for="username">Username</label>		
					<input id="username" type="text" name="username" value="<?php echo $r['username']; ?>"><br><br>
				</div>
				<div class="col s12 input-field">
					<input type="submit" name="Update" value="Simpan" class="btn right">
				</div>
			</form>

			<?php 
				if(isset($_POST['Update'])){
					$update=mysqli_query($koneksi,"UPDATE akun_user SET nama_user='".$_POST['nama']."',
					username='".$_POST['username']."' WHERE 
					id_user='".$_POST['id_user']."' ");
					if($update){
						echo "<script>alert('Data Tersimpan')</script>";
						echo "<script>location='index.php?p=registrasi';</script>";
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
					<label for="nama">Nama</label>
					<input id="nama" type="text" name="nama" required>
				</div>
				<div class="col s12 input-field">
					<label for="username">Username</label>		
					<input id="username" type="text" name="username" required><br><br>
				</div>
				<div class="col s12 input-field">
					<label for="password">Password</label>
					<input id="password" type="password" name="password" required><br><br>
				</div>
				<div class="col s12 input-field">
					<input type="submit" name="simpan" value="Simpan" class="btn right">
				</div>
			</form>

			<?php 
				if(isset($_POST['simpan'])){
					$password = ($_POST['password']);

					$query=mysqli_query($koneksi,"INSERT INTO akun_user VALUES (NULL,'".$_POST['nama']."',
					'".$_POST['username']."','".$password."')");
					if($query){
						echo "<script>alert('Data Tesimpan')</script>";
						echo "<script>location='index.php?p=registrasi';</script>";
					}
				}
			 ?>
          </div>
          <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>