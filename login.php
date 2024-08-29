
<div class="card" style="padding: 50px; width: 40%; margin: 0 auto; margin-top: 10%;">
<h3 style="text-align: center;" class="blue-text"><b>E-Complaint Vokasi</b></h3>


	<form method="POST">
		<div class="input_field">
			<label for="username">Username</label>
			<input id="username" type="text" name="username" required>
		</div>
		<div class="input_field">
			<label for="password">Password</label>
			<input id="password" type="password" name="password" required>
		</div>
		<input type="submit" name="login" value="Login" class="btn blue" style="width: 100%;">
	</form>
</div>
<?php 
	if(isset($_POST['login'])){
		$username = mysqli_real_escape_string($koneksi,$_POST['username']);
		$password = mysqli_real_escape_string($koneksi,($_POST['password']));
	
		$sql = mysqli_query($koneksi,"SELECT * FROM akun_user WHERE username='$username' 
		AND password='$password' ");
		$cek = mysqli_num_rows($sql);
		$data = mysqli_fetch_assoc($sql);
	
		$sql2 = mysqli_query($koneksi,"SELECT * FROM akun_admin WHERE username='$username' 
		AND password='$password' ");
		$cek2 = mysqli_num_rows($sql2);
		$data2 = mysqli_fetch_assoc($sql2);

		if($cek>0){
			session_start();
			$_SESSION['username']=$username;
			$_SESSION['data']=$data;
			$_SESSION['level']='akun_user';
			header('location:user/');
		}
		elseif($cek2>0){
			if($data2['level']=="superadmin"){
				session_start();
				$_SESSION['username']=$username;
				$_SESSION['data']=$data2;
				header('location:superadmin/');
			}
			elseif($data2['level']=="admin"){
				session_start();
				$_SESSION['username']=$username;
				$_SESSION['data']=$data2;
				header('location:admin/');
			}
		}
		else{
			echo "<script>alert('Gagal Login Cek Kembali Data Anda')</script>";
		}

	}
 ?>