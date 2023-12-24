<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika tidak, redirect ke halaman login
    header("Location: ../../login.php");
    exit();
}

// Periksa apakah pengguna memiliki hak akses admin
if ($_SESSION['hak_akses'] !== 'admin') {
    // Jika tidak, tampilkan pesan error dan redirect ke halaman yang sesuai
    echo "Anda tidak memiliki izin untuk mengakses halaman ini.";
    exit();
}

setlocale(LC_TIME, 'id_ID.utf8');
include('../../config/koneksi.php');

$id = $_GET['id']; 
$data  = mysqli_query($koneksi, "SELECT data_usaha.*, login_penduduk.* FROM data_usaha JOIN login_penduduk ON data_usaha.user_id = login_penduduk.id WHERE data_usaha.id = '$id'");
$row  = mysqli_fetch_assoc($data);

// Pastikan data ditemukan sebelum mengaksesnya
if (!$row) {
    echo "Data tidak ditemukan.";
    exit();
}

$query_penduduk = mysqli_query($koneksi, "SELECT * FROM login_penduduk WHERE id = '{$row['user_id']}'");
$data_penduduk = mysqli_fetch_assoc($query_penduduk);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">  
  <title>Surat Keterangan Usaha</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="../../assets/dist/css/normalize.min.css">
  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="../../assets/dist/css/paper.css">
  <link rel="stylesheet" href="../../assets/dist/css/bs.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "" if you need -->

  <style>
        @page {
            size: A4;
        }

        * {
            font-family: "Arial";
        }

        .text-center {
            text-align: center;
        }

        h1 {
            font-size: 20px;
            line-height: 20px;
            text-align: center;
        }

        h3 {
            font-size: 14px;
            font-weight: normal;
            margin-top: -1px;
            line-height: 20px;
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
        }

        .uppercase-text {
        text-transform: uppercase;
        font-size: 12px;
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
    <h1 class="text-left">KELURAHAN MANGSANG</h1>
    <h3 class="text-left">Alamat: Jl. S. Parman Pintu II BidaAyu-Kota Batam-29437</h3>
    <h3 class="text-left"> E-mail : kmangsangn@gmail.com</h3>
    <div style="width: 100%; height: 2px;background-color: #3d3d3d;-webkit-print-color-adjust: exact;"></div>
    <h1 style="margin-top: 15px; text-decoration: underline;" class="text-center">SURAT KETERANGAN USAHA</h1>
    <h3 style="margin-top: 3px;" class="text-left"> Nomor : ......./................/...../.....</h3>
        <?php

          
          ?>
          
          <p style="text-align:justify;font-size:11px;"></p>
          <table class="" style="font-size:12px;" cellpadding="0" cellspacing="0">
              <td colspan="3" style="text-align:justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lurah Mangsang Kecamatan Sungai Beduk Kota Batam, dengan ini menerangkan :</td>
            </tr>
            <tr>
              <td style="text-align:left;width: 160px;">Nama </td>
              <td style="width:10px;">:</td>
              <td style="text-align:left;" class="uppercase-text"><strong><?= $row['nama'] ?></strong></td>
            </tr>
            <tr></tr>
              <td style="text-align:left;width: 160px;">Jenis Kelamin </td>
              <td style="width:10px;">:</td>
              <td style="text-align:left;" class="uppercase-text"><?= $data_penduduk['jenis_kelamin'] ?></td>
            </tr>
            <tr>
              <td style="text-align:left;width: 160px;">Tempat/Tgl. Lahir </td>
              <td style="width:10px;">:</td>
              <td style="text-align:left;"><?= $data_penduduk['tempat_lahir'] ?>, <?= date('d - m - Y', strtotime($data_penduduk['tanggal_lahir'])); ?>
            </tr>
            <tr>
              <td style="text-align:left;width: 160px;">Agama </td>
              <td style="width:10px;">:</td>
              <td style="text-align:left;" class="uppercase-text"><?= $data_penduduk['agama'] ?></td>
            </tr>
            <tr>
              <td style="text-align:left;width: 160px;">Status Perkawinan </td>
              <td style="width:10px;">:</td>
              <td style="text-align:left;" class="uppercase-text"><?= $data_penduduk['status_perkawinan'] ?></td>
            </tr>
            <tr>
              <td style="text-align:left;width: 160px;">KTP/NIK </td>
              <td style="width:10px;">:</td>
              <td style="text-align:left;"><?= $row['nik'] ?></td>
            </tr>
            <tr>
              <td style="text-align:left;width: 160px;">Alamat </td>
              <td style="width:10px;">:</td>
              <td style="text-align:left;" class="uppercase-text"><?= $data_penduduk['alamat'] ?></td>
            </tr>
            <tr>
              <td colspan="3" style="text-align:justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Berdasarkan surat pengantar RT/RW. Nomor : ......./.............../......../............/.............../......../....... tanggal ......./....../.........., yang diketahui oleh RT/RW setempat dan Surat Pernyataan Memiliki Usaha di atas materai 10000 bahwa benar usaha yang bersangkutan berdomisili di Kelurahan Mangsang Kecamatan Sungai Beduk Kota Batam.</td>
            </tr>
            <tr>
              <td style="text-align:left;width: 160px;">Memiliki Usaha </td>
              <td style="width:10px;">:</td>
              <td style="text-align:left;" class="uppercase-text"><strong>" <?= $row['memiliki_usaha'] ?> "</strong></td>
            </tr>
            <tr>
              <td style="text-align:left;width: 160px;">Usaha Sejak </td>
              <td style="width:10px;">:</td>
              <td style="text-align:left;" class="uppercase-text"><strong>" Dari <?= $row['usaha_sejak'] ?> Sampai Sekarang "</strong></td>
            </tr>
            <tr>
              <td style="text-align:left;width: 160px;">Alamat Usaha </td>
              <td style="width:10px;">:</td>
              <td style="text-align:left;" class="uppercase-text"><strong>" <?= $row['alamat_usaha'] ?> "</strong></td>
            </tr>
            <tr>
              <td colspan="3" style="text-align:justify; margin-top: 20px;">Surat Keterangan ini diberikan kepada yang bersangkutan untuk keperluan : </td>
            </tr>
            <tr>
              <td style="text-align:left;" class="uppercase-text"><strong>" <?= $row['keperluan'] ?> "</strong></td>
            </tr>
            <tr>
              <td colspan="3" style="text-align:justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demikian surat keterangan ini diberikan untuk 1 (satu) kali pengurusan, agar dapat dipergunakan sebagaimana mestinya.</td>
            </tr>
          </table>
        <table style="width: 200px;font-size: 11px;float:right;margin-top: 20px;">
                    <tr>
                    <td colspan="2">Mangsang, <?= strftime('%e %B %Y', strtotime(date('Y-m-d'))); ?></td>
                    </tr>
                    <tr>
                      <td colspan="2">A.n LURAH MANGSANG</td>
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
