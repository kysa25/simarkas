<?php
include "koneksi.php";
$id    = $_GET['id'];
mysqli_query($koneksi,"UPDATE akses SET status = 'disetujui'");
?>
<script language="JavaScript">
alert('Izin akses disetujui');
document.location='kaper-akses.php'</script>