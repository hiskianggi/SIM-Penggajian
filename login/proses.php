<?php 
session_start();
include '../sistem/proses.php';
if (isset($_POST['submit'])){
	$kode_petugas = $_POST['kode_petugas'];
	$password_petugas = md5(base64_encode(md5(base64_encode(md5(base64_encode(md5(base64_encode(md5(base64_encode(md5(base64_encode(md5(base64_encode(md5(base64_encode(md5(base64_encode($_POST['password']))))))))))))))))));
	$query = $db->get("*","petugas","WHERE kode_petugas = '$kode_petugas'");
	$dta = $query->fetch();
	$rows = $query->rowCount();
	if($rows == 0){
		echo "<script>alert('Maaf Username Belum Terdaftar')</script>";
		echo "<script>document.location = 'index.php'</script>";
	}else{
		if($password_petugas <> $dta['password']){
			echo "<script>alert('Maaf Password Salah')</script>";
			echo "<script>document.location = 'index.php'</script>";
		}else{
			$_SESSION['nama_petugas'] = $dta['username'];
			$_SESSION['kode_petugas'] = $dta['kode_petugas'];
			$_SESSION['status'] = $dta['status'];
			echo "<script>alert('Berhasil Login')</script>";
			if ($_POST['go'] == "") {
				echo "<script>document.location = '../home'</script>";
			}else{
				$getgo = base64_decode($_POST['go']);
				echo "<script>document.location = '../$getgo'</script>";
			}
		}
	}
}else{

}
?>
