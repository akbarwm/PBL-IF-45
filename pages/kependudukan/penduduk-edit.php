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
            <h1>Halaman Edit Penduduk</h1>
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

          $id = $_GET['id']; //mengambil id penduduk yang ingin diubah

          //menampilkan penduduk berdasarkan id
          $data   = mysqli_query($koneksi, "select * from login_penduduk where id = '$id'");
          $row  = mysqli_fetch_assoc($data);
          ?>
          <form action="" method="post" role="form" enctype="multipart/form-data">
            <input type="hidden" name="id" required="" value="<?= $row['id']; ?>">
            <div class="form-group">
              <label>Nik</label>
              <input type="text" name="nik" required="" class="form-control col-sm-4"  value="<?= $row['nik']; ?>" autofocus="">
            </div>
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama" required="" class="form-control col-sm-4"  value="<?= $row['nama']; ?>" >
            </div>
            <div class="form-group">
              <label>No Hp</label>
              <input type="text" name="whatsapp" required="" class="form-control col-sm-4" value="<?= $row['whatsapp']; ?>"  >
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <input type="text" name="alamat" required="" class="form-control" value="<?= $row['alamat']; ?>" >
            </div>
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" required="" class="form-control col-sm-4" value="<?= $row['username']; ?>">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" required="" class="form-control col-sm-4" value="<?= $row['password']; ?>">
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

        //jika klik tombol submit maka akan melakukan perubahan
        if (isset($_POST['submit'])) {
          $id = $_POST['id'];
          $nik = $_POST['nik'];
          $nama = $_POST['nama'];
          $username = $_POST['username'];
          $hp = $_POST['whatsapp'];
          $alamat = $_POST['alamat'];
          $password = $_POST['password'];
          mysqli_query($koneksi, "update login_penduduk set nik='$nik',nama='$nama',username='$username',whatsapp='$whatsapp',alamat='$alamat',password='$password' where id ='$id'") or die(mysqli_error($koneksi));
          echo "<script>alert('data berhasil diupdate.');window.location='penduduk-index.php';</script>";
        }
        ?>
  <?php
    include('../../templates/footer.php');
  ?>

