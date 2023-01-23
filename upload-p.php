<?php
include "koneksi.php";

//pengecekan tipe harus pdf
$tipe_file = $_FILES['file_st']['type']; //mendapatkan mime type
if ($tipe_file == "application/pdf") //mengecek apakah file tersebut pdf atau bukan
{
 $bidang     	= trim($_POST['bidang']);
 $st     		= trim($_POST['st']);		
 $tgl_st     	= trim($_POST['tgl_st']);
 $penugasan     = trim($_POST['penugasan']);
 $tgl_mulai     = trim($_POST['tgl_mulai']);
 $tgl_selesai	= trim($_POST['tgl_selesai']);
 $ketua			= trim($_POST['ketua']);
 $file_st 		= trim($_FILES['file_st']['name']);
 $no_lhp     	= trim($_POST['no_lhp']);		
 $tgl_lhp     	= trim($_POST['tgl_lhp']);
 $file_lhp 		= trim($_FILES['file_lhp']['name']);
 $no_kka     	= trim($_POST['no_kka']);	
 $file_kka 		= trim($_FILES['file_kka']['name']);
 
 $query = mysqli_query($koneksi, "SELECT max(folder) as kodeTerbesar FROM dokumen");
 $dataKode = mysqli_fetch_array($query);
 $folder = $dataKode['kodeTerbesar'];
 $urutan = substr($folder, 0, 3);
 $urutan++;
 $folder = sprintf("%03s", $urutan);
 
 $sql = "INSERT INTO dokumen (folder, bidang, st, tgl_st, penugasan, tgl_mulai, tgl_selesai, ketua, no_lhp, tgl_lhp, no_kka, file_kka) VALUES ('$folder','$bidang','$st','$tgl_st','$penugasan','$tgl_mulai','$tgl_selesai','$ketua','$no_lhp','$tgl_lhp','$no_kka','$file_kka')";
 mysqli_query($koneksi,$sql); //simpan data dahulu untuk mendapatkan id

 //dapatkan id terakhir
 $query = mysqli_query($koneksi,"SELECT id FROM dokumen ORDER BY id DESC LIMIT 1");
 $data  = mysqli_fetch_array($query);

//mengganti nama pdf
 $baru_st = "st_".$data['id'].".pdf"; //hasil contoh: file_1.pdf
 $baru_lhp = "lhp_".$data['id'].".pdf";
 $temp_st = $_FILES['file_st']['tmp_name']; //data temp yang di upload
 $temp_lhp = $_FILES['file_lhp']['tmp_name'];
 $temp_kka = $_FILES['file_kka']['tmp_name'];
 $tujuan = mkdir("D:/simarkas/$bidang/$folder",0777,true);  //folder tujuan

 move_uploaded_file($temp_st, "D:/simarkas/$bidang/$folder/$baru_st"); //fungsi upload
 move_uploaded_file($temp_lhp, "D:/simarkas/$bidang/$folder/$baru_lhp");
 move_uploaded_file($temp_kka, "D:/simarkas/$bidang/$folder/$file_kka");
 
 
 //update nama file di database
 mysqli_query($koneksi,"UPDATE dokumen SET file_st ='$baru_st' WHERE id='$data[id]' ");
 mysqli_query($koneksi,"UPDATE dokumen SET file_lhp ='$baru_lhp' WHERE id='$data[id]' ");

 ?>
 <script language="JavaScript">
alert('Berhasil tersimpan');
document.location='list.php'</script>
<?php
 }
 else

{?>
<script language="JavaScript">
alert('Gagal Upload File Bukan PDF');
document.location='upload-f.php'</script>
<?php
}

?>