<?php
include "koneksi.php";
$id    = $_GET['id'];
mysqli_query($koneksi,"UPDATE akses SET status = 'ditolak'");
?>
<script language="JavaScript">
alert('Izin akses ditolak');
document.location='kaper-akses.php'</script>