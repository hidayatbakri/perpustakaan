<?php
require 'koneksi.php';

$listbuku = mysqli_query($con, "SELECT * FROM tbl_buku ORDER BY id_buku DESC");
$listbukupopuler = mysqli_query($con, "select tbl_buku.judul, tbl_buku.gambar, tbl_peminjaman.id_buku, COUNT(*) as total FROM tbl_buku, tbl_peminjaman WHERE tbl_peminjaman.id_buku = tbl_buku.id_buku GROUP BY tbl_buku.id_buku ORDER BY total DESC LIMIT 4;");

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perpustakaan SMAN 3 Gowa</title>
  <link rel="stylesheet" href="./src/css/style.css?v=<?php echo time() ?>">
  <link rel="stylesheet" href="./src/css/landingpage.css?v=<?php echo time() ?>">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link href="./src/bootstrap/css/bootstrap.min.css?v=<?php echo time() ?>" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-expand-lg top py-3">
    <div class="container">
      <img class="me-3" src="./assets/logo/LOGO-TUT-WURI-handayani.png" alt="logo1" width="60">
      <a class="navbar-brand text-white" href="#">SMA NEGERI 3 <br><b class="text-white">Gowa</b></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link mx-3" href="/perpustakaan">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-3" aria-current="page" href="buku">Buku</a>
          </li>
          <li class="nav-item">
            <a class="nav-link masuk mx-3 px-4 bg-primary text-white rounded-2" href="login">Masuk</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
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

      <div style="margin-top: 120px;">

        <h3 class="mytext-primary fw-bold" data-aos="zoom-in-right" data-aos-duration="1000">Data Buku</h3>
        <h5 class="text-secondary bold" data-aos="zoom-in-right" data-aos-duration="1000" data-aos-delay="50">Daftar buku yang tersedia</h5>

        <div class="d-flex justify-content-center flex-wrap">
          <?php while ($buku = mysqli_fetch_assoc($listbuku)) : ?>
            <div class="card card-buku border-0 m-3 position-relative" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?= $buku['judul'] ?>">
              <a href="">
                <img class="img-fluid img-buku-populer rounded-2" data-aos="fade-right" data-aos-delay="0" src="./assets/buku/<?= $buku['gambar'] ?>" alt="buku-populer">
              </a>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  </section>
  <footer class="bg-white py-3">
    <h6 class="text-center">Created by. SMAN 3 Gowa &copy; 2023</h6>
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