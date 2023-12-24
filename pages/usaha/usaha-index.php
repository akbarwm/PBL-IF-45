<?php
include('../../templates/header.php');
include('../../templates/sidebar.php');
?>
<style type="text/css">
  td {
    vertical-align: middle !important;
  }
  .download-container {
    text-align: left;
  }

  .btn {
      display: inline-block;
      margin-bottom: 10px;
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Halaman Surat Usaha</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Surat</h3>

        <div class="btn-group float-right">
        <?php
        if ($_SESSION['hak_akses'] === 'penduduk') {
        ?>
            <a href="usaha-tambah.php" class="btn btn-sm btn-success float-right">+ Tambah Usaha</a>
        <?php
        } else {
            echo "";
        }
        ?>
          
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive"><ul style="font-size: 15px;">
            <li><strong>Diajukan</strong> : Surat masih direview admin, Menunggu dicetak. | <strong>Proses </strong>:
              Surat sudah dicetak, Menunggu tanda tangan kepala dinas. | <strong>Selesai</strong> : Surat sudah selesai, siap
              diambil.</li>
            <li><strong>Syarat Pengajuan Surat Keterangan Usaha:</strong></br>
              1. Pengantar RT/RW Setempat</br>
              2. Foto KTP/KK</br>
              3. Foto Tempat Usaha</br>
              4. Surat Sempadan</br>
              5. Surat Pernyataan Usaha</br></li>
              <div class="download-container">
              <?php
                  if ($_SESSION['hak_akses'] === 'penduduk') {
                  ?>
                      <a href="file/surat_sempadan.docx" download="surat_sempadan.docx" class="btn btn-primary">Download</a>
                      <strong>Surat Sempadan</strong>
                      <br>
                      <a href="file/surat_pernyataan_usaha.docx" download="surat_pernyataan_usaha.docx" class="btn btn-primary">Download</a>
                      <strong>Surat Pernyataan Usaha</strong>
                  <?php
                  } else {
                      echo "";
                  }
                  ?>
              </div>

          </ul></br>
          <h2>Keterangan Usaha</h2>
          <table class="table table-bordered no-wrap" style="white-space: nowrap;" id="example2">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat Usaha</th>
                <th>Memiliki Usaha</th>
                <th>Usaha Sejak</th>
                <th>Status Validasi</th>
                <th>Keterangan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include('../../config/koneksi.php'); //memanggil file koneksi
              $id_pengguna = $_SESSION['user_id']; 
              if ($_SESSION['hak_akses'] == 'admin') {
                  $datas = mysqli_query($koneksi, "SELECT * FROM data_usaha") or die(mysqli_error($koneksi));
              } else {
                  $datas = mysqli_query($koneksi, "SELECT * FROM data_usaha WHERE data_usaha.user_id = '$id_pengguna'") or die(mysqli_error($koneksi));
              }

              $no = 1; // untuk pengurutan nomor

              // melakukan perulangan
              while ($row = mysqli_fetch_assoc($datas)) {
              ?>

                <tr>
                  <td><?= $no; ?></td>
                  <td><?= $row['nama']; ?></td>
                  <td><?= $row['alamat_usaha']; ?></td>
                  <td><?= $row['memiliki_usaha']; ?></td>
                  <td><?= $row['usaha_sejak']; ?> - Sekarang</td>
                  <td><?= $row['status_data']; ?></td>
                  <td><?= $row['keterangan']; ?></td>
                  <td style="vertical-align: middle;text-align: center;">
                    <?php if ($_SESSION['hak_akses'] == 'admin') { ?>
                      <a href="usaha-laporan.php?id=<?= isset($row['id']) ? $row['id'] : ''; ?>" class="btn btn-sm btn-info">Cetak</a>
                    <?php } ?>
                    <a href="usaha-detail.php?id=<?= isset($row['id']) ? $row['id'] : ''; ?>" class="btn btn-sm btn-secondary">Detail</a>
                    <a href="usaha-edit.php?id=<?= isset($row['id']) ? $row['id'] : ''; ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="usaha-index.php?aksi=hapus&id=<?= isset($row['id']) ? $row['id'] : ''; ?>" class="btn btn-sm btn-danger" onclick="return confirm('anda yakin ingin hapus data ini?');">Hapus</a>
                  </td>
                </tr>


              <?php $no++;
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include('../../templates/footer.php');
?>


<?php

if ((isset($_GET['aksi'])) && ($_GET['aksi'] == 'hapus')) {
  $id = $_GET['id']; // menampung id

  // query hapus
  $datas = mysqli_query($koneksi, "delete from data_usaha where id ='$id'") or die(mysqli_error($koneksi));

  // alert dan redirect ke index.php
  echo "<script>alert('data berhasil dihapus.');window.location='usaha-index.php';</script>";
}

?>
