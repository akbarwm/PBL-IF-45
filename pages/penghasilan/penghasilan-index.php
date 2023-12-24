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
          <h1>Halaman Surat Keterangan Penghasilan</h1>
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
            <a href="penghasilan-tambah.php" class="btn btn-sm btn-success float-right">+ Tambah Data</a>
        <?php
        } else {
            echo "";
        }
        ?>
          
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive"><ul style="font-size: 15px;">
        <li><strong>Syarat Pengajuan Surat Keterangan Penghasilan:</strong></br>
              1. Surat Penghasilan dengan materai tertera</br>
              2. Foto KTP/KK (Lampirkan dalam file Surat Penghasilan)</br>
              3. Surat Pengantar RT/RW (Lampirkan dalam file Surat Penghasilan)</br></li>
        <div class="download-container">
            <?php
            if ($_SESSION['hak_akses'] === 'penduduk') {
            ?>
              <a href="file/surat_penghasilan.docx" download="surat_penghasilan.docx" class="btn btn-primary">Download</a>
              <strong>Surat Penghasilan</strong>
            <?php
            } else {
                echo "";
            }
            ?>
            
            <br>
        </div> 

          </ul></br>
          <h2>Keterangan Penghasilan</h2>
          <table class="table table-bordered no-wrap" style="white-space: nowrap;" id="example2">
            <thead>
            <tr>
                <th>No</th>
                <th>Nama Anak</th>
                <th>Tempat Pendidikan</th>
                <th>Keperluan</th>
                <th>Tanggal Pengajuan</th>
                <th>Status Validasi</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php
            include('../../config/koneksi.php'); 
            $id_pengguna = $_SESSION['user_id']; 
            if ($_SESSION['hak_akses'] == 'admin') {
                $datas = mysqli_query($koneksi, "SELECT * FROM data_penghasilan") or die(mysqli_error($koneksi));
            } else {
                $datas = mysqli_query($koneksi, "SELECT * FROM data_penghasilan WHERE data_penghasilan.user_id = '$id_pengguna'") or die(mysqli_error($koneksi));
            }

            $no = 1;

            //melakukan perulangan
            while ($row = mysqli_fetch_assoc($datas)) {
            ?>

                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $row['nama_anak']; ?></td>
                    <td><?= $row['pendidikan']; ?></td>
                    <td><?= $row['keperluan']; ?></td>
                    <td><?= $row['upload_time']; ?></td>
                    <td><?= $row['status_data']; ?></td>
                    <td><?= $row['keterangan']; ?></td>
                    <td style="vertical-align: middle;text-align: center;">
                    <?php if ($_SESSION['hak_akses'] == 'admin') { ?>
                        <a href="penghasilan-laporan.php?id=<?= isset($row['id']) ? $row['id'] : ''; ?>" class="btn btn-sm btn-info">Cetak</a>
                        <?php } ?>
                        <a href="penghasilan-detail.php?id=<?= isset($row['id']) ? $row['id'] : ''; ?>" class="btn btn-sm btn-secondary">Detail</a>
                        <a href="penghasilan-edit.php?id=<?= isset($row['id']) ? $row['id'] : ''; ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="penghasilan-index.php?aksi=hapus&id=<?= isset($row['id']) ? $row['id'] : ''; ?>" class="btn btn-sm btn-danger" onclick="return confirm('anda yakin ingin hapus data ini?');">Hapus</a>
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
  $datas = mysqli_query($koneksi, "delete from data_penghasilan where id ='$id'") or die(mysqli_error($koneksi));

  // alert dan redirect ke index.php
  echo "<script>alert('data berhasil dihapus.');window.location='penghasilan-index.php';</script>";
}

?>
