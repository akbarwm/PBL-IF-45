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
            <h1>Halaman Edit Data Pegawai</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Edit Data</h3>
        </div>
        <div class="card-body">
          <?php
          include('../../config/koneksi.php');

            $id = $_GET['id']; 
            $data   = mysqli_query($koneksi, "SELECT * FROM data_pegawai WHERE id = '$id'");
            $row  = mysqli_fetch_assoc($data);
          ?>
          <form action="" method="post" role="form">
            <input type="hidden" name="id" required="" value="<?= $row['id']; ?>">
            <div class="form-group">
              <label>NIP</label>
              <input type="text" name="nip" required="" class="form-control" value="<?= $row['nip']; ?>" autofocus>
            </div>
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama" required="" class="form-control" value="<?= $row['nama']; ?>">
            </div>
            <div class="form-group">
              <label>Jabatan</label>
              <input type="text" name="jabatan" required="" class="form-control" value="<?= $row['jabatan']; ?>">
            </div>

            <button type="submit" class="btn btn-primary" name="submit" value="simpan">Ubah data</button>
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
if (isset($_POST['submit'])) {
    $id = $_POST['id']; // Menampung id yang diubah

    // Menampung data dari inputan
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];

    // Query untuk mengupdate data pegawai
    $query = "UPDATE data_pegawai SET nip = '$nip', nama = '$nama', jabatan = '$jabatan' WHERE id = '$id'";

    // Eksekusi query
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Data berhasil diubah.');window.location='pegawai_index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<?php
include('../../templates/footer.php');
?>
