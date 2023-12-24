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
                    <h1>Halaman Detail Surat Penghasilan</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php
        include('../../config/koneksi.php');

        $id = $_GET['id']; 
        $data  = mysqli_query($koneksi, "SELECT data_penghasilan.*, login_penduduk.* FROM data_penghasilan JOIN login_penduduk ON data_penghasilan.user_id = login_penduduk.id WHERE data_penghasilan.id = '$id'");
        $row  = mysqli_fetch_assoc($data);

        // Pastikan data ditemukan sebelum mengaksesnya
        if (!$row) {
            echo "Data tidak ditemukan.";
            exit();
        }

        $query_penduduk = mysqli_query($koneksi, "SELECT * FROM login_penduduk WHERE id = '{$row['user_id']}'");
        $data_penduduk = mysqli_fetch_assoc($query_penduduk);
        ?>
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Data</h3>
            </div>
            <div class="card-body">
                <form action="" method="post" role="form" enctype="multipart/form-data" id="formId">
                    <!-- Informasi Penduduk -->
                    <h3>Informasi Penduduk</h3>
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control" required="" value="<?= isset($row['nik']) ? $row['nik'] : ''; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required="" value="<?= isset($row['nama']) ? $row['nama'] : ''; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <input type="text" name="jenis_kelamin" class="form-control" required="" value="<?= isset($row['jenis_kelamin']) ? $row['jenis_kelamin'] : ''; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Agama</label>
                        <input type="text" name="agama" class="form-control" required="" value="<?= isset($row['agama']) ? $row['agama'] : ''; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Status Perkawinan</label>
                        <input type="text" name="status_perkawinan" class="form-control" required="" value="<?= isset($row['status_perkawinan']) ? $row['status_perkawinan'] : ''; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" required="" value="<?= isset($row['tempat_lahir']) ? $row['tempat_lahir'] : ''; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="text" name="tanggal_lahir" class="form-control" required="" value="<?= isset($row['tanggal_lahir']) ? $row['tanggal_lahir'] : ''; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" required="" value="<?= isset($row['alamat']) ? $row['alamat'] : ''; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Pekerjaan</label>
                        <input type="text" name="pekerjaan" class="form-control" required="" value="<?= isset($row['pekerjaan']) ? $row['pekerjaan'] : ''; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Penghasilan Perbulan</label>
                        <input type="text" name="gaji" class="form-control" required="" value="<?= isset($row['gaji']) ? 'RP ' . number_format($row['gaji'], 0, ',', '.') : ''; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tanggungan</label>
                        <input type="text" name="tanggungan" class="form-control" required="" value="<?= isset($row['tanggungan']) ? $row['tanggungan'] : ''; ?>" readonly>
                    </div>

                    <!-- Informasi Data Anak -->
                    <h3>Informasi Data Anak</h3>
                    <div class="form-group">
                        <label>Nama Anak</label>
                        <input type="text" name="nama_anak" class="form-control" required="" value="<?= isset($row['nama_anak']) ? $row['nama_anak'] : ''; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir_anak" class="form-control" required="" value="<?= isset($row['tempat_lahir_anak']) ? $row['tempat_lahir_anak'] : ''; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Jurusan</label>
                        <input type="text" name="jurusan_anak" class="form-control" required="" value="<?= isset($row['jurusan_anak']) ? $row['jurusan_anak'] : ''; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Hubungan Keluarga</label>
                        <input type="text" name="hubungan_keluarga" class="form-control" required="" value="<?= isset($row['hubungan_keluarga']) ? $row['hubungan_keluarga'] : ''; ?>" readonly>
                    </div>

                    <!-- Informasi Keperluan -->
                    <h3>Keperluan</h3>
                    <div class="form-group">
                        <label>Keperluan</label>
                        <input type="text" name="keperluan" class="form-control" required="" value="<?= isset($row['keperluan']) ? $row['keperluan'] : ''; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <p><?= $row['status_data']; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Pegawai</label>
                        <p><?= $row['nama_pegawai']; ?></p>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" required="" value="<?= isset($row['keterangan']) ? $row['keterangan'] : ''; ?>" readonly>
                         </div>
                    <div>
                        <label>Surat Pengantar RT/RW</label>
                        <?php
                        $pengantar = $row['pengantar']; // Ganti ini dengan nama kolom yang berisi nama file pengantar dari data_domisili
                        if (!empty($pengantar)) {
                        ?>
                            <a href="../pengantar/file/<?= $pengantar; ?>" target="_blank" class="btn btn-sm btn-primary" name="pengantar">Lihat Surat</a>
                        <?php
                        } else {
                        ?>
                            <p>Tidak ada surat pengantar yang tersedia.</p>
                        <?php
                        }
                        ?>
                    </div>
                    </br>
                    <div>
                        <?php
                        $id = $_GET['id'];
                        $data  = mysqli_query($koneksi, "SELECT * FROM data_penghasilan WHERE id = '$id'");
                        $row  = mysqli_fetch_assoc($data);

                        // Pastikan data ditemukan sebelum mengaksesnya
                        if (!$row) {
                            echo "Data tidak ditemukan.";
                            exit();
                        }
                        ?>
                        <!-- Tampilkan foto KTP -->
                        <div class="form-group">
                            <label>Foto KTP/KK</label>
                            <img id="fotoKTP" src="img/<?= $row['file_ktp_kk']; ?>" alt="Foto KTP/KK" style="max-width: 300px; max-height: 300px; display: none;">
                            <button type="button" onclick="openImage('fotoKTP')" class="btn btn-sm btn-primary">Lihat Foto</button>
                        </div>
                        <div class="form-group">
                            <label>Surat Pernyataan Penghasilan</label>
                            <a href="dokumen/<?= $row['pernyataan_penghasilan']; ?>" target="_blank" class="btn btn-sm btn-primary">Lihat Surat</a>
                        </div>
                    </div>
                </form>
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
<script type="text/javascript">
    function printSurat() {
        window.print();
    }
</script>
<script type="text/javascript">
    var form = document.getElementById("formId");
    var allElements = form.elements;
    for (var i = 0, l = allElements.length; i <script l; ++i) {
        // allElements[i].readOnly = true;
        allElements[i].disabled = true;
    }
</script>
<script>
    function openImage(id) {
        var img = document.getElementById(id);
        img.style.display = img.style.display === "none" ? "block" : "none";
    }
</script>
    