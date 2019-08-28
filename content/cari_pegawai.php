<?php
include '../sistem/proses.php';
$aku = $db->get("pegawai.nip,pegawai.nama,pegawai.status,jabatan.nama_jabatan,jabatan.gaji_pokok,jabatan.tj_jabatan,golongan.golongan,golongan.tj_suami_istri,golongan.tj_anak,pegawai.jumlah_anak","pegawai","INNER JOIN golongan on golongan.kode_golongan=pegawai.kode_golongan INNER JOIN jabatan on jabatan.kode_jabatan=pegawai.kode_jabatan WHERE pegawai.nip='$_POST[nip]'");
$tampl = $aku->fetch();
$hasilnya = array(
	'nip'      		=>  $tampl['nip'],
	'nama'     		=>  $tampl['nama'],
	'status'		=>  $tampl['status'],
	'nama_jabatan'  =>  $tampl['nama_jabatan'],
	'gaji_pokok'    =>  $tampl['gaji_pokok'],
	'tj_jabatan'	=>  $tampl['tj_jabatan'],
	'golongan'  	=>  $tampl['golongan'],
	'tj_suami_istri'=>  $tampl['tj_suami_istri'],
	'tj_anak'		=>  $tampl['tj_anak'],
	'jumlah_anak'	=>  $tampl['jumlah_anak'],);
echo json_encode($hasilnya);
?>