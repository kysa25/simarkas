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
	$ipp = mysqli_query($koneksi, "SELECT bidang FROM dokumen WHERE bidang = 'IPP'");
	$an = mysqli_query($koneksi, "SELECT bidang FROM dokumen WHERE bidang = 'AN'");
	$p3a = mysqli_query($koneksi, "SELECT bidang FROM dokumen WHERE bidang = 'P3A'");
	$apd = mysqli_query($koneksi, "SELECT bidang FROM dokumen WHERE bidang = 'APD'");
	$inv = mysqli_query($koneksi, "SELECT bidang FROM dokumen WHERE bidang = 'INV'"); 
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
		<script src="assets/demo/Chart.js"></script>
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
                        <h1 class="mt-4">Dashboard</h1>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Jumlah Laporan
                                    </div>
                                    <div class="card-body"><canvas id="myChart" width="" height="auto"></canvas></div>
									<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ["IPP", "AN", "APD", "P3A", "INV"],
				datasets: [{
					label: 'ST',
					backgroundColor: "pink",
    borderWidth: 1,
    data: [
     <?php echo mysqli_num_rows($ipp); ?>,
                    <?php echo mysqli_num_rows($an);?>,
					<?php echo mysqli_num_rows($apd); ?>,
                    <?php echo mysqli_num_rows($p3a);?>,
					<?php echo mysqli_num_rows($inv);?>    
    ]
   }, {
	   label: 'LHP',
	   backgroundColor: "lightblue",
    borderWidth: 1,
    data: [
     <?php echo mysqli_num_rows($ipp); ?>,
                    <?php echo mysqli_num_rows($an);?>,
					<?php echo mysqli_num_rows($apd); ?>,
                    <?php echo mysqli_num_rows($p3a);?>,
					<?php echo mysqli_num_rows($inv);?>    
    ]
   }, {
    label: 'KKA',
	backgroundColor: "lightgreen",
    borderWidth: 1,
    data: [
     <?php echo mysqli_num_rows($ipp); ?>,
                    <?php echo mysqli_num_rows($an);?>,
					<?php echo mysqli_num_rows($apd); ?>,
                    <?php echo mysqli_num_rows($p3a);?>,
					<?php echo mysqli_num_rows($inv);?>
    ]
				}]
			},
			options: {
				scales: {
      
      yAxes: [{
        ticks: {
          min: 0,
          max: 10
        }
      }],
    }
			}
		});
	</script>
                                </div>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-bar-demo1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
