<?php
require 'koneksi.php';
session_start();

if (isset($_SESSION['login'])) {
  $_SESSION['level'] == 'staff' ? header("Location: /perpustakaan/staff") : header("Location: /perpustakaan/siswa");
}

if (isset($_POST["login"])) {

  $email = htmlspecialchars($_POST["email"]);
  $password = htmlspecialchars($_POST["password"]);

  $result = mysqli_query($con, "SELECT * FROM tbl_login WHERE 
      email = '$email'");

  //cek email
  if (mysqli_num_rows($result) === 1) {

    //cek password
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["password"])) {

      if ($row['level'] == 'siswa') {
        echo "<script>document.location.href='/perpustakaan/siswa'</script>";
      } elseif ($row['level'] == 'staff') {
        $_SESSION['login'] = true;
        $_SESSION['id'] = $row['id_anggota'];
        $_SESSION['level'] = $row['level'];
        echo "<script>document.location.href='/perpustakaan/staff'</script>";
      }
      exit;
    }
  }

  $error = true;
}
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Halaman Login</title>


  <link rel="stylesheet" href="./src/css/style.css?v=<?php echo time() ?>">
  <link rel="stylesheet" href="./src/css/login.css?v=<?php echo time() ?>">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link href="./src/bootstrap/css/bootstrap.min.css?v=<?php echo time() ?>" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <!-- --------- main container ----------  -->
  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <!-- --------- login container ----------  -->
    <div class="row border position-relative rounded-5 p-3 bg-white shadow box-area">
      <a href="/perpustakaan/">
        <div class="kembali position-absolute bg-white shadow-sm d-flex justify-content-center align-items-center">
          <i class="fas fa-chevron-left"></i>
        </div>
      </a>

      <!-- --------- left box ----------  -->
      <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #103cbe;">
        <div class="featured-image mb-3">
          <img src="./assets/illustration/computer_illustration_1.png" alt="" class="img-fluid" style="width: 250px;">
        </div>
        <p class="text-white fs-2" style="font-family: 'courirer New', Courier, monospace; font-weight: 600;">Halaman Login</p>
        <small class="text-white text-wrap text-center" style="width :17rem; font-family: 'Courier New', ">Sistem informasi perpustakaan SMAN 3 Gowa</small>
      </div>

      <!-- --------- right box ----------  -->
      <div class="col-md-6 right-box">
        <div class="row align-items-center py-3">
          <form action="" method="post">
            <div class="header-text mb-4">
              <h3>Selamat datang</h3>
              <p>Silahkan isi formulir untuk masuk.</p>
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control form-control-lg bg-light fs-6" name="email" placeholder="Email Address">
            </div>
            <div class="input-group mb-5">
              <input type="password" class="form-control form-control-lg bg-light fs-6" name="password" placeholder="Password">
            </div>
            <div class="input-group mb-3">
              <button type="submit" name="login" class="btn btn-primary btn-lg w-100 fs-6">Masuk</button>
            </div>
            <div class="input-group mb-2">
              <a href="/perpustakaan/register" class="btn btn-light btn-lg w-100 fs-6">Daftar</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

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