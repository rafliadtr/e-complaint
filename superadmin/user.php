        <div class="row">
          <div class="col s12 m9">
            <h3 class="blue-text"><b>Admin</b></h3>
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
				<th>level</th>
				<th>Opsi</th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
		$no=1;
		$tampil = mysqli_query($koneksi,"SELECT * FROM akun_admin ORDER BY nama_admin ASC");
		while ($r=mysqli_fetch_assoc($tampil)) { ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $r['nama_admin']; ?></td>
			<td><?php echo $r['username']; ?></td>
			<td><?php echo $r['level']; ?></td>
			<td><a class="btn teal modal-trigger" href="#user_edit<?php echo $r['id_admin'] ?>">Edit</a> 
			<a class="red btn" onclick="return confirm('Anda Yakin Ingin Menghapus?')" 
			href="index.php?p=user_hapus&id_admin=<?php echo $r['id_admin'] ?>">Hapus</a></td>

<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
        <!-- Modal Structure -->
        <div id="user_edit<?php echo $r['id_admin'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="blue-text">Edit</h4>
			<form method="POST">
				<div class="col s12 input-field">
					<label for="nama">Nama</label>
					<input hidden type="text" name="id_petugas" value="<?php echo $r['id_admin']; ?>">
					<input id="nama" type="text" name="nama" value="<?php echo $r['nama_admin']; ?>">
				</div>
				<div class="col s12 input-field">
					<label for="username">Username</label>		
					<input id="username" type="text" name="username" value="<?php echo $r['username']; ?>"><br><br>
				</div>
				<div class="col s12 input-field">
					<p>
						<label>
						  <input value="superadmin" class="with-gap" name="level" type="radio" <?php if
						  ($r['level']=="superadmin"){echo "checked";} ?> />
						  <span>Superadmin</span>
						</label>
						<label>
						  <input value="admin" class="with-gap" name="level" type="radio" <?php if
						  ($r['level']=="admin"){echo "checked";} ?> />
						  <span>Admin</span>
						</label>
					</p>
				</div>
				<div class="col s12 input-field">
					<input type="submit" name="Update" value="Simpan" class="btn right">
				</div>
			</form>

			<?php 
				if(isset($_POST['Update'])){
					
					$update=mysqli_query($koneksi,"UPDATE akun_admin SET nama_admin='".$_POST['nama']."',
					username='".$_POST['username']."',level='".$_POST['level']."' WHERE 
					id_admin='".$_POST['id_petugas']."' ");
					if($update){
						echo "<script>alert('Data di Update')</script>";
						echo "<script>location='index.php?p=user'</script>";
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
					<select class="default" name="level" required>
						<option selected disabled="">Pilih Level</option>
						<option value="superadmin">Superadmin</option>
						<option value="admin">Admin</option>
					</select>
				</div>
				<div class="col s12 input-field">
					<input type="submit" name="input" value="Simpan" class="btn right">
				</div>
			</form>

			<?php 
				if(isset($_POST['input'])){
					$password = ($_POST['password']);

					$query=mysqli_query($koneksi,"INSERT INTO akun_admin VALUES (NULL,'".$_POST['nama']."',
					'".$_POST['username']."','".$password."','".$_POST['level']."')");
					if($query){
						echo "<script>alert('Data Ditambahkan')</script>";
						echo "<script>location='index.php?p=user'</script>";
					}
				}
			 ?>
          </div>
          <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>