<?php
require 'koneksi.php';
session_start();

$id = htmlspecialchars($_GET['id']);

// die;
$cekid = mysqli_query($con, "SELECT * FROM tbl_siswa WHERE foto LIKE '%$id%'");
if (mysqli_num_rows($cekid)) {
  $cekid = mysqli_fetch_assoc($cekid);
  $nisn = $cekid['nisn'];
  $profile = mysqli_query($con, "SELECT * FROM tbl_siswa, tbl_login, tbl_kelas WHERE tbl_siswa.nisn = '$nisn' AND tbl_login.id_anggota = '$nisn' AND tbl_kelas.id_kelas = tbl_siswa.id_kelas");
  $profile = mysqli_fetch_assoc($profile);
  $id = explode(".", $profile['foto']);
  $id = $id[0];
  $perpus = mysqli_query($con, "SELECT * FROM tbl_profile LIMIT 1");
  $perpus = mysqli_fetch_assoc($perpus);
  $peminjaman = mysqli_query($con, "SELECT COUNT(*) AS total FROM tbl_peminjaman WHERE id_anggota = '$nisn' AND status = 'tidak'");
  $peminjaman = mysqli_fetch_assoc($peminjaman);
} else {
  header("Location: /perpustakaan/");
  exit;
}

?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cek Keterangan</title>


  <link rel="stylesheet" href="./src/css/style.css?v=<?php echo time() ?>">
  <link rel="stylesheet" href="./src/css/login.css?v=<?php echo time() ?>">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link href="./src/bootstrap/css/bootstrap.min.css?v=<?php echo time() ?>" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="./src/css/login.css?v=<?php echo time() ?>" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="./assets/js/qrcode.min.js"></script>
</head>

<body>

  <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card my-4" style="width: 420px;">
      <div class="card-body p-4">
        <h4 class="text-center">Keterangan</h4>
        <p class="text-secondary text-center"><?= $perpus['nama_perpus'] ?></p>
        <div class="d-flex justify-content-center my-3">
          <div id="qrcode" class="mb-3"></div>
        </div>

        <table class="table" style="max-width: 100%;">
          <tbody>
            <tr>
              <th scope="row">Nama</th>
              <td><?= $profile['nama']; ?></td>
            </tr>
            <tr>
              <th scope="row">Nisn</th>
              <td><?= $profile['nisn']; ?></td>
            </tr>
            <tr>
              <th scope="row">Kelas</th>
              <td><?= $profile['nama_kelas']; ?></td>
            </tr>
            <tr>
              <th scope="row">Email</th>
              <td><?= $profile['email']; ?></td>
            </tr>
            <tr>
              <th scope="row">Jenis Kelamin</th>
              <td><?= $profile['jk']; ?></td>
            </tr>
            <tr>
              <th scope="row">Alamat</th>
              <td><?= $profile['alamat']; ?></td>
            </tr>
            <tr>
              <th scope="row">Level</th>
              <td><?= $profile['level']; ?></td>
            </tr>
            <tr>
              <th scope="row">Total Peminjaman</th>
              <td><?= $peminjaman['total']; ?></td>
            </tr>
            <tr>
              <th scope="row">Status</th>
              <td><?= $peminjaman['total'] < 1 ? '<span class="text-success">Bebas</span>' : '<span class="text-success">Tidak Bebas</span>' ?></td>
            </tr>
          </tbody>
        </table>
        <div class="d-flex justify-content-end mt-5">
          <a href="<?= $url ?>cetak?id=<?= $profile['nisn'] ?>" target="_blank" class="btn btn-primary"><i class="text-white bi bi-printer"></i> Cetak</a>
        </div>
      </div>
    </div>
  </div>

  <script src="src/js/jQuery.min.js?v=<?php echo time() ?>"></script>
  <script>
    let qrcode = new QRCode("qrcode", {
      text: `<?= $url ?>check?id=<?= $id; ?>`,
      width: 128,
      height: 128,
      colorDark: "#000000",
      colorLight: "#ffffff",
      correctLevel: QRCode.CorrectLevel.H
    });
  </script>

  <?php if (isset($error)) : ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Email atau password salah!',
      })
    </script>
  <?php endif; ?>
</body>

</html>