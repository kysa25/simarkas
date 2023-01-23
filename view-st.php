<?php
include "koneksi.php";

$id    = mysqli_real_escape_string($koneksi,$_GET['id']);
$query = mysqli_query($koneksi,"SELECT * FROM dokumen WHERE id='$id' ");
$data  = mysqli_fetch_array($query);

//memanggil file example.pdf yang berada di folder bernama file
$filePath = "D:/simarkas/".$data['bidang']."/".$data['folder']."/".$data['file_st']."";
//$nama_baru = "kka_".$data['id_kka'].".pdf"; //hasil contoh: file_1.pdf
//Membuat kondisi jika file tidak ada
if (!file_exists($filePath)) {
    echo "The file $filePath does not exist";
    die();
}
//nama file untuk tampilan
$filename="".$data['file_st'].".pdf";
header('Content-type:application/pdf');
header('Content-disposition: inline; filename="'.$filename.'"');
header('content-Transfer-Encoding:binary');
header('Accept-Ranges:bytes');
//membaca dan menampilkan file
readfile($filePath);
?>