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
            <h1>Halaman Tambah Admin</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tambah Data</h3>
        </div>
        <div class="card-body">
          <form action="" method="post" role="form">
              <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama" required="" class="form-control" >
            </div>
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" required="" class="form-control" >
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" required="" class="form-control" >
            </div>
            <div class="form-group">
              <label>Hak Akses</label>
              <select class="form-control  col-sm-4" name="hak_akses" required="">
                <option value="admin">admin</option>
              </select>
            </div>

            <button type="submit" class="btn btn-primary" name="submit" value="simpan">Simpan data</button>
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
          include '../../config/koneksi.php';

          if (mysqli_connect_errno()) {
            echo "Koneksi database gagal: " . mysqli_connect_error();
            exit();
          }

          // Mendapatkan pegawai_id terakhir
          $query_last_id = mysqli_query($koneksi, "SELECT pegawai_id FROM login ORDER BY pegawai_id DESC LIMIT 1");

          if ($query_last_id) {
            $last_id_row = mysqli_fetch_assoc($query_last_id);
            $last_pegawai_id = $last_id_row['pegawai_id'];

            // Menambahkan 1 untuk mendapatkan pegawai_id baru
            $pegawai_id = $last_pegawai_id + 1;
          } else {
            // Jika query gagal, atur nilai default untuk pegawai_id
            $pegawai_id = 1;
          }
        
        if (isset($_POST['submit'])) {
          //menampung data dari inputan
          $id = $_POST['id'];
          $hak_akses = $_POST['hak_akses'];
          $nama = $_POST['nama'];
          $username = $_POST['username'];
          $password = $_POST['password'];
          $pegawai_id = $_POST['pegawai_id'];

          $datas = mysqli_query($koneksi, "INSERT INTO login (id, hak_akses, nama, username, password) VALUES ('$id','$hak_akses', '$nama', '$username', '$password')") or die(mysqli_error($koneksi));


          echo "<script>alert('data berhasil disimpan.');window.location='user-index.php';</script>";
        }
        ?>
  <?php
    include('../../templates/footer.php');
  ?>

