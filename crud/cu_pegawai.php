<?php
include "../sistem/proses.php";
if ($_POST['status']=="Belum Menikah") {
	$anak="0";
}else{
	$anak=$_POST['jumlah_anak'];
}
if(isset($_POST['simpan'])){
	$simpan=$db->insert("pegawai","'$_POST[nip]',
		'$_POST[nama]',
		'$_POST[tempat_lahir]',
		'$_POST[tanggal_lahir]',
		'$_POST[kode_jabatan]',
		'$_POST[kode_golongan]',
		'$_POST[status]',
		'$anak'");
	if($simpan){
		echo "<script>alert('Berhasil Disimpan')</script>";
		echo "<script>document.location.href='../pegawai'</script>";
	}else{
		echo "<script>alert('Gagal Disimpan')</script>";
		echo "<script>document.location.href='../pegawai'</script>";
	}
}else{
	$edit=$db->update("pegawai","nip='$_POST[nip]',
		nama='$_POST[nama]',
		tempat_lahir='$_POST[tempat_lahir]',
		tanggal_lahir='$_POST[tanggal_lahir]',
		kode_jabatan='$_POST[kode_jabatan]',
		kode_golongan='$_POST[kode_golongan]',
		status='$_POST[status]',
		jumlah_anak='$anak'",
		"nip='$_POST[nip]'" );
	if($edit){
		echo "<script>alert('Berhasil Diedit')</script>";
		echo "<script>document.location.href='../pegawai'</script>";
	}else{
		echo "<script>alert('Gagal Diedit')</script>";
		echo "<script>document.location.href='../pegawai'</script>";
	}
}
?>