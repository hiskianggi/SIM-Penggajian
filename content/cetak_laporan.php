<?php
session_start();
include "../sistem/proses.php";
?>
<link rel="stylesheet" type="text/css" href="/simpenjualan/assets/css/style.css">
<title>Laporan Per Bulan</title>
<body style="background-color: #fff;">
  <center>
    <div class="isi-content">
      <div class="judul-content">
        <center>
          <h1>Laporan Per Bulan</h1>
          <h3>Bulan Ke-<?php echo "$_GET[bulan]";?></h3>
        </center>
      </div>
      <br>
      <table class="tabel">
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
          $jml_ta=0;
          $jml_gk=0;
          $jml_p=0;
          $jml_gb=0;
          $qw=$db->get("pegawai.nip,gaji.no_slip,gaji.tanggal,pegawai.nama,jabatan.nama_jabatan,jabatan.tj_jabatan,golongan.tj_suami_istri,golongan.tj_anak,gaji.pendapatan,gaji.potongan,gaji.gaji_bersih","pegawai","INNER JOIN gaji on gaji.nip=pegawai.nip INNER JOIN jabatan on jabatan.kode_jabatan=pegawai.kode_jabatan INNER JOIN golongan on golongan.kode_golongan=pegawai.kode_golongan WHERE month(gaji.tanggal)='$_GET[bulan]' AND year(gaji.tanggal)='$_GET[tahun]' ORDER BY gaji.no_slip ASC");
          foreach($qw as $data_laporan){
            $jml_ta=$jml_ta+$data_laporan['tj_anak'];
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
            <td><b>Total :</b></b></td>
            <td><b><?php echo "Rp. ". number_format($jml_gk, 2, ",", ".");?></b></td>
            <td><b><?php echo "Rp. ". number_format($jml_p, 2, ",", ".");?></b></td>
            <td><b><?php echo "Rp. ". number_format($jml_gb, 2, ",", ".");?></b></td>
          </tr>
        </tbody>
      </table>
      <p style="float: left;font-size: 21px;margin-left: 50px;">
        <b>
          <br>
          Disetujui Oleh<br><br>
          <br>
          <br>
          <br>
          <br>
          Joko Agung Sayuto<br>
          (CEO)
        </b>
      </p>
      <p style="float: right;font-size: 21px;margin-right: 50px;">
        <b>Jepara, <?php echo date("d-m-Y");?><br>
          Dibuat Oleh,<br><br>
          <br>
          <br>
          <br>
          <br>
          <?php echo $_SESSION['nama_petugas'];?><br>
          (<?php echo $_SESSION['status'];?>)
        </b>
      </p>
    </div>
  </body>
  </html>
  <script type="text/javascript">window.print();</script>