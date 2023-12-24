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
            <h1>Halaman Surat Umum</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Silahkan pilih surat sesuai kebutuhan!</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div class="card text-center">
                    <img src="../../assets/gambar/letter.png" class="card-img-top" alt="Surat Pengantar RT/RW">
                    <div class="card-body">
                        <a href="../../pages/pengantar/pengantar-index.php" class="btn btn-primary">Surat Pengantar RT/RW</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <img src="../../assets/gambar/letter.png" class="card-img-top" alt="Surat Domisili">
                    <div class="card-body">
                        <a href="../../pages/domisili/domisili-index.php" class="btn btn-primary">Surat Domisili</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <img src="../../assets/gambar/letter.png" class="card-img-top" alt="Surat Izin Usaha">
                    <div class="card-body">
                        <a href="../usaha/usaha-index.php" class="btn btn-primary">Surat Usaha</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <img src="../../assets/gambar/letter.png" class="card-img-top" alt="Surat Penghasilan">
                    <div class="card-body">
                        <a href="../penghasilan/penghasilan-index.php" class="btn btn-primary">Surat Penghasilan</a>
                    </div>
                </div>
            </div>
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