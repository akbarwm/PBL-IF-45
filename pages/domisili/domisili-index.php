<?php
  include('../../templates/header.php');
  include('../../templates/sidebar.php');
?>
<style type="text/css">
  td {
    vertical-align: middle !important;
  }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Halaman Domisili</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data</h3>
          
          <div class="btn-group float-right">
          <?php
        if ($_SESSION['hak_akses'] === 'penduduk') {
        ?>
            <a href="domisili-tambah.php" class="btn btn-sm btn-success float-right">+ Tambah Data</a>
        <?php
        } else {
            echo "";
        }
        ?>
          
        </div>
        </div>
        <div class="card-body">
          <div class="table-responsive"><ul style="font-size: 15px;">
          <li><strong>Diajukan</strong> : Surat masih direview admin, Menunggu dicetak. | <strong>Proses </strong>: Surat sudah dicetak, Menunggu tanda tangan kepala dinas. | <strong>Disetujui</strong> : Surat sudah selesai, siap diambil.</li>
          <li><strong>Syarat Pengajuan Surat Domisili :</strong></br>  
              1. Foto KTP/KK</br>
              2. Surat Keterangan RT/RW (pastikan Surat pengantar sesuai denga apa yang ingin diajukan)</li>
        </ul>
        <table class="table table-bordered no-wrap" style="white-space: nowrap;"  id="example2">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Tempat, Tgl Lahir</th>
              <th>Agama</th>  
              <th>Status Validasi</th>
              <th>Keterangan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
              include('../../config/koneksi.php'); //memanggil file koneksi
              if($_SESSION['hak_akses'] == 'admin') {
              $datas = mysqli_query($koneksi, "select * from data_domisili") or die(mysqli_error($koneksi));
                } else {
                $id = $_SESSION['user_id'];
                $datas = mysqli_query($koneksi, "select * from data_domisili  where data_domisili.user_id = '$id' ") or die(mysqli_error($koneksi));
                 }
              $no = 1;//untuk pengurutan nomor

              //melakukan perulangan
              while($row = mysqli_fetch_assoc($datas)) {
            ?>  

          <tr >
            <td><?= $no; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['tempat_lahir']; ?>, <?= format_tanggal($row['tgl_lahir']); ?></td>
            <td><?= $row['agama']; ?></td>  
            <td><?= $row['status_data']; ?></td>
            <td><?= $row['keterangan']; ?></td>
            <td style="vertical-align: middle;text-align: center;">
              <?php if($_SESSION['hak_akses'] == 'admin') { ?>
                <a href="domisili-laporan.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-info">Cetak</a>
               
              <?php } ?>
                <a href="domisili-detail.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-secondary">Detail</a>
                <a href="domisili-edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="domisili-index.php?aksi=hapus&id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('anda yakin ingin hapus data ini?');">Hapus</a>
            </td>
          </tr>

            <?php $no++; } ?>
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
        $id = $_GET['id']; //menampung id

        //query hapus
        $datas = mysqli_query($koneksi, "delete from data_domisili where id ='$id'") or die(mysqli_error($koneksi));

        //alert dan redirect ke index.php
        echo "<script>alert('data berhasil dihapus.');window.location='domisili-index.php';</script>";
    }


?>

