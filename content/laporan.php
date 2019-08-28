<?php
include "sistem/proses.php";
if ($_SESSION['status']=="Admin" || $_SESSION['status']=="Manager") {
  $showcontent="";
  $showwarning="hidden";
}else{
  $showcontent="hidden";
  $showwarning="";
}
if (isset($_POST['cari'])) {
  $bulan ="$_POST[bulan]";
}else{
  $bulan ="";
}
$tahun=date('Y');
if (isset($_POST['cari'])) {
  if ($bulan=="") {
    echo "<script>alert('Salah Satu Data Pencarian Belum Terisi')</script>";
    echo "<script>document.location.href='/penggajian/laporan'</script>";
  }else{
    $qw=$db->get("pegawai.nip,gaji.no_slip,gaji.tanggal,pegawai.nama,jabatan.nama_jabatan,jabatan.tj_jabatan,golongan.tj_suami_istri,golongan.tj_anak,gaji.pendapatan,gaji.potongan,gaji.gaji_bersih","pegawai","INNER JOIN gaji on gaji.nip=pegawai.nip INNER JOIN jabatan on jabatan.kode_jabatan=pegawai.kode_jabatan INNER JOIN golongan on golongan.kode_golongan=pegawai.kode_golongan WHERE month(gaji.tanggal)='$_POST[bulan]' AND year(gaji.tanggal)='$tahun' ORDER BY gaji.no_slip ASC");
  }
}elseif (isset($_POST['print'])) {
  echo "<script>window.open('content/cetak_laporan.php?bulan=$_POST[bulan]&tahun=$tahun')</script>";
  echo "<script>document.location.href='index.php?p=laporan'</script>";
}elseif (isset($_POST['reset'])) {
  $qw=$db->get("pegawai.nip,gaji.no_slip,pegawai.nama,jabatan.nama_jabatan,jabatan.tj_jabatan,golongan.tj_suami_istri,golongan.tj_anak,gaji.pendapatan,gaji.potongan,gaji.gaji_bersih","pegawai","INNER JOIN gaji on gaji.nip=pegawai.nip INNER JOIN jabatan on jabatan.kode_jabatan=pegawai.kode_jabatan INNER JOIN golongan on golongan.kode_golongan=pegawai.kode_golongan ORDER BY gaji.no_slip ASC");
  $bulan ="";
}else{
  $qw=$db->get("pegawai.nip,gaji.no_slip,pegawai.nama,jabatan.nama_jabatan,jabatan.tj_jabatan,golongan.tj_suami_istri,golongan.tj_anak,gaji.pendapatan,gaji.potongan,gaji.gaji_bersih","pegawai","INNER JOIN gaji on gaji.nip=pegawai.nip INNER JOIN jabatan on jabatan.kode_jabatan=pegawai.kode_jabatan INNER JOIN golongan on golongan.kode_golongan=pegawai.kode_golongan ORDER BY gaji.no_slip ASC");
}
$hitungdata = $qw->rowCount();
if ($hitungdata=="0") {
  $tbhidden="hidden";
  $cphidden="";
}else{
  $tbhidden="";
  $cphidden="hidden";
}
if ($hitungdata=="0" || !isset($_POST['cari'])) {
  $buttonprint="hidden";
}else{
  $buttonprint="";
}
if (!isset($_POST['cari'])) {
  $buttonreset="hidden";
}else{
  $buttonreset="";
}
?>
<!-- Judul Halaman -->
<title>Laporan | SIM Penggajian</title>
<!--breadcrumbs start-->
<div id="breadcrumbs-wrapper">
  <!-- Search for small screen -->
  <div class="header-search-wrapper grey lighten-2 hide-on-large-only">
   <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
 </div>
 <div class="container">
  <div class="row">
    <div class="col s10 m6 l6">
      <h5 class="breadcrumbs-title">Laporan</h5>
      <ol class="breadcrumbs">
        <li><a href="home">Dashboard</a>
        </li>
        <li class="active">Laporan</li>
      </ol>
    </div>
  </div>
