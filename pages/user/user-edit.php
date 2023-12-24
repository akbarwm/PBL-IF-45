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
            <h1>Halaman Edit Admin</h1>
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
            $data   = mysqli_query($koneksi, "select * from login where id = '$id'");
            $row  = mysqli_fetch_assoc($data);
          ?>
          <form action="" method="post" role="form">
            <input type="hidden" name="id" required="" value="<?= $row['id']; ?>">
            <div class="form-group">
              <label> Pegawai</label>
              <select class="form-control col-sm-4" name="pegawai_id" disabled="">
                <option value=""> Pegawai</option>
                <?php
                  $datas = mysqli_query($koneksi, "select * from data_pegawai") or die(mysqli_error($koneksi));
                  while($data = mysqli_fetch_assoc($datas)) {

                ?> 
                <option value="<?= $data['id'] ?>" <?php echo ($row['pegawai_id'] == $data['id']) ? 'selected' : ''; ?> ><?= $data['Nama'] ?></option>
              <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" required="" class="form-control" value="<?= $row['username']; ?>" autofocus>
            </div>
            <div class="form-group">
              <label>Hak Akses</label>
              <select class="form-control  col-sm-4" name="hak_akses" required="">
                <option value="">Pilih Hak Akses</option>
                <option value="admin" <?php echo ($row['hak_akses'] == 'admin') ? 'selected' : ''; ?> >admin</option>
                <option value="pimpinan" <?php echo ($row['hak_akses'] == 'pimpinan') ? 'selected' : ''; ?>>pimpinan</option>
              </select>
            </div>

            <div class="form-group">
              <label>Password <span class="text-muted bg-danger">(Abaikan password jika tidak ingin ganti)</span></label>
              <input type="password" name="password" class="form-control" >
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
          //menampung data dari inputan
          $hak_akses = $_POST['hak_akses'];
          $username = $_POST['username'];
          $password = $_POST['password'];
          $pegawai_id = $_POST['pegawai_id'];

          if(!empty($password)) {
              $datas = mysqli_query($koneksi, "update login set username = '$username',hak_akses = '$hak_akses' ,password = '$password' where id = '$id'") or die(mysqli_error($koneksi));
          } else {
              $datas = mysqli_query($koneksi, "update login set username = '$username',hak_akses = '$hak_akses' where id = '$id'") or die(mysqli_error($koneksi));
          }


            echo "<script>alert('data berhasil diubah.');window.location='user-index.php';</script>";
        }
        ?>
  <?php
    include('../../templates/footer.php');
  ?>

