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
                    <h1>Halaman User</h1>
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
                <a href="user-tambah.php" class="btn btn-sm btn-success float-right">+ Tambah Data</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="example2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Hak Akses</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('../../config/koneksi.php'); //memanggil file koneksi
                        $datas = mysqli_query($koneksi, "SELECT * FROM login") or die(mysqli_error($koneksi));

                        $no = 1; //untuk pengurutan nomor

                        //melakukan perulangan
                        while ($row = mysqli_fetch_assoc($datas)) {
                        ?>

                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $row['nama']; ?></td>
                                <td><?= $row['username']; ?></td>
                                <td><?= $row['hak_akses']; ?></td>
                                <td>
                                    <a href="user-edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="user-index.php?aksi=hapus&id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('anda yakin ingin hapus data ini?');">Hapus</a>
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


<?php

if ((isset($_GET['aksi'])) && ($_GET['aksi'] == 'hapus')) {
    $id = $_GET['id']; //menampung id

    //query hapus
    $datas = mysqli_query($koneksi, "DELETE FROM login WHERE id ='$id'") or die(mysqli_error($koneksi));

    //alert dan redirect ke index.php
    echo "<script>alert('data berhasil dihapus.');window.location='user-index.php';</script>";
}
?>
