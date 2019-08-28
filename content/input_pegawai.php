<?php
include "sistem/proses.php";
if ($_SESSION['status']=="Admin") {
  $showcontent="";
  $showwarning="hidden";
}else{
  $showcontent="hidden";
  $showwarning="";
}
error_reporting(0);
if(empty($_GET['nip'])) {
  $Host = "localhost";
  $username = "root";
  $password = "";
  $database = "db_penggajian";
  $koneksi = new mysqli( $Host, $username, $password, $database );
  $query = "SELECT max(nip) as maxKode FROM pegawai";
  $hasil = mysqli_query($koneksi,$query);
  $data = mysqli_fetch_array($hasil);
  $nipPegawai = $data['maxKode'];
  $noUrut = (int) substr($nipPegawai, 3, 5);
  $noUrut++;
  $char = "18600";
  $nipPegawai = $char . sprintf("%03s", $noUrut);
  $sub='simpan';
  $aksinya='crud/cu_pegawai.php';
}else{
  $nipPegawai=$_GET['nip'];
  $sub='edit';
  $aksinya='crud/cu_pegawai.php';
}
$qry=$db->get("*","pegawai","WHERE nip='$_GET[nip]'");
$tampq=$qry->fetch();
?>
<!-- Judul Halaman -->
<title>Input Pegawai | SIM Penggajian</title>
<!--breadcrumbs start-->
<div id="breadcrumbs-wrapper">
  <!-- Search for small screen -->
  <div class="header-search-wrapper grey lighten-2 hide-on-large-only">
    <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
  </div>
  <div class="container">
    <div class="row">
      <div class="col s10 m6 l6">
        <h5 class="breadcrumbs-title">Input Pegawai</h5>
        <ol class="breadcrumbs">
          <li><a href="home">Dashboard</a>
          </li>
          <li class="active">Input Pegawai</li>
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
    <p class="caption">Silahkan Isi Semua Form Dengan Benar!</p>
    <div class="divider"></div>
    <!-- Form with placeholder -->
    <div class="col s12 m12 l6">
      <div class="card-panel">
        <h4 class="header2">Input pegawai</h4>
        <div class="row">
          <form action="<?php echo $aksinya;?>" class="col s12" method="POST">
            <div class="row">
              <div class="input-field col s12">
                <input required="" readonly="" value="<?php echo $nipPegawai; ?>" id="nip" name="nip" type="text">
                <label for="nip">NIP</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input required="" onkeypress="return huruf(event)" placeholder="Nama" id="name" name="nama" type="text" value="<?php echo $tampq['nama'];?>">
                <label for="nama">Nama</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input required="" onkeypress="return huruf(event)" name="tempat_lahir" id="tempat_lahir" type="text" value="<?php echo $tampq['tempat_lahir'];?>" placeholder="Tempat Lahir">
                <label for="tempat_lahir">Tempat Lahir</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input required="" placeholder="Tanggal Lahir" id="tanggal_lahir" name="tanggal_lahir" type="date" value="<?php echo $tampq['tanggal_lahir'];?>">
                <label style="margin-top: -20px;" for="nama">Tanggal Lahir</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <select required="" id="kode_jabatan" name="kode_jabatan">
                  <option>--PILIH--</option>
                  <?php
                  $qw=$db->get("*","jabatan","ORDER BY kode_jabatan ASC");
                  foreach ($qw as $tampil) {
                    ?>
                    <option <?php if($tampq['kode_jabatan']==$tampil['kode_jabatan']){echo "selected";}?> value="<?php echo $tampil['kode_jabatan'];?>"><?php echo $tampil['nama_jabatan'];?></option>
                    <?php
                  }
                  ?>
                </select>
                <label for="jabatan">Jabatan</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <select required="" id="kode_golongan" name="kode_golongan">
                  <option>--PILIH--</option>
                  <?php
                  $qw=$db->get("*","golongan","ORDER BY kode_golongan ASC");
                  foreach ($qw as $tampil) {
                    ?>
                    <option <?php if($tampq['kode_golongan']==$tampil['kode_golongan']){echo "selected";}?> value="<?php echo $tampil['kode_golongan'];?>"><?php echo $tampil['golongan'];?></option>
                    <?php
                  }
                  ?>
                </select>
                <label for="golongan">Golongan</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <select onchange="stts()" id="status" name="status">
                  <option>--PILIH--</option>
                  <option <?php if($tampq['status']=="Sudah Menikah"){echo "selected";}?> value="Sudah Menikah">Sudah Menikah</option>
                  <option <?php if($tampq['status']=="Belum Menikah"){echo "selected";}?> value="Belum Menikah">Belum Menikah</option>
                </select>
                <label for="status">Status</label>
              </div>
            </div>
            <div <?php if($tampq['status']=="Belum Menikah" || empty($_GET['nip'])){echo "hidden";}?> class="row" id="jml_anak">
              <div class="input-field col s12">
                <select id="jumlah_anak" name="jumlah_anak">
                  <option value="0" <?php if($tampq['jumlah_anak']=="0"){echo "selected";}?>>0</option>
                  <option <?php if($tampq['jumlah_anak']=="1"){echo "selected";}?>>1</option>
                  <option <?php if($tampq['jumlah_anak']=="2"){echo "selected";}?>>2</option>
                </select>
                <label for="jumlah_anak">Jumlah Anak</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <button class="btn waves-effect waves-light left">Batal
                  <i class="material-icons right">send</i>
                </button>
                <button class="btn waves-effect waves-light right" type="submit" name="<?php echo $sub;?>">Simpan
                  <i class="material-icons right">send</i>
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>