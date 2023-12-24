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
                    <h1>Halaman Surat Pengantar RT/RW</h1>
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
                    <a href="upload-surat-pengantar.php" class="btn btn-sm btn-success float-right">+ Tambah Data</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <ul style="font-size: 13px;">
                        <li>Harap diperhatikan <strong>PENAMAAN FILE</strong> agar tidak kesulitan saat melakukan pengajuan Surat</li>
                        <li>Untuk pengurusan keterangan domsili <strong>(surat_pengantar_domisli)</strong></li>
                        <li>Untuk pengurusan Keterangan Usaha <strong>(surat_pengantar_usaha)</strong></li>
                        <li>Untuk pengurusan Keterangan Penghasilan <strong>(surat_pengantar_penghasilan)</strong></li>
                    </ul>
                    <table class="table table-bordered no-wrap" style="white-space: nowrap;" id="example2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nama File</th>
                                <th>Tanggal Upload</th>
                                <th>Status Data</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include('../../config/koneksi.php');

                            $user_id = $_SESSION['user_id'];
                            // Sesuaikan query agar hanya menampilkan data milik pengguna yang sedang login
                            $query = "SELECT * FROM surat_pengantar_rt WHERE user_id = $user_id";
                            $datas = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
                            $no = 1;

                            while ($row = mysqli_fetch_assoc($datas)) {
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $row['nama']; ?></td>
                                    <td><?= $row['file_name']; ?></td>
                                    <td><?= $row['upload_time']; ?></td>
                                    <td><?= $row['status_data']; ?></td>
                                    <td style="vertical-align: middle;text-align: center;">
                                        <?php if ($_SESSION['hak_akses'] == 'penduduk') { ?>
                                            <a href="pengantar-index.php?aksi=hapus&id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('anda yakin ingin hapus data ini?');">Hapus</a>
                                        <?php } ?>
                                        <a href="<?= $row['file_path']; ?>" target="_blank" class="btn btn-sm btn-primary">Lihat PDF</a>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
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
    $id = $_GET['id'];
    $datas = mysqli_query($koneksi, "delete from surat_pengantar_rt where id ='$id'") or die(mysqli_error($koneksi));
    echo "<script>alert('data berhasil dihapus.');window.location='pengantar-index.php';</script>";
}
?>
