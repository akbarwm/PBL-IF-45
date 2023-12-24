<?php
include('../../templates/header.php');
include('../../templates/sidebar.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Halaman Data Pegawai</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pegawai</h3>
                <a href="tambah_pegawai.php" class="btn btn-sm btn-success float-right">+ Tambah Pegawai</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="example2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('../../config/koneksi.php'); // Memanggil file koneksi
                        $datas = mysqli_query($koneksi, "SELECT id, nip, nama, jabatan FROM data_pegawai") or die(mysqli_error($koneksi));

                        $no = 1; // Untuk pengurutan nomor

                        // Melakukan perulangan
                        while ($row = mysqli_fetch_assoc($datas)) {
                        ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $row['nip']; ?></td>
                                <td><?= $row['nama']; ?></td>
                                <td><?= $row['jabatan']; ?></td>
                                <td>
                                    <a href="detail_pegawai.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-info">Detail</a>
                                    <a href="edit_pegawai.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                </td>
                            </tr>
                        <?php $no++;
                        } ?>
                    </tbody>
                </table>
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
