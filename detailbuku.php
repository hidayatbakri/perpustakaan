<?php
require 'koneksi.php';
$id = htmlspecialchars($_GET['id']);
$buku = mysqli_query($con, "SELECT * FROM tbl_buku WHERE tbl_buku.id_buku = '$id'");
$buku = mysqli_fetch_assoc($buku);
$total = mysqli_query($con, "SELECT COUNT(*) AS total FROM tbl_peminjaman WHERE id_buku = '$id' GROUP BY id_buku");
$total = mysqli_fetch_assoc($total);
$profile = mysqli_query($con, "SELECT * FROM tbl_profile LIMIT 1");
$row = mysqli_fetch_assoc($profile);
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
      <img class="me-3" src="./assets/logo/<?= $row['logo'] ?>" alt="logo1" width="150">
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
  <section class="py-5 " >
    <div class="container" >
      <h3 class="mytext-primary fw-bold">Buku <?= $buku['judul'] ?></h3>
      <div class="row mt-5" >
        <div class="col-md-4">
          <img class="img-fluid img-buku-populer rounded-2" style="min-height: 400px !important;" src="./assets/buku/<?= $buku['gambar'] ?>" alt="buku-populer">
        </div>
        <div class="col-md-8">
          <h5 class="text-secondary bold">Detail buku</h5>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Judul : <?= $buku['judul']?></li>
            <li class="list-group-item">Penerbit : <?= $buku['penerbit']?></li>
            <li class="list-group-item">Penulis : <?= $buku['penulis']?></li>
            <li class="list-group-item">Tahun Terbit : <?= $buku['tahun_terbit']?></li>
            <li class="list-group-item">Telah dipinjam : <?= $total['total'] ?? '0' ?>x</li>
          </ul>
        </div>
      </div>
      <div class="row my-3">
        <div class="col-12 d-flex justify-content-end">
          <a href="/perpustakaan/buku" class="btn btn-secondary py-2 me-3">Kembali</a>
          <a href="/perpustakaan/login" class="btn btn-primary py-2">Pinjam Buku</a>
        </div>
      </div>

      <!-- <div class="d-flex justify-content-center flex-wrap">
        <?php while ($bukupopuler = mysqli_fetch_assoc($listbukupopuler)) : ?>
          <div class="card card-buku border-0 m-3 position-relative" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?= $bukupopuler['judul'] ?>">
            <a href="/perpustakaan/detailbuku?id=<?= $bukupopuler['id_buku']?>">
              <img class="img-fluid img-buku-populer rounded-2" data-aos="fade-right" data-aos-delay="0" src="./assets/buku/<?= $bukupopuler['gambar'] ?>" alt="buku-populer">
            </a>
          </div>
        <?php endwhile; ?>
      </div> -->

      
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