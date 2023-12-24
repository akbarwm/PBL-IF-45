<?php include('../../templates/header.php'); ?>
<?php include('../../templates/sidebar.php'); ?>
<?php include '../../config/koneksi.php'; ?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
          <h1>Halaman Profil</h1>
     </div>
  </section>
 <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
        <h3 class="card-title">Profil Data</h3>
      </div>
        <div class="card-body">
          <div class="table-responsive">
            <?php
          if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];

            $query = "SELECT id, nik, nama, jenis_kelamin, whatsapp, validasi, tempat_lahir, tanggal_lahir, kewarganegaraan, agama, status_perkawinan, pekerjaan, alamat, rt, rw, penghasilan FROM login_penduduk WHERE username = '$username'";
            $result = $koneksi->query($query);

            if ($result->num_rows > 0) {
              echo "<div class='card-body'>
                      <div class='table-responsive'>
                        <ul style='font-size: 13px;'></ul>
                        <table class='table table-bordered no-wrap' style='white-space: nowrap;' id='example2'>
                          <thead>
                            <tr>
                              <th>NIK</th>
                              <th>Nama</th>
                              <th>Edit Data</th> 
                            </tr>
                          </thead>
                          <tbody>";

              while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["nik"] . "</td>
                        <td>" . $row["nama"] . "</td>
                        <td><a href='edit_data.php?id=" . $row["id"] . "' class='btn btn-primary'>Edit Data</a></td>
                      </tr>";
              }

              echo "</tbody>
                    </table>
                  </div>
                </div>";
            } else {
              echo "Tidak ada data";
            }
          } else {
            echo "Silakan login untuk melihat profil.";
          }
          ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include('../../templates/footer.php'); ?>
