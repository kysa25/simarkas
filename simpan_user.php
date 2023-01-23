<?php include"koneksi.php"; 
$otoritas	=	$_POST["otoritas"];
$bidang		=	$_POST["bidang"];
$username	=	$_POST["username"];
$password	=	$_POST["password"];

if(($otoritas=='')||($bidang=='')||($username=='')||($password=='')){?><script language="JavaScript">
		alert('ada data yang belum terisi'); 
		document.location='admin.php'
		</script> 
<?php  }

else{
		$sql = "INSERT INTO user (otoritas, bidang, username, password) VALUES ('$otoritas','$bidang','$username','$password')";
		mysqli_query($koneksi,$sql); //simpan data judul dahulu untuk mendapatkan id

if($sql)
{ ?>
<script language="JavaScript">
alert('Sukses di simpan'); 
document.location='admin.php'</script><?php }
else 
{ ?>
<script language="JavaScript">
alert('gagal simpan'); 
document.location='admin.php'</script><?php }

}

?>