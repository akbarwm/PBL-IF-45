<?php
setlocale(LC_TIME, 'id_ID.utf8');
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">  
  <title>LAPORAN - KELURAHAN MANGSANG</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="../../assets/dist/css/normalize.min.css">
  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="../../assets/dist/css/paper.css">
  <link rel="stylesheet" href="../../assets/dist/css/bs.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "" if you need -->

  <style>@page { size: A4;}
* {
  font-family: "Arial";
}
.text-center {
  text-align: center;
}
h1 {
  font-size: 18px;
  line-height: 20px;
  text-align: center;
}
h3 {
  font-size: 16px;
  font-weight: normal;
  margin-top: -8px;
  line-height: 40px;
  text-align: center;
}
h4 {
  margin-top: 20px;
  text-transform: uppercase;
  margin-bottom: -10px;
}
td {
  padding: 5px !important;
  text-align: center;
  vertical-align: middle !important;
 /* border-color: #fff !important;
  padding: 5px !important;*/
  /*text-transform: capitalize;*/
}
</style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25-  -->
  <section class="sheet padding-10mm " style="height: auto;font-size: 10px;overflow: auto; ">
  <img src="../../assets/gambar/logo-kota-batam.png" style="width: 50px;float: left;margin-right: 10px;"  class="text-center">
    <h1 class="text-left">PEMERINTAH KOTA BATAM</h1>
    <h1 class="text-left">KECAMATAN SUNGAI BEDUK</h1>
    <h3 class="text-left">Jalan Raya Kampung Bagan Tanjung piayu
Batam – Kepulauan Riau</h3>
    <h3> E-mail : kmangsangn@gmail.com</h3>
    <div style="width: 100%; height: 2px;background-color: #3d3d3d;-webkit-print-color-adjust: exact;"></div>
    <h1 style="margin-top: 15px; text-decoration: underline;" class="text-center">SURAT KETERANGAN DOMISILI</h1>
    <h3 style="margin-top: 3px;" class="text-left"> Nomor : ____/___/____-___/___/_____</h3>
        <?php
          include('../../config/koneksi.php');
          $id = $_GET['id']; 
          $data  = mysqli_query($koneksi, "SELECT data_domisili.*, login_penduduk.* FROM data_domisili JOIN login_penduduk ON data_domisili.user_id = login_penduduk.id WHERE data_domisili.id = '$id'");
          $row  = mysqli_fetch_assoc($data);
          
          // Pastikan data ditemukan sebelum mengaksesnya
          if (!$row) {
              echo "Data tidak ditemukan.";
              exit();
          }
          
          $query_penduduk = mysqli_query($koneksi, "SELECT * FROM login_penduduk WHERE id = '{$row['user_id']}'");
          $data_penduduk = mysqli_fetch_assoc($query_penduduk);
          ?>
          <p style="text-align:justify;font-size:11px;"></p>
          <table class="" style="font-size:12px;" cellpadding="0" cellspacing="0">
            <tr>
              <td colspan="3" style="text-align:justify;"><strong>Lurah Mangsang</strong> Kecamatan Sungai Beduk Kota Batam, dengan ini menerangkan Bahwa:</td>
            </tr>
            <tr>
              <td style="text-align:left;width: 160px;">1. Nama Lengkap</td>
              <td style="width:10px;">:</td>
              <td style="text-align:left;" class="uppercase-text"><strong><?= $row['nama'] ?></strong></td>
            </tr>
            <tr>
              <td style="text-align:left;width: 160px;">2. Jenis Kelamin</td>
              <td style="width:10px;">:</td>
              <td style="text-align:left;" class="uppercase-text"><?= $row['jenis_kelamin'] ?></td>
            </tr>
            <tr>
              <td style="text-align:left;width: 160px;">3. Tempat/ Tanggal Lahir </td>
              <td style="width:10px;">:</td>
              <td style="text-align:left;" class="uppercase-text"><?= $row['tempat_lahir'] ?>, <?= format_tanggal($row['tgl_lahir']); ?></td>
            </tr>
            <tr>
              <td style="text-align:left;width: 160px;">4. Agama </td>
              <td style="width:10px;">:</td>
              <td style="text-align:left;" class="uppercase-text"><?= $row['agama'] ?></td>
            </tr>
            <tr>
              <td style="text-align:left;width: 160px;">5. Kewarganegaraan </td>
              <td style="width:10px;">:</td>
              <td style="text-align:left;" class="uppercase-text"><?= $row['kewarganegaraan'] ?></td>
            </tr>
            <tr>
              <td style="text-align:left;width: 160px;">6. Status Perkawinan</td>
              <td style="width:10px;">:</td>
              <td style="text-align:left;" class="uppercase-text"><?= $row['status_perkawinan'] ?></td>
            </tr>
            <tr>
              <td style="text-align:left;width: 160px;">7. Pekerjaan</td>
              <td style="width:10px;">:</td>
              <td style="text-align:left;" class="uppercase-text"><?= $row['pekerjaan'] ?></td>
            </tr>
            <tr>
              <td style="text-align:left;width: 160px;">8. Keperluan </td>
              <td style="width:10px;">:</td>
              <td style="text-align:left;" class="uppercase-text"><?= $row['keperluan'] ?></td>
            </tr>
            <tr>
              <td style="text-align:left;width: 160px;">9. Pemegang KTP/KK </td>
              <td style="width:10px;">:</td>
              <td style="text-align:left;" class="uppercase-text"><?= $row['nik'] ?></td>
            </tr>
             <tr><td colspan="3" style="text-align:justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Berdasarkan surat pengantar RT/RW. Nomor : ......./.............../......../............/.............../......../....... tanggal __-__-____, bahwa benar nama tersebut diatas <strong> Berdomisili di alamat tersebut diatas</strong>, di Kelurahan Mangsang Kecamatan Sungai Beduk Kota Batam.</td></tr>
              <tr><td colspan="3" style="text-align:justify;"> Surat keterangan domisili ini diberikan kepada yang bersangkutan untuk keperluan <strong>"<?= $row ['keperluan']?>" </strong></td>
            </tr>
            <tr>
              <td colspan="3" style="text-align:justify;">Demikian surat keterangan ini diberikan <strong>untuk 1 (satu) kali pengurusan</strong>, agar dapat dipergunakan sebagaimana mestinya.</td>
            </tr>
          </table>
        <table class=" " style="width: 200px;font-size: 11px;float:left;margin-top: 20px;">
        <table style="width: 200px;font-size: 11px;float:right;margin-top: 20px;">
                    <tr>
                    <td colspan="2">Mangsang, <?= strftime('%e %B %Y', strtotime(date('Y-m-d'))); ?></td>
                    </tr>
                    <tr>
                      <td colspan="2">A.n CAMAT SEI BEDUK</td>
                    </tr>
                    <tr>
                        <th colspan="2"><?= $row['jabatan_pegawai']?></th>
                    </tr>
                    <tr style="height: 100px;">
                        <td style="width: 50%"></td>
                    </tr>
                    <tr>
                        <th style="text-decoration: underline;"><?= $row['nama_pegawai']?></th>
                    </tr>
                    <tr>
                        <td>NIP : <?=$row['nip_pegawai']?></td>
                    </tr>
          </table>
  </section>

</body>
</html>
