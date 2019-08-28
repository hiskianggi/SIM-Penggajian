<?php
include "sistem/proses.php";
if ($_SESSION['status']=="Admin" || $_SESSION['status']=="HDR") {
  $showcontent="";
  $showwarning="hidden";
}else{
  $showcontent="hidden";
  $showwarning="";
}
error_reporting(0);
$Host = "localhost";
$username = "root";
$password = "";
$database = "db_penggajian";
$koneksi = new mysqli( $Host, $username, $password, $database );
$query = "SELECT max(no_slip) as maxKode FROM gaji";
$hasil = mysqli_query($koneksi,$query);
$data = mysqli_fetch_array($hasil);
$kodeSlip = $data['maxKode'];
$noUrut = (int) substr($kodeSlip, 3, 3);
$noUrut++;
$char = "SLB";
$kodeSlip = $char . sprintf("%03s", $noUrut);
      // TGL OTOMATIS
$tgloto = date("Y-m-d");
?>
<!-- Judul Halaman -->
<title>Form Penggajian | SIM Laundry</title>
<!--breadcrumbs start-->
<body>
  <div id="breadcrumbs-wrapper">
    <!-- Search for small screen -->
    <div class="header-search-wrapper grey lighten-2 hide-on-large-only">
      <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
    </div>
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title">Form Penggajian</h5>
          <ol class="breadcrumbs">
            <li><a href="home">Dashboard</a>
            </li>
            <li class="active">Form Penggajian</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!--breadcrumbs end-->
  <div class="container">
    <p <?php echo $showwarning;?> class="caption">Anda Tidak Diperbolehkan Mengakses Halaman Ini!</p>
    <div <?php echo $showwarning;?> class="divider"></div>
    <div <?php echo $showcontent;?> style="margin-left: 20px;" class="section">
      <form action="crud/c_gaji.php" method="POST">
        <input hidden="" value="<?php echo $_SESSION['kode_petugas']; ?>" id="kode_petugas" name="kode_petugas" type="text">
        <table>
          <tr>
            <td>
              <label>No Slip</label>
              <div class="input-field not-allowed">
                <input value="<?php echo $kodeSlip;?>" class="not-allowed" readonly="" id="no_slip" name="no_slip" type="text">
              </div>
            </td>
            <td class="not-allowed">     
              <label class="not-allowed">Tanggal</label>             
              <div class="input-field not-allowed">
                <input value="<?php echo $tgloto;?>" class="not-allowed" readonly="" id="tanggal" name="tanggal" type="text">
              </div>
            </td>
          </tr>
        </table>
        <div id="divider"></div>
        <table>
          <tr>
            <td>
              <label>NIP</label>
              <div class="input-field">
                <!-- Modal Trigger -->
                <input type="button" style="float: right; margin-bottom: -30px;margin-left: -20px;" onclick="$('#modal1').modal('open');" class="btn btn-flat" value="...">
                <input style="float: left;" onkeyup="cari_pegawai()" required="" value="" id="nip" name="nip" type="text">
                <!-- Modal Structure -->
                <div id="modal1" class="modal">
                  <div class="modal-content">
                    <h4>Pilih Pegawai</h4>
                    <table class="centered">
                      <thead>
                        <tr>
                          <th>NIP</th>
                          <th>Nama</th>
                          <th>Jabatan</th>
                          <th>Golongan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $qw=$db->get("pegawai.nip,pegawai.nama,jabatan.nama_jabatan,golongan.golongan","pegawai","INNER JOIN jabatan on jabatan.kode_jabatan=pegawai.kode_jabatan INNER JOIN golongan on golongan.kode_golongan=pegawai.kode_golongan ORDER BY pegawai.nip ASC");
                        foreach($qw as $tamp_pegawai){
                          ?>
                          <tr class="pilihdatapegawai modal-close" data-nip="<?php echo $tamp_pegawai['nip'];?>">
                            <td><?php echo $tamp_pegawai['nip'];?></td>
                            <td><?php echo $tamp_pegawai['nama'];?></td>
                            <td><?php echo $tamp_pegawai['nama_jabatan'];?></td>
                            <td><?php echo $tamp_pegawai['golongan'];?></td>
                          </tr>
                          <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="modal-footer">
                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
                  </div>
                </div>
              </div>
            </td>
            <td class="not-allowed">
              <label class="not-allowed">Nama</label>              
              <div class="input-field not-allowed">
                <input class="not-allowed" readonly="" value="" id="nama" name="nama" type="text">
              </div>
            </td>
            <td class="not-allowed">
              <label class="not-allowed">Status</label>
              <div class="input-field not-allowed">
                <input class="not-allowed" readonly="" id="status" name="status" type="text">
              </div>
            </td>
          </tr>
        </table>
        <table>
          <tr>
            <td class="not-allowed">
              <label class="not-allowed">Nama Jabatan</label>
              <div class="input-field not-allowed">
                <input class="not-allowed" readonly="" id="nama_jabatan" name="nama_jabatan" type="text" value="">
              </div>
            </td>
            <td class="not-allowed">
              <label class="not-allowed">Gaji Pokok</label>
              <div class="input-field not-allowed">
                <input class="not-allowed" readonly="" id="gaji_pokok" name="gaji_pokok" type="text">
              </div>
            </td>
            <td class="not-allowed">
              <label class="not-allowed">Tunjangan Jabatan</label>
              <div class="input-field not-allowed">
                <input class="not-allowed" readonly="" id="tj_jabatan" name="tj_jabatan" type="text">
              </div>
            </td>
          </tr>
          <tr>
            <td class="not-allowed">
              <label class="not-allowed">Nama Golongan</label>
              <div class="input-field not-allowed">
                <input class="not-allowed" readonly="" id="golongan" name="golongan" type="text">
              </div>
            </td>
            <td class="not-allowed">
              <label class="not-allowed">Tunjangan Istri</label>
              <div class="input-field not-allowed">
                <input class="not-allowed" readonly="" id="tj_suami_istri" name="tj_suami_istri" type="text">
              </div>
            </td>
            <td class="not-allowed">
              <label class="not-allowed">Tunjangan Anak</label>
              <div class="input-field not-allowed">
                <input class="not-allowed" readonly="" id="tj_anak" name="tj_anak" type="text">
              </div>
            </td>
          </tr>
          <tr>
            <td class="not-allowed">
              <label class="not-allowed">Jumlah Anak</label>
              <div class="input-field not-allowed">
                <input class="not-allowed" readonly="" id="jumlah_anak" name="jumlah_anak" type="text">
              </div>
            </td>
            <td class="not-allowed">
              <label class="not-allowed">Pendapatan Kotor</label>
              <div class="input-field not-allowed">
                <input class="not-allowed" readonly="" id="pendapatan_kotor" name="pendapatan_kotor" type="text">
              </div>
            </td>
            <td>
            </td>
          </tr>
          <tr>
            <td class="not-allowed">
              <label class="not-allowed">Potongan PPn 10%</label>
              <div class="input-field not-allowed">
                <input class="not-allowed" readonly="" id="potongan_ppn" name="potongan_ppn" type="text">
              </div>
            </td>
            <td class="not-allowed">
              <label class="not-allowed">Gaji Bersih</label>
              <div class="input-field not-allowed">
                <input class="not-allowed" readonly="" id="gaji_bersih" name="gaji_bersih" type="text">
              </div>
            </td>
            <td>                  
              <div class="input-field col s12">
                <button type="submit" style="margin-left: 30px;" class="btn waves-effect waves-light" name="simpan">Simpan</button>
              </div>
            </td>
            <td>

            </td>
          </tr>
        </table>
      </form>
      <p><div class="divider"></div></p>
      <!-- Tampil Data Orderan -->
      <div id="tamp_order"></div>
    </div>
  </div>
</body>