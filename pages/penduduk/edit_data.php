<?php
include '../../config/koneksi.php';
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
          <h1>Halaman Profil</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Edit Profil</h3>
      </div>
      <?php
      if (isset($_GET['id'])) {
          $id = $_GET['id'];

          // Ambil data yang ingin di-edit berdasarkan ID
          $query = "SELECT * FROM login_penduduk WHERE id = $id";
          $result = $koneksi->query($query);

          if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();

              // Form untuk mengedit data
              ?>
              <form action='update_data.php' method='post'>
                  <div class ="card-body">
                <div class='form-group'>
                  <label for='nik'>NIK:</label>
                  <input type='text' name='nik' class='form-control' value='<?php echo $row["nik"]; ?>' required>
                </div>
                <div class='form-group'>
                  <label for='nama'>Nama:</label>
                  <input type='text' name='nama' class='form-control' value='<?php echo $row["nama"]; ?>' required>
                </div>
                <div class='form-group'>
                  <label for='whatsapp'>Whatsapp:</label>
                  <input type='text' name='whatsapp' class='form-control' value='<?php echo $row["whatsapp"]; ?>' required>
                </div>
                <div class='form-group'>
                  <label for='kewarganegaraan'>Kewarganegaraan:</label>
                  <input type='text' name='kewarganegaraan' class='form-control' value='<?php echo $row["kewarganegaraan"]; ?>' required>
                </div>
                <div class='form-group'>
                  <label for='alamat'>Alamat:</label>
                  <input type='text' name='alamat' class='form-control' value='<?php echo $row["alamat"]; ?>' required>
                </div>
                <div class='form-group'>
                  <label for='status_perkawinan'>Status Perkawinan:</label>
                  <select class="form-select" name="status_perkawinan" value='<?php echo $row["status_perkawinan"]; ?>' required>
                      <option value="Lajang">Lajang</option>
                      <option value="Menikah">Menikah</option>
                  </select> 
                </div>
                <div class='form-group'>
                  <label for='rt'>RT:</label>
                  <input type='text' name='rt' class='form-control' value='<?php echo $row["rt"]; ?>' required>
                </div>
                <div class='form-group'>
                  <label for='rw'>RW:</label>
                  <input type='text' name='rw' class='form-control' value='<?php echo $row["rw"]; ?>' required>
                </div> 
                <div class="form-group">
                        <div class="form-label">Kecamatan:</div>
                        <select class="form-select" name="kecamatan" required>
                            <option value="Sei Beduk">Sei Beduk</option>
                        </select>
                    </div>
                     <div class="form-group">
                        <div class="form-label">Kelurahan:</div>
                        <select class="form-select" name="kelurahan" required>
                            <option value="Duriangkang">Duriangkang</option>
                            <option value="Mangsang">Mangsang</option>
                            <option value="Piayu">Piayu</option>
                            <option value="Muka Kuning">Muka Kuning</option>
                        </select>
                    </div>
                <input type="hidden" name="id" value='<?php echo $row["id"]; ?>'>
                <div class='form-group'>
                  <input type='submit' value='Simpan' class='btn btn-primary'>
                </div>
                </div>
              </form>
              <?php
          } else {
              echo "Data tidak ditemukan";
          }
      } else {
          echo "ID tidak diberikan";
      }
      ?>
    </div>
  </section>
</div>

<?php
include('../../templates/footer.php');
$koneksi->close();
?>
