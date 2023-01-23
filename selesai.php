<?php
include "koneksi.php";
$id    = $_GET['id'];
mysqli_query($koneksi,"UPDATE akses SET status = 'selesai'");
?>
<script language="JavaScript">
alert('Izin akses ditutup');
document.location='kaper-akses.php'</script>