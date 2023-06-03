<?php
$title = "Dashboard - Perpustakaan SMAN 3 Gowa";
$active = "dashboard";
include 'template/header.php';

$peminjaman = mysqli_query($con, 'SELECT count(*) as total FROM tbl_peminjaman WHERE status = "tidak"');
$peminjaman = mysqli_fetch_assoc($peminjaman);
$totalpeminjaman = mysqli_query($con, 'SELECT count(*) as total FROM tbl_peminjaman');
$totalpeminjaman = mysqli_fetch_assoc($totalpeminjaman);
$siswa = mysqli_query($con, 'SELECT count(*) as total FROM tbl_siswa');
$siswa = mysqli_fetch_assoc($siswa);
$totalstaff = mysqli_query($con, 'SELECT count(*) as total FROM tbl_staff');
$totalstaff = mysqli_fetch_assoc($totalstaff);

?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Dashboard Staff</h3>
</div>
<div class="page-content">
  <section class="row">
    <div class="col-12 col-lg-9">
      <div class="row">
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                  <div class="stats-icon purple mb-2">
                    <i class="iconly-boldShow"></i>
                  </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">Peminjam</h6>
                  <h6 class="font-extrabold mb-0"><?= $peminjaman['total']; ?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                  <div class="stats-icon blue mb-2">
                    <i class="iconly-boldProfile"></i>
                  </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">Siswa</h6>
                  <h6 class="font-extrabold mb-0"><?= $siswa['total']; ?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                  <div class="stats-icon green mb-2">
                    <i class="iconly-boldAdd-User"></i>
                  </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">Staff</h6>
                  <h6 class="font-extrabold mb-0"><?= $totalstaff['total']; ?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body px-4 py-4-5">
              <div class="row">
                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                  <div class="stats-icon red mb-2">
                    <i class="iconly-boldBookmark"></i>
                  </div>
                </div>
                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                  <h6 class="text-muted font-semibold">Total Pinjaman</h6>
                  <h6 class="font-extrabold mb-0"><?= $totalpeminjaman['total']; ?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Grafik Peminjaman</h4>
            </div>
            <div class="card-body">
              <div id="chart-profile-visit"></div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="col-12 col-lg-3">
      <div class="card">
        <div class="card-body py-4 px-4">
          <div class="d-flex align-items-center">
            <div class="avatar avatar-xl">
              <img src="../assets/images/faces/1.jpg" alt="Face 1">
            </div>
            <div class="ms-3 name">
              <h5 class="font-bold"><?= $staff['nama'] ?></h5>
              <h6 class="text-muted mb-0"><?= $staff['nip'] ?></h6>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h4>Peminjam Terbaru</h4>
        </div>
        <div class="card-content pb-4">
          <div class="recent-message d-flex px-4 py-3">
            <div class="avatar avatar-lg">
              <img src="../assets/images/faces/4.jpg">
            </div>
            <div class="name ms-4">
              <h5 class="mb-1">Sirajuddin</h5>
              <h6 class="text-muted mb-0">Siswa - Kelas 8A</h6>
            </div>
          </div>
          <div class="recent-message d-flex px-4 py-3">
            <div class="avatar avatar-lg">
              <img src="../assets/images/faces/5.jpg">
            </div>
            <div class="name ms-4">
              <h5 class="mb-1">Fadhil</h5>
              <h6 class="text-muted mb-0">Siswa - Kelas 9C</h6>
            </div>
          </div>
          <div class="recent-message d-flex px-4 py-3">
            <div class="avatar avatar-lg">
              <img src="../assets/images/faces/1.jpg">
            </div>
            <div class="name ms-4">
              <h5 class="mb-1">Reski</h5>
              <h6 class="text-muted mb-0">Siswa - Kelas 9C</h6>
            </div>
          </div>
          <div class="px-4">
            <button class='btn btn-block btn-xl btn-outline-primary font-bold mt-3'>Lihat Data</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script src="../src/js/jQuery.min.js?v=<?php echo time() ?>"></script>
<!-- Need: Apexcharts -->
<script src="../assets/extensions/apexcharts/apexcharts.min.js?v=<?php echo time() ?>"></script>
<script src="../assets/js/pages/dashboard.js?v=<?php echo time() ?>"></script>
<?php include 'template/footer.php'; ?>