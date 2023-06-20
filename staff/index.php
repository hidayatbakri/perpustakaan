<?php
$title = "Dashboard - Perpustakaan SMAN 3 Gowa";
$active = "dashboard";
include 'template/header.php';

$peminjaman = mysqli_query($con, 'SELECT count(*) as total FROM tbl_peminjaman WHERE status = "tidak"');
$peminjaman = mysqli_fetch_assoc($peminjaman);
$totalpeminjaman = mysqli_query($con, 'SELECT count(*) as total FROM tbl_peminjaman WHERE status = "ya"');
$totalpeminjaman = mysqli_fetch_assoc($totalpeminjaman);
$siswa = mysqli_query($con, 'SELECT count(*) as total FROM tbl_siswa');
$siswa = mysqli_fetch_assoc($siswa);
$totalkelas = mysqli_query($con, 'SELECT count(*) as total FROM tbl_kelas');
$totalkelas = mysqli_fetch_assoc($totalkelas);
$chartPinjam = mysqli_query($con, "SELECT COUNT(MONTH(tbl_peminjaman.tgl_pinjam)) AS total, MONTH(tbl_peminjaman.tgl_pinjam) as bulan, YEAR(tbl_peminjaman.tgl_pinjam) as tahun FROM tbl_peminjaman GROUP BY MONTH(tbl_peminjaman.tgl_pinjam);");
$datachart = array();
while ($chart = mysqli_fetch_assoc($chartPinjam)) {
  $datachart[] = $chart;
}

$dc = json_encode($datachart);


mysqli_query($con, "SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");

$recentPinjaman = mysqli_query($con, "SELECT tbl_siswa.nama, tbl_peminjaman.id_anggota, tbl_peminjaman.tgl_pinjam, tbl_peminjaman.id_peminjaman, tbl_peminjaman.status, tbl_kelas.nama_kelas FROM tbl_siswa, tbl_kelas, tbl_buku, tbl_peminjaman WHERE tbl_peminjaman.id_anggota = tbl_siswa.nis AND tbl_peminjaman.id_buku = tbl_buku.id_buku AND tbl_siswa.id_kelas = tbl_kelas.id_kelas GROUP BY tbl_peminjaman.id_anggota ORDER BY tbl_peminjaman.tgl_pinjam DESC LIMIT 3");
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
  <div class="youchart"></div>
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
                  <h6 class="font-extrabold mb-0"><?= $totalkelas['total']; ?></h6>
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
          <?php while ($recent = mysqli_fetch_assoc($recentPinjaman)) : ?>
            <div class="recent-message d-flex px-4 py-3">
              <div class="avatar avatar-lg">
                <img src="../assets/images/faces/4.jpg">
              </div>
              <div class="name ms-4">
                <h5 class="mb-1"><?= $recent['nama'] ?></h5>
                <h6 class="text-muted mb-0">Siswa - Kelas <?= $recent['nama_kelas'] ?></h6>
              </div>
            </div>
            <div class="px-4">
              <a href="/perpustakaan/staff/detailpinjaman?id=<?= $recent['id_anggota'] ?>" class='btn btn-block btn-xl btn-outline-primary font-bold mt-3'>Lihat Data</a>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  </section>
</div>
<script src="../src/js/jQuery.min.js?v=<?php echo time() ?>"></script>
<!-- Need: Apexcharts -->
<script src="../assets/extensions/apexcharts/apexcharts.min.js?v=<?php echo time() ?>"></script>
<!-- <script src="../assets/js/pages/dashboard.js?v=<?php echo time() ?>"></script> -->
<script>
  const dc = `<?= $dc ?>`
  dc.forEach(function(item) {
    var total = item.total;
    console.log(total);
  });
  // console.log(dc)
  var optionsProfileVisit = {
    annotations: {
      position: "back",
    },
    dataLabels: {
      enabled: false,
    },
    chart: {
      type: "bar",
      height: 300,
    },
    fill: {
      opacity: 1,
    },
    plotOptions: {},
    series: [{
      name: "peminjaman",
      data: [9, 20, 30, 20, 10, 20, 30, 20, 10, 20, 30, 20],
    }, ],
    colors: "#435ebe",
    xaxis: {
      categories: [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
      ],
    },
  };

  var chartProfileVisit = new ApexCharts(
    document.querySelector("#chart-profile-visit"),
    optionsProfileVisit
  );

  chartProfileVisit.render();
</script>
<?php include 'template/footer.php'; ?>