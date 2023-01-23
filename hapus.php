<?php
include "koneksi.php";

$id    = $_GET['id'];
$sql = "DELETE FROM akses WHERE id='$id'";
 mysqli_query($koneksi,$sql); //simpan data dahulu untuk mendapatkan id	
?>
<script language="JavaScript">
alert('berhasil'); 
document.location='list-akses.php'</script>