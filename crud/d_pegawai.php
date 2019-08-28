<?php 
include '../sistem/proses.php';
$hapus=$db->delete("pegawai","nip='$_GET[nip]'");
if($hapus){
	echo "<script>alert('Data Berhasil Dihapus')</script>";
	echo "<script>document.location.href='../pegawai'</script>";
}else{
	echo "<script>alert('Gagal Dihapus')</script>";
	echo "<script>document.location.href='../pegawai'</script>";
}
?>