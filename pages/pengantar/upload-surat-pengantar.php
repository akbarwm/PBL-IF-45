<?php
include('../../templates/header.php');
include('../../templates/sidebar.php');
include('../../config/koneksi.php');

if (!isset($_SESSION['username'])) {
    header("Location: ../login/index.php");
    exit();
}

// Periksa apakah pengguna memiliki hak akses sebagai penduduk
if ($_SESSION['hak_akses'] !== 'penduduk') {
    echo "Anda tidak memiliki izin untuk mengakses halaman ini.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileToUpload"])) {
    $target_dir = "file/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if ($fileType != "pdf") {
        echo '<script>';
        echo 'alert("Maaf, hanya file PDF yang diizinkan.");';
        echo 'window.location = "upload-surat-pengantar.php";'; 
        echo '</script>';
        exit();
    }

    // Mendapatkan nama dari sesi login_penduduk
    $nama = $_SESSION['nama'];
    // Ambil data dari tabel login_penduduk berdasarkan NIK
    $query_penduduk = mysqli_query($koneksi, "SELECT * FROM login_penduduk WHERE id = '$user_id'");
    $data_penduduk = mysqli_fetch_assoc($query_penduduk);


    // Periksa jika $uploadOk disetel ke 0 oleh suatu kesalahan
    if ($uploadOk == 0) {
        echo "Maaf, file Anda tidak diunggah.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $file_name = basename($_FILES["fileToUpload"]["name"]);
            $file_path = $target_file;
            
            // Mendapatkan user_id dari sesi
            $user_id = $_SESSION['user_id'];

            // Simpan informasi file dan nama ke dalam database
            $sql = "INSERT INTO surat_pengantar_rt (nama, file_name, file_path, user_id) VALUES ('$nama', '$file_name', '$file_path', '$user_id')";
            
            if ($koneksi->query($sql) === TRUE) {
                echo '<script>';
                echo 'alert("File ' . htmlspecialchars($file_name) . ' berhasil diunggah dan disimpan ke database.");';
                echo 'window.location = "pengantar-index.php";';
                echo '</script>';
                exit();
            } else {
                echo "Maaf, ada kesalahan saat menyimpan informasi file ke database: " . $koneksi->error;
            }
        } else {
            echo '<script>';
            echo 'alert("Maaf, ada kesalahan saat mengunggah file.");';
            echo 'window.location = "upload-surat-pengantar.php";';
            echo '</script>';
            exit();
        }
    }
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Upload Surat Pengantar RT</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Data</h3>
            </div>
            <div class="card-body" style="margin: 20px; padding: 20px;">
                <h2>Pastikan File Berformat <strong>PDF</strong></h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                   <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required="" value="<?= $_SESSION['nama']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="fileToUpload">Pilih file PDF untuk diunggah:</label>
                        <input type="file" name="fileToUpload" id="fileToUpload" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Unggah File</button>
                </form>
                <?php
                if (isset($errorMessage)) {
                    echo '<div class="error-message">' . $errorMessage . '</div>';
                }
                ?>
            </div>
        </div>
    </section>
</div>

<?php
include('../../templates/footer.php');
?>
