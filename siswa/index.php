<?php
$title = "Dashboard - Perpustakaan SMAN 3 Gowa";
$active = "dashboard";
include 'template/header.php';
mysqli_query($con, "SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");

$peminjaman = mysqli_query($con, 'SELECT count(*) as total FROM tbl_peminjaman WHERE status = "tidak" AND tbl_peminjaman.id_anggota = "$nis"');
$peminjaman = mysqli_fetch_assoc($peminjaman);
$totalpeminjaman = mysqli_query($con, 'SELECT count(*) as total FROM tbl_peminjaman WHERE status = "ya" AND tbl_peminjaman.id_anggota = "$nis"');
$totalpeminjaman = mysqli_fetch_assoc($totalpeminjaman);
$chartPinjam = mysqli_query($con, "SELECT COUNT(MONTH(tbl_peminjaman.tgl_pinjam)) AS total, DATE_FORMAT(tgl_pinjam, '%M %Y') as bulan FROM tbl_peminjaman WHERE tbl_peminjaman.id_anggota = '$nis' GROUP BY MONTH(tbl_peminjaman.tgl_pinjam) ORDER BY tgl_pinjam DESC LIMIT 12");
$datachart = array();
while ($chart = mysqli_fetch_assoc($chartPinjam)) {
  $datachart[] = $chart;
}

$dc = json_encode($datachart);
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
              <h6 class="text-muted mb-0"><?= $staff['nis'] ?></h6>
            </div>
          </div>
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
  let dc = `<?= $dc ?>`
  console.log(dc)
  dc = JSON.parse(dc)
  datacharttotal = [];
  datachartbulan = [];
  datacharttahun = [];
  for (let i = 0; i < dc.length; i++) {
    datacharttotal.push(dc[i].total)
    datachartbulan.push(dc[i].bulan)
  }
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
      data: datacharttotal,
    }, ],
    colors: "#435ebe",
    xaxis: {
      categories: datachartbulan,
    },
  };

  var chartProfileVisit = new ApexCharts(
    document.querySelector("#chart-profile-visit"),
    optionsProfileVisit
  );

  chartProfileVisit.render();
</script>
<?php include 'template/footer.php'; ?>