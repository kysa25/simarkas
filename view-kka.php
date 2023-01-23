<?php
include "koneksi.php";

$id    = mysqli_real_escape_string($koneksi,$_GET['id']);
$query = mysqli_query($koneksi,"SELECT * FROM dokumen WHERE id='$id' ");
$data  = mysqli_fetch_array($query);

//memanggil file yang berada di folder bernama file
$filePath = "D:/simarkas/".$data['bidang']."/".$data['folder']."/".$data['file_kka']."";
if (!file_exists($filePath)) {
    echo "The file $filePath does not exist";
    die();
}
//nama file untuk tampilan
$filename=$_GET['file_kka'];
header("Pragma:public");
header("Expired:0");
header("Cache-Control:must-revalidate");
header("Content-Control:public");
header("Content-Description: File Transfer");
header("Content-Type: $ctype");
header("Content-Disposition:attachment; filename=\"".basename($filePath)."\"");
header("Content-Transfer-Encoding:binary");
header("Content-Length:".filesize($filePath));
flush();
readfile($filePath);
exit();
?>