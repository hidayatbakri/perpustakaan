<?php
require 'koneksi.php';

$listbukupopuler = mysqli_query($con, "select tbl_buku.judul, tbl_buku.gambar, tbl_peminjaman.id_buku, COUNT(*) as total FROM tbl_buku, tbl_peminjaman WHERE tbl_peminjaman.id_buku = tbl_buku.id_buku GROUP BY tbl_buku.id_buku ORDER BY total DESC LIMIT 4;");
$profile = mysqli_query($con, "SELECT * FROM tbl_profile LIMIT 1");

$row = mysqli_fetch_assoc($profile);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $row['nama_perpus'] ?></title>
  <style>
    iframe {
      height: 300px !important;
      margin: 0;
      padding: 0;
      border-radius: 8px;
      width: 100%;
    }
  </style>
  <link rel="stylesheet" href="./src/css/style.css?v=<?php echo time() ?>">
  <link rel="stylesheet" href="./src/css/landingpage.css?v=<?php echo time() ?>">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link href="./src/bootstrap/css/bootstrap.min.css?v=<?php echo time() ?>" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-expand-lg top py-3">
    <div class="container">
      <img class="me-3" src="./assets/logo/<?= $row['logo'] ?>" alt="logo1" width="150">
      <!-- <a class="navbar-brand text-white" href="#">SMA NEGERI 3 <br><b class="text-white">Gowa</b></a> -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link mx-3" aria-current="page" href="#header">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-3" href="#layanan">Layanan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-3" href="#populer">Populer</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-3" href="buku.php">Buku</a>
          </li>
          <li class="nav-item">
            <a class="nav-link masuk mx-3 px-4 bg-primary text-white rounded-2" href="login">Masuk</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <section class="header" id="header">
    <div class="container d-flex align-items-center justify-content-center h-100 pt-5">
      <div class="row w-100 mt-5">
        <div class="col-md-6 col-sm-12  d-flex justify-content-center flex-column">
          <h1 class="text-white fw-bold" data-aos="fade-right" data-aos-duration="2000"><?= $row['nama_sekolah'] ?></h1>
          <p class="pt-4 text-white" data-aos="fade-right" data-aos-duration="2000" data-aos-delay="200"><?= $row['motto'] ?></p>
          <div>
            <a href="login" class="mt-4 me-3 py-2 btn btn-light rounded mybtn" data-aos="fade-right" data-aos-duration="2000">Masuk</a>
            <a href="#" class="mt-4 py-2 btn btn-outline-light rounded mybtn" data-aos="fade-right" data-aos-duration="2000" data-aos-delay="100">Cari Buku</a>
          </div>
        </div>
        <div class="col-md-6 col-sm-12 d-flex justify-content-end">
          <img src="./assets/illustration/book-header.png" class="img-fluid" width="400" style="object-fit: cover;" alt="book-header" data-aos="fade-left" data-aos-duration="2000">
        </div>
      </div>
    </div>
  </section>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#03045e" fill-opacity="1" d="M0,192L48,181.3C96,171,192,149,288,160C384,171,480,213,576,224C672,235,768,213,864,176C960,139,1056,85,1152,80C1248,75,1344,117,1392,138.7L1440,160L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
  </svg>
  <section class="data py-5 mt-3">
    <div class="container">
      <div class="row">
        <div class="col-md-4 text-center" data-aos="zoom-in" data-aos-duration="1000">
          <h1 style="font-size: 54px;"><i class="fas fa-book"></i></h3>
            <p class="fs-4"><b>+99</b> Buku</p>
        </div>
        <div class="col-md-4 text-center" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="100">
          <h1 style="font-size: 54px;"><i class="fas fa-users"></i></h3>
            <p class="fs-4"><b>+99</b> Pengguna</p>
        </div>
        <div class="col-md-4 text-center" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="150">
          <h1 style="font-size: 54px;"><i class="fas fa-book-open"></i></h3>
            <p class="fs-4"><b>+20</b> E-Book</p>
        </div>
      </div>
    </div>
  </section>
  <section class="layanan py-5" id="layanan">
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-6 col-sm-12 d-flex align-items-center justify-content-center">
          <img src="./assets/img/layanan.jpg" alt="layanan" class="img-fluid rounded-2 img-layanan" data-aos="zoom-in-top" data-aos-duration="1000">
        </div>
        <div class="col-md-6 col-sm-12">
          <h3 class="mytext-primary fw-bold" data-aos="zoom-in-right" data-aos-duration="1000">Layanan Kami</h3>
          <ul class="list-group list-group-flush mt-4">
            <li class="list-group-item d-flex" data-aos="zoom-in-right" data-aos-duration="1000">
              <div class="me-2 icon-layanan bg-success d-flex align-items-center justify-content-center">
                <i class="fas fa-address-book text-white"></i>
              </div>
              <div>
                <h5>Peminjaman Buku</h5>
                <p>Kami melayani peminjaman buku.</p>
              </div>
            </li>
            <li class="list-group-item d-flex" data-aos="zoom-in-right" data-aos-duration="1000" data-aos-delay="50">
              <div class="me-2 icon-layanan bg-info d-flex align-items-center justify-content-center">
                <i class="fas fa-book-open text-white"></i>
              </div>
              <div>
                <h5>Administrasi</h5>
                <p>Dapat digunakan sebagai adminsitrasi sekolah.</p>
              </div>
            </li>
            <li class="list-group-item d-flex" data-aos="zoom-in-right" data-aos-duration="1000" data-aos-delay="100">
              <div class="me-2 icon-layanan bg-warning d-flex align-items-center justify-content-center">
                <i class="fas fa-book-reader text-white"></i>
              </div>
              <div>
                <h5>Bisa mengunduh e-book</h5>
                <p>Kamu bisa mengunduh e-book jika tersedia.</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <section class="populer py-5" id="populer">
    <div class="container">
      <h3 class="mytext-primary fw-bold text-center" data-aos="zoom-in-right" data-aos-duration="1000">Populer</h3>
      <h5 class="text-secondary bold text-center" data-aos="zoom-in-right" data-aos-duration="1000" data-aos-delay="50">Buku paling populer</h5>

      <div class="d-flex justify-content-center flex-wrap">
        <?php while ($bukupopuler = mysqli_fetch_assoc($listbukupopuler)) : ?>
          <div class="card card-buku border-0 m-3 position-relative" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?= $bukupopuler['judul'] ?>">
            <a href="">
              <img class="img-fluid img-buku-populer rounded-2" data-aos="fade-right" data-aos-delay="0" src="./assets/buku/<?= $bukupopuler['gambar'] ?>" alt="buku-populer">
            </a>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </section>
  <section class="lokasi py-5">
    <div class="container">

      <h3 class="mytext-primary fw-bold text-center" data-aos="zoom-in-right" data-aos-duration="1000">Lokasi</h3>
      <div data-aos="zoom-in-right">
        <?= $row['map'] ?>
      </div>
    </div>
  </section>
  <footer class="bg-white py-3">
    <h6 class="text-center">Created by. <?= $row['nama_perpus'] ?> &copy; 2023</h6>
  </footer>
  <script src="./src/js/jQuery.min.js"></script>
  <script src="./src/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    AOS.init({
      once: true,
    });

    $(window).scroll(function() {
      let wScroll = $(this).scrollTop();
      if (wScroll >= 315) {
        $('nav').addClass('sticky-top')
      } else {
        $('nav').removeClass('sticky-top')
      }
    })
  </script>
</body>

</html>