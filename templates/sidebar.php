
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="#" class="brand-link">
      <span class="brand-text font-weight-light">Kelurahan Mangsang</span>
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="../penduduk/profil_penduduk.php" class="d-block">Halo <?= $_SESSION['username']; ?>! </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="../dashboard/dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <?php if($_SESSION['hak_akses'] == 'admin') { ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
          
        <?php } ?>
          <?php if($_SESSION['hak_akses'] == 'admin') { ?>
                Data Surat Umum
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
          <li class="nav-item">
            <a href="../domisili/domisili-index.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
               Domisili
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../usaha/usaha-index.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
               Usaha
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../penghasilan/penghasilan-index.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
               Penghasilan
              </p>
            </a>
          </li>
          </li>

            </ul>
          </li>
 <?php } ?>
 <?php if($_SESSION['hak_akses'] == 'penduduk') { ?>
          <li class="nav-item">
            <a href="../surat/surat-index.php" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Surat Umum
              </p>
            </a>
          </li>
            </ul>
          </li>
          <?php } ?>
      <?php if ($_SESSION['hak_akses'] == 'admin') { ?>
          <li class="nav-item">
            <a href="../kependudukan/penduduk-index.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Akun Penduduk
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../pegawai/pegawai_index.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Data Pegawai
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../user/user-index.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Akun Admin
              </p>
            </a>
          </li>
          <?php } ?>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>