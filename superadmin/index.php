<?php 
	session_start();
	include '../conn/koneksi.php';
	if(!isset($_SESSION['username'])){
		header('location:../index.php');
	}
	elseif($_SESSION['data']['level'] != "superadmin"){
		header('location:../index.php');
	}
 ?>
  <!DOCTYPE html>
  <html>
    <head>
    	<title>E-Complaint Vokasi</title>
		<link rel="shortcut icon" href="https://ugc.production.linktr.ee/F3jmx8ESiKN63mYAkt2A_15EdXoLI5OxWwJx6">
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>

      <!-- Compiled and minified CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

      <!-- Compiled and minified JavaScript -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
      
      
      <script type="text/javascript">
        $(document).ready( function () {
          $('#example').DataTable();
          $('select').formSelect();
        } );
      
      </script>

    </head>

    <body style="background:url(../img/bg4.jpg); background-size: cover;">

    <div class="row">
      <div class="col s12 m3">
          <ul id="slide-out" class="sidenav sidenav-fixed">
              <li>
                  <div class="user-view">
                      <div class="background">
                          <img src="../img/bg4.jpg">
                      </div>
                      <a href="#user"><img class="circle" src="https://cdn-icons-png.flaticon.com/512/6596/6596121.png"></a>
                      <a href="#name"><span class="blue-text name"><?php echo ucwords($_SESSION['data']['nama_admin']); ?></span></a>
					  
                  </div>
              </li>
              <li><a href="index.php?p=dashboard"><i class="material-icons">dashboard</i>Dashboard</a></li>
              <li><a href="index.php?p=pengaduan"><i class="material-icons">report</i>Complain</a></li>
              <li><a href="index.php?p=respon"><i class="material-icons">task_alt</i>Selesai</a></li>
			  <li><a href="index.php?p=registrasi"><i class="material-icons">account_box</i>Tambah User</a></li>
              <li><a href="index.php?p=user"><i class="material-icons">security</i>Tambah Admin</a></li>
			  <li><a href="index.php?p=tujuan"><i class="material-icons">add_circle</i>Tambah Tujuan</a></li>
			  <li><a href="index.php?p=jenis"><i class="material-icons">add_box</i>Tambah Jenis</a></li>
			  <li><a href="index.php?p=faq"><i class="material-icons">quiz</i>Tambah FAQ</a></li>
              <li><a href="index.php?p=laporan"><i class="material-icons">book</i>Laporan</a></li>
              <li>
                  <div class="divider"></div>
              </li>
              <li><a class="waves-effect" href="../index.php?p=logout"><i class="material-icons">logout</i>Logout</a></li>
          </ul>

          <a href="#" data-target="slide-out" class="btn sidenav-trigger"><i class="material-icons">menu</i></a>
      </div>

      <div class="col s12 m9">
        
	<?php 
		if(@$_GET['p']==""){
			include_once 'dashboard.php';
		}
		elseif(@$_GET['p']=="dashboard"){
			include_once 'dashboard.php';
		}

		elseif(@$_GET['p']=="registrasi"){
			include_once 'registrasi.php';
		}
		elseif(@$_GET['p']=="regis_input"){
			include_once 'regis_input.php';
		}
		elseif(@$_GET['p']=="regis_edit"){
			include_once 'regis_edit.php';
		}
		elseif(@$_GET['p']=="regis_hapus"){
			$query = mysqli_query($koneksi,"DELETE FROM akun_user WHERE id_user='".$_GET['id_user']."'");
			if($query){
				header('location:index.php?p=registrasi');
			}
		}

		elseif(@$_GET['p']=="pengaduan"){
			include_once 'pengaduan.php';
		}
		elseif(@$_GET['p']=="pengaduan_hapus"){
			$query=mysqli_query($koneksi,"SELECT * FROM complain WHERE no_antrian='".$_GET['no_antrian']."'");
			$data=mysqli_fetch_assoc($query);
			unlink('../img/'.$data['lampiran']);
		if($data['status']=="proses"){
			$delete=mysqli_query($koneksi,"DELETE FROM tindak_lanjut WHERE no_antrian='".$_GET['no_antrian']."'");
        if($delete){
          $delete1=mysqli_query($koneksi,"DELETE FROM complain WHERE no_antrian='".$_GET['no_antrian']."'");
        }
        if($delete1){
				header('location:index.php?p=pengaduan');
        }
		}
		elseif($data['status']=="selesai"){
			$delete=mysqli_query($koneksi,"DELETE FROM complain WHERE no_antrian='".$_GET['no_antrian']."'");
			if($delete){
          $delete1=mysqli_query($koneksi,"DELETE FROM complain WHERE no_antrian='".$_GET['no_antrian']."'");
          if($delete1){
					header('location:index.php?p=pengaduan');
          }
				}	
			}
		}
		
		elseif(@$_GET['p']=="more"){
			include_once 'more.php';
		}

		elseif(@$_GET['p']=="respon"){
			include_once 'respon.php';
		}
		elseif(@$_GET['p']=="tanggapan_hapus"){
			$query=mysqli_query($koneksi,"SELECT * FROM complain WHERE no_antrian='".$_GET['no_antrian']."'");
			$data=mysqli_fetch_assoc($query);
		if($data['status']=="proses"){
			$delete=mysqli_query($koneksi,"DELETE FROM tindak_lanjut WHERE no_antrian='".$_GET['no_antrian']."'");
        if($delete){
          $delete1=mysqli_query($koneksi,"DELETE FROM complain WHERE no_antrian='".$_GET['no_antrian']."'");
        }
        if($delete1){
				header('location:index.php?p=respon');
        }
		}
		elseif($data['status']=="selesai"){
			$delete=mysqli_query($koneksi,"DELETE FROM tindak_lanjut WHERE no_antrian='".$_GET['no_antrian']."'");
			if($delete){
          $delete1=mysqli_query($koneksi,"DELETE FROM complain WHERE no_antrian='".$_GET['no_antrian']."'");
          if($delete1){
					header('location:index.php?p=respon');
          }
				}	
			}
		}

		elseif(@$_GET['p']=="user"){
			include_once 'user.php';
		}
		elseif(@$_GET['p']=="user_input"){
			include_once 'user_input.php';
		}
		elseif(@$_GET['p']=="user_edit"){
			include_once 'user_edit.php';
		}
		elseif(@$_GET['p']=="user_hapus"){
			$query = mysqli_query($koneksi,"DELETE FROM akun_admin WHERE id_admin='".$_GET['id_admin']."'");
			if($query){
				header('location:index.php?p=user');
			}
		}

		elseif(@$_GET['p']=="tujuan"){
			include_once 'tujuan.php';
		}
		elseif(@$_GET['p']=="tujuan_input"){
			include_once 'tujuan_input.php';
		}
		elseif(@$_GET['p']=="tujuan_edit"){
			include_once 'tujuan_edit.php';
		}
		elseif(@$_GET['p']=="tujuan_hapus"){
			$query = mysqli_query($koneksi,"DELETE FROM tjn_keluhan WHERE id_tujuan='".$_GET['id_tujuan']."'");
			if($query){
				header('location:index.php?p=tujuan');
			}
		}

		elseif(@$_GET['p']=="jenis"){
			include_once 'jenis.php';
		}
		elseif(@$_GET['p']=="jenis_input"){
			include_once 'jenis_input.php';
		}
		elseif(@$_GET['p']=="jenis_edit"){
			include_once 'jenis_edit.php';
		}
		elseif(@$_GET['p']=="jenis_hapus"){
			$query = mysqli_query($koneksi,"DELETE FROM jns_keluhan WHERE id_jenis='".$_GET['id_jenis']."'");
			if($query){
				header('location:index.php?p=jenis');
			}
		}

		elseif(@$_GET['p']=="faq"){
			include_once 'faq.php';
		}
		elseif(@$_GET['p']=="faq_input"){
			include_once 'faq_input.php';
		}
		elseif(@$_GET['p']=="faq_edit"){
			include_once 'faq_edit.php';
		}
		elseif(@$_GET['p']=="faq_hapus"){
			$query = mysqli_query($koneksi,"DELETE FROM faq WHERE id_faq='".$_GET['id_faq']."'");
			if($query){
				header('location:index.php?p=faq');
			}
		}

		elseif(@$_GET['p']=="laporan"){
			include_once 'laporan.php';
		}
	 ?>

      </div>


    </div>




      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="../js/materialize.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

      <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
          var elems = document.querySelectorAll('.sidenav');
          var instances = M.Sidenav.init(elems);
        });

        document.addEventListener('DOMContentLoaded', function() {
          var elems = document.querySelectorAll('.modal');
          var instances = M.Modal.init(elems);
        });

      </script>

    </body>
  </html>