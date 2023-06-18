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

  <div class="row me-1" style="height: 100vh;">
    <a href="/perpustakaan/" class="position-absolute m-2"><img src="/perpustakaan/assets/logo/logosekolah1.png" style="object-fit: cover; width: 200px;"></a>
    <div id="kiri" class="col-md-8 d-flex justify-content-center align-items-center" style="background-color: #F8F7F7;">
      <div class="d-flex justify-content-center">
        <img src="/perpustakaan/assets/illustration/login.png" style="width: 66%; object-fit: cover;">
      </div>
    </div>
    <div class="col-md-4 col-sm-12 py-5 bg-white d-flex justify-content-center align-items-center">
      <div class="w-100 px-3">
        <h3>Selamat Datang! 👋</h3>
        <p class="pb-4">Sistem Informasi Perpustakaan SMAN 3 Gowa</p>
        <form action="" method="post">
          <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control mt-1 py-2" id="email" name="email" placeholder="Alamat Email">
          </div>
          <div class="form-group mb-4">
            <label for="password">Password</label>
            <input type="password" class="form-control mt-1 py-2" id="password" name="password" placeholder="Alamat Email">
          </div>
          <div class="form-group mb-3">
            <button type="submit" name="login" class="btn btn-primary btn-block w-100">Masuk</button>
            <p class="pt-3 text-center">Belum punya akun? <a href="/perpustakaan/register">Buat akun disini</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="src/js/jQuery.min.js?v=<?php echo time() ?>"></script>

  <script>
    setInterval(() => {
      if ($(window).width() <= 768) {
        $("#kiri").hide(500);
        $("#kiri").removeClass("col-md-8 d-flex justify-content-center align-items-center");
      } else {
        $("#kiri").show(500);
        $("#kiri").addClass("col-md-8 d-flex justify-content-center align-items-center");
      }
    }, 500);
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