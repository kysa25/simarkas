<?php 
	session_start();
 
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['otoritas']==""){
		header("location:index.php?pesan=gagal");
	}	
	include 'koneksi.php';
	$username = $_SESSION['username'];
	$query = mysqli_query($koneksi,"select * from user where username like '$username'");
	$hasil = mysqli_fetch_array($query);
	$bidang= $hasil[bidang];
 
	?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>SIMARKAS</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
		<script src="https://kit.fontawesome.com/82fdbaba8f.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">SIMARKAS</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <!--<input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>-->
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="home_s.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link" href="upload-f.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                Upload
                            </a>
							<a class="nav-link" href="list.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-list"></i></div>
                                ST & LHP
                            </a>
							<a class="nav-link" href="akses.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-file-circle-check"></i></div>
                                Akses
                            </a>
							<a class="nav-link" href="status.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-file-circle-check"></i></div>
                                Status
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $_SESSION['otoritas']; ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Upload</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="upload-p.php" method="POST" enctype="multipart/form-data">
									<label style="width:150px;padding-bottom:10px">Bidang</label>
										<input type="text" value="<?php echo $bidang ?>" name="bidang" size="40" readonly="true"><br>
									<label style="width:150px;padding-bottom:10px">Nomor S/ST/ND</label>
										<input type="text" name="st" size="40" required/>
										<input type="date" name="tgl_st" required/><br>
									<label style="width:150px">Judul Penugasan</label>
										<textarea style="vertical-align:middle" name="penugasan" cols="41" rows="3" required> </textarea><br>
									<label style="width:150px;padding:10px 0px">Tanggal Mulai</label>
										<input type="date" name="tgl_mulai" required/><br>
									<label style="width:150px;padding-bottom:10px">Tanggal Selesai</label>
										<input type="date" name="tgl_selesai" required/><br>
										<label style="width:150px;padding-bottom:10px">Ketua Tim</label>
										<input type="text" name="ketua" size="40" required/><br>
									<label style="width:150px;padding-bottom:10px">File pdf</label>
										<input type="file" name="file_st" required/><br>
									<label style="width:150px;padding-bottom:10px">Nomor LHP</label>
										<input type="text" name="no_lhp" size="40" required/>
										<input type="date" name="tgl_lhp" required/><br>
									<label style="width:150px;padding-bottom:10px">File pdf</label>
										<input type="file" name="file_lhp" required/><br>
									<label style="width:150px;padding-bottom:10px">Nomor KKA</label>
										<input type="text" name="no_kka" size="40"/><br>
									<label style="width:150px;padding-bottom:10px">File rar atau zip</label>
										<input type="file" name="file_kka"/><br>
									<label style="width:150px;padding-bottom:10px">File pdf TL</label>
										<input type="file" name="tl"/><br>
											</span>
									<label style="width:150px;padding-bottom:10px"></label>
										<input type="submit" value="Simpan">
									
								</form>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Perwakilan BPKP Provinsi Kepulauan Bangka Belitung</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>