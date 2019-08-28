<?php
include "sistem/proses.php";
if ($_SESSION['status']=="Admin") {
  $showcontent="";
  $showwarning="hidden";
}else{
  $showcontent="hidden";
  $showwarning="";
}
if (isset($_POST['cari'])) {
  $cd ="$_POST[cari_data]";
  $jp ="$_POST[jenis_pencarian]";
}else{
  $cd ="";
  $jp ="";
}
if(isset($_POST['cari'])){
  if ($jp=="notfound" || $cd=="") {
    echo "<script>alert('Salah Satu Data Pencarian Belum Terisi')</script>";
    echo "<script>document.location.href='/penggajian/pegawai'</script>";
  }else{
    $qw=$db->get("pegawai.nip,pegawai.nama,pegawai.tempat_lahir,pegawai.tanggal_lahir,jabatan.nama_jabatan,golongan.golongan,pegawai.status,pegawai.jumlah_anak","pegawai","INNER JOIN golongan on golongan.kode_golongan=pegawai.kode_golongan INNER JOIN jabatan on jabatan.kode_jabatan=pegawai.kode_jabatan WHERE $jp LIKE '%$cd%' order by pegawai.nip asc");
  }
}elseif (isset($_POST['reset'])) {
  $qw=$db->get("pegawai.nip,pegawai.nama,pegawai.tempat_lahir,pegawai.tanggal_lahir,jabatan.nama_jabatan,golongan.golongan,pegawai.status,pegawai.jumlah_anak","pegawai","INNER JOIN golongan on golongan.kode_golongan=pegawai.kode_golongan INNER JOIN jabatan on jabatan.kode_jabatan=pegawai.kode_jabatan order by pegawai.nip asc");
}else{
  $qw=$db->get("pegawai.nip,pegawai.nama,pegawai.tempat_lahir,pegawai.tanggal_lahir,jabatan.nama_jabatan,golongan.golongan,pegawai.status,pegawai.jumlah_anak","pegawai","INNER JOIN golongan on golongan.kode_golongan=pegawai.kode_golongan INNER JOIN jabatan on jabatan.kode_jabatan=pegawai.kode_jabatan order by pegawai.nip asc");
}
$hitungdata = $qw->rowCount();
if ($hitungdata=="0") {
  $tbhidden="hidden";
  $cphidden="";
}else{
  $tbhidden="";
  $cphidden="hidden";
}
if (!isset($_POST['cari'])) {
  $buttonreset="hidden";
}else{
  $buttonreset="";
}
?>
<!-- Judul Halaman -->
<title>Pegawai | SIM Penggajian</title>
<!--breadcrumbs start-->
<body onload="refreshaction()">
  <div id="breadcrumbs-wrapper">
    <!-- Search for small screen -->
    <div class="header-search-wrapper grey lighten-2 hide-on-large-only">
      <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
    </div>
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title">Pegawai</h5>
          <ol class="breadcrumbs">
            <li><a href="home">Dashboard</a>
            </li>
            <li class="active">Pegawai</li>
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
    <div <?php echo $showcontent;?> class="section">
      <form <?php echo $tbhidden;?> action="pegawai" method="POST">
        <select onchange="pencarian_data()" name="jenis_pencarian" id="jenis_pencarian" class="kecilkecil">
          <option value="notfound">== PILIH ==</option>
          <option <?php if($jp=="nip"){echo "selected";}?> value="nip">NIP</option>
          <option <?php if($jp=="nama"){echo "selected";}?> value="nama">Nama</option>
          <option <?php if($jp=="tempat_lahir"){echo "selected";}?> value="tempat_lahir">Tempat Lahir</option>
          <option <?php if($jp=="tanggal_lahir"){echo "selected";}?> value="tanggal_lahir">Tanggal Lahir</option>
          <option <?php if($jp=="nama_jabatan"){echo "selected";}?> value="nama_jabatan">Nama Jabatan</option>
          <option <?php if($jp=="golongan"){echo "selected";}?> value="golongan">Golongan</option>
          <option <?php if($jp=="status"){echo "selected";}?> value="status">Status</option>
          <option <?php if($jp=="jumlah_anak"){echo "selected";}?> value="jumlah_anak">Jumlah Anak</option>
        </select>
        <input required="" value="<?php echo $cd;?>" style="width: 20%;margin-left: 20px;margin-right: 20px;" type="text" name="cari_data" id="cari_data" class="hide-on-med-and-downheader-search-input z-depth-2" placeholder="Masukkan Datamu Disini.." />
        <button class="btn waves-effect waves-light" type="submit" name="cari"><i class="material-icons right">search</i> Cari</button>
        <a <?php echo $buttonreset;?>><button class="btn waves-effect waves-light" type="submit" name="reset"><i class="material-icons right">format_clear</i> Reset</button></a>
      </form>
      <a href="input_pegawai" class="waves-effect waves-light btn right"><i class="material-icons left">center_focus_weak</i> Tambah</a>
      <p><div class="divider"></div></p>
      <!-- Caption Ketika Data Sedang Kosong -->
      <p <?php echo $cphidden;?> class="caption">Data Sedang Kosong!</p>
      <!-- Tampil Data pegawai -->
      <table class="centered striped" <?php echo $tbhidden;?>>
        <thead>
          <tr>
            <th>NIP</th>
            <th>Nama</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Nama Jabatan</th>
            <th>Golongan</th>
            <th>Status</th>
            <th>Jumlah Anak</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach($qw as $tamp_pegawai){
            ?>
            <tr>
              <td><?php echo $tamp_pegawai['nip'];?></td>
              <td><?php echo $tamp_pegawai['nama'];?></td>
              <td><?php echo $tamp_pegawai['tempat_lahir'];?></td>
              <td><?php echo $tamp_pegawai['tanggal_lahir'];?></td>
              <td><?php echo $tamp_pegawai['nama_jabatan'];?></td>
              <td><?php echo $tamp_pegawai['golongan'];?></td>
              <td><?php echo $tamp_pegawai['status'];?></td>
              <td><?php echo $tamp_pegawai['jumlah_anak'];?></td>
              <td>
                <div class="kotak">
                  <a href="index.php?p=input_pegawai&nip=<?php echo $tamp_pegawai['nip'];?>"><img src="images/icon/edit.png"></a>
                  <a href="crud/d_pegawai.php?nip=<?php echo $tamp_pegawai['nip'];?>"><img src="images/icon/hapus.png"></a>
                </div>
              </td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</body>