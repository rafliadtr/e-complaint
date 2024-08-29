<?php 
	
	if($_GET['apa']=="pengaduan"){ ?>

<?php 
	$query = mysqli_query($koneksi,"SELECT * FROM complain INNER JOIN akun_user ON 
	complain.id_user=akun_user.id_user WHERE no_antrian='".$_GET['no_antrian']."'");
	$r=mysqli_fetch_assoc($query);
 ?>
<b>Di Laporakan Pada : <?php echo $r['tgl_keluhan']; ?></b><br>

<?php 
	if($r['lampiran']=="kosong"){ ?>
		<img src="../img/noImage.png" width="100">
<?php	}else{ ?>
	<img width="100" src="../img/<?php echo $r['lampiran']; ?>">
<?php }
 ?>


<p><?php echo $r['keluhan']; ?></p>
<p>Status : <?php echo $r['status']; ?></p>

<button><a href="index.php?p=dashboard">Back</a></button>

<?php	}elseif ($_GET['apa']=="tanggapan") { ?>

<?php 
	$query = mysqli_query($koneksi,"SELECT * FROM complain INNER JOIN akun_user ON 
	complain.id_user=akun_user.id_user INNER JOIN tindak_lanjut ON 
	complain.no_antrian=tindak_lanjut.no_antrian INNER JOIN akun_admin ON 
	tindak_lanjut.id_admin=akun_admin.id_admin WHERE tindak_lanjut.no_antrian='".$_GET['no_antrian']."'");
	$r=mysqli_fetch_assoc($query);
 ?>
<h2>Admin <?php echo $r['nama_admin']; ?></h2>
<b>Ditanggapi pada :<?php echo $r['tgl_tanggapan']; ?></b><br>
<?php 
	if($r['lampiran']=="kosong"){ ?>
		<img src="../img/noImage.png" width="100">
<?php	}else{ ?>
	<img width="100" src="../img/<?php echo $r['lampiran']; ?>">
<?php }
 ?>
<p><?php echo $r['keluhan']; ?></p>
<p><?php echo $r['tanggapan']; ?></p>
<p>Status : <?php echo $r['status']; ?></p>

<button><a href="index.php?p=dashboard">Back</a></button>

<?php } ?>