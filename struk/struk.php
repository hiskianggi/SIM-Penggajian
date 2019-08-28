<?php 
session_start();
if (!isset($_SESSION['nama_ptg']) && $_SESSION['status']=="Manager"){
	header("location:../../login/index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Struk Orderan - <?php echo $_GET['no_slip'];?></title>
	<style type="text/css">
	@font-face{
		font-family:Tahoma;
		src: url(‘http://localhost/laundry/fonts/Tahoma.TTF’);
	}
	.kotak-struk .custom_font{
		font-family:Tahoma;
	}
	.kotak-struk{
		float: left;
		width: 450px;
		height: auto;
	}
	.kotak-struk .head p{
		text-align: center;
	}
	.kotak-struk .head .logo{
		font-weight: bold;
	}
	.kotak-struk .head .logo, .almt, .notelp{
		font-family: 'Tahoma';
		line-height: 15px;
	}
	.kotak-struk .table1{
		margin: 0px 30px;
	}
	.kotak-struk .table1 tr td{
		font-family: 'Tahoma';
		line-height: 25px;
	}
	.kotak-struk .table2{
		margin: 0px 30px;
	}
	.kotak-struk .table2 tr td{
		font-family: 'Tahoma';
		line-height: 25px;
		text-align: center;
	}
	.kotak-struk .table2 tr th{
		font-family: 'Tahoma';
		line-height: 25px;
		text-align: center;
	}
	.kotak-struk .table4{
		float: right;
		margin: 0px 30px;
	}
	.kotak-struk .table4 tr td{
		text-align: right;
	}
	.kotak-struk .foot{
		float: left;
		text-align: center;
		line-height: 10px;
		margin: 0px 40px ;
		margin-top: 10px;
		font-family: 'Tahoma';
		line-height: 10px;
	}
</style>
</head>
<body>
	<div class="kotak-struk custom_font">
		<div class="head">
			<p class="logo">Slip Gaji</p>
			<p class="almt">PT. Wikrama Techno</p>
		</div>
		<div class="isi">
			<?php
			include '../sistem/proses.php';
			$ad=$db->get("pegawai.nip,gaji.no_slip,pegawai.nama,jabatan.nama_jabatan,jabatan.gaji_pokok,jabatan.tj_jabatan,golongan.tj_suami_istri,golongan.tj_anak,gaji.pendapatan,gaji.potongan,gaji.gaji_bersih","pegawai","INNER JOIN gaji on gaji.nip = pegawai.nip INNER JOIN jabatan on jabatan.kode_jabatan=pegawai.kode_jabatan INNER JOIN golongan on golongan.kode_golongan=pegawai.kode_golongan where gaji.no_slip='$_GET[no_slip]'");
			$gd=$ad->fetch();
			?>
			<table class="table1">
				<tr>
					<td>No : <?php echo $gd['no_slip'];?></td>
					<td>Periode : <?php echo date("m-Y");?></td>
				</tr>
				<tr>
					<td>Nama : <?php echo $gd['nama'];?></td>
					<td>Jabatan : <?php echo $gd['nama_jabatan'];?></td>
				</tr>
				<tr>
					<td colspan="4">
						===========================
					</td>
				</tr>
			</table>
			<table class="table2">
				<tr>
					<td>
						Sistem Pembayaran Transfer
					</td>
					<td>
						Gaji Pokok
					</td>
					<td>:</td>
					<td><?php echo $gd['gaji_pokok'];?></td>
				</tr>
				<tr>
					<td></td>
					<td>Tunj. Jabatan</td>
					<td>:</td>
					<td><?php echo $gd['tj_jabatan'];?></td>
				</tr>
				<tr>
					<td></td>
					<td>Tunj. Istri</td>
					<td>:</td>
					<td>
						<?php
						$ambilstatus = $db->get("pegawai.status","pegawai","INNER JOIN gaji on gaji.nip=pegawai.nip where pegawai.nip='$gd[nip]'");
						$dataas = $ambilstatus->fetch();
						if ($dataas['status']=="Belum Menikah") {
							echo "0";
						}else{
							echo $gd['tj_suami_istri'];
						}
						?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>Tunj. Anak</td>
					<td>:</td>
					<td>
						<?php
						$ambilja = $db->get("pegawai.jumlah_anak","pegawai","INNER JOIN gaji on gaji.nip=pegawai.nip where pegawai.nip='$gd[nip]'");
						$dataja = $ambilja->fetch();
						if ($dataja['jumlah_anak']=="0") {
							echo "0";
						}else{
							echo $gd['tj_anak'];
						}
						?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>Gaji Kotor</td>
					<td>:</td>
					<td><?php echo $gd['pendapatan'];?></td>
				</tr>
				<tr>
					<td></td>
					<td>Potongan</td>
					<td>:</td>
					<td><?php echo $gd['potongan'];?></td>
				</tr>
				<tr>
					<td></td>
					<td>----------------</td>
					<td></td>
					<td>---------</td>
				</tr>
				<tr>
					<td></td>
					<td>Gaji Bersih</td>
					<td>:</td>
					<td><?php echo $gd['gaji_bersih'];?></td>
				</tr>
				<tr>
					<td colspan="4">
						===========================
					</td>
				</tr>
			</table>
			<div class="foot">
				<p style="float: left;font-size: 12px;margin-left: 50px;">
					<b>
						Disetujui Oleh,<br><br>
						<br>
						<br>
						<br>
						<br>
						Joko Agung Sayuto<br><br>
						(CEO)
					</b>
				</p>
				<p style="float: right;font-size: 12px;margin-left: 50px;">
					<b>
						<?php echo date("d-m-Y");?><br><br>
						Diterima Oleh,
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<?php echo $gd['nama'];?><br><br>
					</b>
				</p>
			</div>
		</div>
	</div>
	<audio src="sukses.mp3" autoplay="autoplay" hidden="hidden"></audio>
</body>
</html>
<script type="text/javascript">window.print()</script>