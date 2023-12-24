
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SISTEM INFORMASI KELURAHAN MANGSANG</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../../assets/gambar/logo-kota-batam.png" rel="icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    .row a:hover {
            color: #ffd700;
        }
  </style>
</head>

<body class="hold-transition login-page" style="background: url('../../assets/gambar/background1.jpg');background-size: 100% 120%; background-repeat: no-repeat;">
<div class="login-box">
  <div class="login-logo">
    <img src="../../assets/gambar/logo-kota-batam.png" style="width: 100px;">
    <br>
    <h1 style="font-size: 28px;color: white; font-family: serif;">KELURAHAN MANGSANG</h1>
  </div>
      <form action="" method="post" role="form">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="ketikkan username.." name="username" required="" autofocus="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="ketikkan password.." name="password" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <p style="margin-top: 8px; color: #FFAA04; font-family: Inter; font-size: 15px; font-style: normal; font-weight: 500;">Belum punya akun? <a href="registrasi.php">Buat disini</a></p>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="submit" value="simpan">Login</button>
          </div>
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
  <div class="row">
        <div class="col-sm-12">
          
        </div>
      </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../assets/dist/js/adminlte.min.js"></script>

</body>
</html>

<?php
include('../../config/koneksi.php');

if (isset($_POST['submit'])) {
  session_start();
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Cek apakah login sebagai penduduk
  $result_penduduk = mysqli_query($koneksi, "SELECT login_penduduk.* from login_penduduk where username = '$username' and password = '$password' and validasi = '1'");
  $cek_penduduk = mysqli_num_rows($result_penduduk);

  // Cek apakah login sebagai admin
  $result_admin = mysqli_query($koneksi, "SELECT * FROM login where username = '$username' and password = '$password'");
  $cek_admin = mysqli_num_rows($result_admin);

  if ($cek_penduduk > 0) {
    $data = mysqli_fetch_assoc($result_penduduk);

    $_SESSION['username'] = $username;
    $_SESSION['status'] = 'sudah_login';
    $_SESSION['user_id'] = $data['id'];
    $_SESSION['hak_akses'] = 'penduduk';
    $_SESSION['nama'] = $data['nama'];

    header("location:../dashboard/dashboard.php"); // Redirect ke halaman sesuai dengan peran
  } elseif ($cek_admin > 0) {
    $data = mysqli_fetch_assoc($result_admin);

    $_SESSION['username'] = $username;
    $_SESSION['status'] = 'sudah_login';
    $_SESSION['user_id'] = $data['id'];
    $_SESSION['karyawan_id'] = $data['karyawan_id'];
    $_SESSION['hak_akses'] = $data['hak_akses'];

    header("location:../dashboard/dashboard.php"); // Redirect ke halaman sesuai dengan peran
  } else {
    echo "<script>alert('Gagal Login! Username / Password Salah.');window.location='index.php';</script>";
  }
}
?>