<div class="row">
          <div class="col s12 m9">
            <h3 class="blue-text"><b>FAQ</b></h3>
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
					<th>Pertanyaan</th>
                    <th>Jawaban</th>
                	<th>Opsi</th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
		$no=1;
		$query = mysqli_query($koneksi,"SELECT * FROM faq ORDER BY pertanyaan ASC");
		while ($r=mysqli_fetch_assoc($query)) { ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $r['pertanyaan']; ?></td>
            <td><?php echo $r['jawaban']; ?></td>
			<td><a class="btn teal modal-trigger" href="#faq_edit=<?php echo $r['id_faq'] ?>">Edit</a>
			<a class="red btn" onclick="return confirm('Anda Yakin Ingin Menghapus?')" 
			href="index.php?p=faq_hapus&id_faq=<?php echo $r['id_faq'] ?>">Hapus</a></td>

<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
        <!-- Modal Structure -->
        <div id="faq_edit=<?php echo $r['id_faq'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="blue-text">Edit</h4>
			<form method="POST">
				<div class="col s12 input-field">
					<label for="tanya">Pertanyaan</label>
					<input hidden type="text" name="id_faq" value="<?php echo $r['id_faq']; ?>">
					<input id="tanya" type="text" name="tanya" value="<?php echo $r['pertanyaan']; ?>">
				</div>
                <div class="col s12 input-field">
					<label for="jawab">Jawaban</label>
					<input id="jawab" type="text" name="jawab" value="<?php echo $r['jawaban']; ?>">
				</div>
				<div class="col s12 input-field">
					<input type="submit" name="Update" value="Simpan" class="btn right">
				</div>
			</form>

			<?php 
				if(isset($_POST['Update'])){
					$update=mysqli_query($koneksi,"UPDATE faq SET pertanyaan='".$_POST['tanya']."',
                    jawaban='".$_POST['jawab']."'
					WHERE id_faq='".$_POST['id_faq']."' ");
					if($update){
						echo "<script>alert('Data Tersimpan')</script>";
						echo "<script>location='index.php?p=faq';</script>";
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
					<label for="tanya">Pertanyaan</label>
					<input id="tanya" type="text" name="tanya" required>
				</div>
                <div class="col s12 input-field">
					<label for="jawab">Jawaban</label>
					<input id="jawab" type="text" name="jawab" required>
				</div>
				<div class="col s12 input-field">
					<input type="submit" name="simpan" value="Simpan" class="btn right">
				</div>
			</form>

			<?php 
				if(isset($_POST['simpan'])){
                    
					$query=mysqli_query($koneksi,"INSERT INTO faq VALUES (NULL,'".$_POST['tanya']."',
                    '".$_POST['jawab']."')");
					if($query){
						echo "<script>alert('Data Tesimpan')</script>";
						echo "<script>location='index.php?p=faq';</script>";
					}
				}
			 ?>
          </div>
          <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>