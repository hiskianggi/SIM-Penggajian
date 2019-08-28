<?php
include "../sistem/proses.php";
$bulannya=date('m');
$tahunnya=date('Y');
$cekgaji=$db->get("gaji.nip,gaji.tanggal","gaji","WHERE month(gaji.tanggal)='$bulannya' AND year(gaji.tanggal)='$tahunnya' AND gaji.nip='$_POST[nip]'");
$hitungcekgaji=$cekgaji->rowCount();
if ($hitungcekgaji=="0") {
	$simpan=$db->insert("gaji","'$_POST[no_slip]',
		'$_POST[tanggal]',
		'$_POST[pendapatan_kotor]',
		'$_POST[potongan_ppn]',
		'$_POST[gaji_bersih]',
		'$_POST[nip]',
		'$_POST[kode_petugas]'");
	if($simpan){
		echo "<script>alert('Berhasil Disimpan')</script>";
		echo "<script>window.open('../struk/$_POST[no_slip]')</script>";
		echo "<script>document.location.href='../gaji'</script>";
	}else{
		echo "<script>alert('Gagal Disimpan')</script>";
		echo "<script>document.location.href='../gaji'</script>";
	}
}else{
	echo "<script>alert('Gaji Telah Diberikan!')</script>";
	echo "<script>document.location.href='../gaji'</script>";
}

?>