</div>
</div>
<!--breadcrumbs end-->
<!--start container-->
<div class="container">
  <p <?php echo $showwarning;?> class="caption">Anda Tidak Diperbolehkan Mengakses Halaman Ini!</p>
  <div <?php echo $showwarning;?> class="divider"></div>
  <div class="section" <?php echo $showcontent;?>>
    <form <?php echo $tbhidden;?> action="laporan" method="POST">
      <select style="width: 20%;margin-left: 20px;margin-right: 20px;" name="bulan" class="kecilkecil">
        <option value="">== PILIH ==</option>
        <option <?php if($bulan=="01"){echo "selected";}?> value="01">Januari</option>
        <option <?php if($bulan=="02"){echo "selected";}?> value="02">Februari</option>
        <option <?php if($bulan=="03"){echo "selected";}?> value="03">Maret</option>
        <option <?php if($bulan=="04"){echo "selected";}?> value="04">April</option>
        <option <?php if($bulan=="05"){echo "selected";}?> value="05">Mei</option>
        <option <?php if($bulan=="06"){echo "selected";}?> value="06">Juni</option>
        <option <?php if($bulan=="07"){echo "selected";}?> value="07">Juli</option>
        <option <?php if($bulan=="08"){echo "selected";}?> value="08">Agustus</option>
        <option <?php if($bulan=="09"){echo "selected";}?> value="09">September</option>
        <option <?php if($bulan=="10"){echo "selected";}?> value="10">Oktober</option>
        <option <?php if($bulan=="11"){echo "selected";}?> value="12">November</option>
        <option <?php if($bulan=="12"){echo "selected";}?> value="12">Desember</option>
      </select>
      <button style="margin-left: 20px;" class="btn waves-effect waves-light" type="submit" name="cari"><i class="material-icons right">search</i> Cari</button>
      <a <?php echo $buttonprint;?>><button class="btn waves-effect waves-light" type="submit" name="print"><i class="material-icons right">format_clear</i> Cetak</button></a>
      <a <?php echo $buttonreset;?>><button class="btn waves-effect waves-light" type="submit" name="reset"><i class="material-icons right">format_clear</i> Reset</button></a>
    </form><br>
    <p><div class="divider"></div></p>
    <!-- Caption Ketika Data Sedang Kosong -->
    <p <?php echo $cphidden;?> class="caption">Data Kosong!</p>
    <!-- Tampil Data jasa -->
    <table <?php echo $tbhidden;?> class="centered">
      <thead>
        <tr>
          <th>No. Slib</th>
          <th>Nama</th>
          <th>Jabatan</th>
          <th>Tunj. Jabatan</th>
          <th>Tunj. Istri</th>
          <th>Tunj. Anak</th>
          <th>Pendapatan</th>
          <th>Potongan</th>
          <th>Gaji Bersih</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $jml_gk=0;
        $jml_p=0;
        $jml_gb=0;
        foreach($qw as $data_laporan){
          $jml_gk=$jml_gk+$data_laporan['pendapatan'];
          $jml_p=$jml_p+$data_laporan['potongan'];
          $jml_gb=$jml_gb+$data_laporan['gaji_bersih'];
          ?>
          <tr>
            <td><?php echo $data_laporan['no_slip'];?></td>
            <td><?php echo $data_laporan['nama'];?></td>
            <td><?php echo $data_laporan['nama_jabatan'];?></td>
            <td><?php echo "Rp. ". number_format($data_laporan['tj_jabatan'], 2, ",", ".");?></td>
            <td>
              <?php
              $ambilstatus = $db->get("pegawai.status","pegawai","INNER JOIN gaji on gaji.nip=pegawai.nip where pegawai.nip='$data_laporan[nip]'");
              $dataas = $ambilstatus->fetch();
              if ($dataas['status']=="Belum Menikah") {
                echo "Rp. ". number_format("0", 2, ",", ".");
              }else{
                echo "Rp. ". number_format($data_laporan['tj_suami_istri'], 2, ",", ".");
              }
              ?>
            </td>
            <td>
              <?php
              $ambilja = $db->get("pegawai.jumlah_anak","pegawai","INNER JOIN gaji on gaji.nip=pegawai.nip where pegawai.nip='$data_laporan[nip]'");
              $dataja = $ambilja->fetch();
              if ($dataja['jumlah_anak']=="0") {
                echo "Rp. ". number_format("0", 2, ",", ".");
              }else{
                echo "Rp. ". number_format($data_laporan['tj_anak'], 2, ",", ".");
              }
              ?>
            </td>
            <td><?php echo "Rp. ". number_format($data_laporan['pendapatan'], 2, ",", ".");?></td>
            <td><?php echo "Rp. ". number_format($data_laporan['potongan'], 2, ",", ".");?></td>
            <td><?php echo "Rp. ". number_format($data_laporan['gaji_bersih'], 2, ",", ".");?></td>
          </tr>
          <?php
        }
        ?>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td><b>Total :</b></td>
          <td><b><?php echo "Rp. ". number_format($jml_gk, 2, ",", ".");?></b></td>
          <td><b><?php echo "Rp. ". number_format($jml_p, 2, ",", ".");?></b></td>
          <td><b><?php echo "Rp. ". number_format($jml_gb, 2, ",", ".");?></b></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>