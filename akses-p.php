<?php
include "koneksi.php";

$id    = $_GET['id'];
$sql = "INSERT INTO akses (folder, bidang, st, penugasan, file_st, tgl_st, no_lhp, file_lhp, tgl_lhp) SELECT folder, st, penugasan, file_st, tgl_st, no_lhp, file_lhp, tgl_lhp FROM dokumen WHERE id='$id'";
 mysqli_query($koneksi,$sql);
 mysqli_query($koneksi,"UPDATE akses SET status = 'menunggu'");
?>
<script language="JavaScript">
alert('berhasil'); 
document.location='status.php'</script>