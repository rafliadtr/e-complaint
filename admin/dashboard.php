
<h3 class="blue-text"><b>Dashboard</b></h3>

	<div class="row">
		
		<div class="col s4">
		  <div class="card red">
		    <div class="card-content white-text">
			<?php 
				$query = mysqli_query($koneksi,"SELECT * FROM complain WHERE status='proses'");
				$panggil = mysqli_num_rows($query);
				if($panggil<1){
					$panggil=0;
				}
			 ?>
		      <span class="card-title">Keluhan Status Proses<b class="right"><?php echo $panggil; ?></b></span>
		      <p></p>
		    </div>
		  </div>
		</div>	

		<div class="col s4">
		    <div class="card teal">
		    <div class="card-content white-text">
			<?php 
				$query = mysqli_query($koneksi,"SELECT * FROM tindak_lanjut WHERE id_admin=
				'".$_SESSION['data']['id_admin']."'");
				$panggil = mysqli_num_rows($query);
				if($panggil<1){
					$panggil=0;
				}
			 ?>
		      <span class="card-title">Keluhan Ditanggapi <b class="right"><?php echo $panggil; ?></b></span>
		      <p></p>
		    </div>
		  </div>
		</div>
	</div>