<?php
session_start();
 
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['otoritas']==""){
		header("location:index.php?pesan=gagal");
	}	
	include 'koneksi.php';
	$username = $_SESSION['username'];
	$nama_bidang_get=$_GET[nama_bidang];
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
                            <a class="nav-link" href="arsip.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
							<!--Menu Bidang-->
							<?php
							$query_menu_bidang=mysqli_query($koneksi,"SELECT nama_bidang FROM bidang ORDER BY id_bidang ASC");
							while ($tampilmenubidang=mysqli_fetch_array($query_menu_bidang)) { ?>
							<a class="nav-link" href="arsip-list.php?nama_bidang=<?php echo $tampilmenubidang[nama_bidang]; ?>">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-desktop"></i></div>
                                <?php echo $tampilmenubidang[nama_bidang]; ?> 
                            </a>
							<?php } ?>
							<a class="nav-link" href="arsip-akses.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-file-circle-check"></i></div>
                                List Akses
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
                        <h1 class="mt-4">List Dokumen</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Bidang <?php echo $nama_bidang_get ?>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
											<th colspan="2">Nomor S/ST/ND</th>
                                            <th>Tanggal</th>
                                            <th>Penugasan</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th colspan="2">LHP</th>											
                                            <th>KKA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										$query = mysqli_query($koneksi,"SELECT * FROM dokumen where bidang like '$nama_bidang_get' ORDER BY id DESC");
										while($data=mysqli_fetch_array($query))
										{
									?>
										<tr>
											<td><?php echo $data['st'];?></td>
											<td style="text-align:center"><a href="view-st.php?id=<?php echo $data['id'];?>">
											<i class="fa-solid fa-magnifying-glass"></i></a></td>											
											<td><?php echo $data['tgl_st'];?></td>
											<td><?php echo $data['penugasan'];?></td>
											<td><?php echo $data['tgl_mulai'];?></td>
											<td><?php echo $data['tgl_selesai'];?></td>
											<td><?php echo $data['no_lhp'];?>
											<td style="text-align:center"><a href="view-lhp.php?id=<?php echo $data['id'];?>">
											<i class="fa-solid fa-magnifying-glass"></i></a></td>
											<td><a style="text-decoration: none" href="view-kka.php?id=<?php echo $data['id'];?>"><input type="submit" value="Download"></a>
											<?php 
											} ?>
										</tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
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