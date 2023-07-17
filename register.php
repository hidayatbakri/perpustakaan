<?php
include 'koneksi.php';
if (isset($_SESSION['login'])) {
  header("Location: /perpustakaan/");
}

$listkelas = mysqli_query($con, "SELECT * FROM tbl_kelas");

?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Halaman Daftar</title>
  <link rel="stylesheet" href="./src/css/style.css?v=<?php echo time() ?>">
  <link rel="stylesheet" href="./src/css/login.css?v=<?php echo time() ?>">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link href="./src/bootstrap/css/bootstrap.min.css?v=<?php echo time() ?>" rel="stylesheet">
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



      <!-- --------- right box ----------  -->
      <div class="col-12 right-box">
        <div class="row align-items-center py-3">
          <div class="header-text mb-4">
            <h3>Selamat datang</h3>
            <p>Silahkan isi formulir untuk daftar.</p>
          </div>
          <form action="" method="post">
            <div class="row">
              <div class="col-md-6">
                <div class="input-group mb-3">
                  <input type="text" class="form-control form-control-lg bg-light fs-6" name="nis" placeholder="Nis" required>
                </div>
                <div class="input-group mb-3">
                  <input type="email" class="form-control form-control-lg bg-light fs-6" name="email" placeholder="Email Address" required>
                </div>
                <div class="input-group mb-3">
                  <input type="password" class="form-control form-control-lg bg-light fs-6" name="password" placeholder="Password" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group mb-3">
                  <input type="text" class="form-control form-control-lg bg-light fs-6" name="nama" placeholder="Nama" required>
                </div>
                <div class="input-group mb-3">
                  <input type="text" class="form-control form-control-lg bg-light fs-6" name="telpon" placeholder="Telepon" required>
                </div>
                <div class="input-group mb-3">
                  <select class="form-select bg-light fs-6" name="kelas" aria-label="Default select example">
                    <option selected>Pilih Kelas</option>
                    <?php while ($kelas = mysqli_fetch_assoc($listkelas)) : ?>
                      <option value="<?= $kelas['id_kelas'] ?>"><?= $kelas['nama_kelas'] ?></option>
                    <?php endwhile; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="input-group mb-3">
                  <select class="form-select bg-light fs-6" name="jk" aria-label="Default select example">
                    <option selected>Pilih Jenis Kelamin</option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </div>
                <div class="input-group mb-3">
                  <textarea name="alamat" required class="form-control bg-light fs-6" placeholder="Alamat"></textarea>
                </div>
              </div>
              <div class="col-md-12 mt-3">

                <div class="input-group mb-3">
                  <button type="submit" name="register" class="btn btn-primary btn-lg w-100 fs-6">Daftar</button>
                </div>
                <div class="input-group mb-2">
                  <a href="login" class="btn btn-light btn-lg w-100 fs-6">Masuk</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>


<?php
require 'koneksi.php';
if (isset($_POST["register"])) {
  $id = htmlspecialchars($_POST["nis"]);
  $nama = htmlspecialchars($_POST["nama"]);
  $email = htmlspecialchars($_POST["email"]);
  $password = htmlspecialchars($_POST["password"]);
  $telpon = htmlspecialchars($_POST["telpon"]);
  $kelas = htmlspecialchars($_POST["kelas"]);
  $jk = htmlspecialchars($_POST["jk"]);
  $alamat = htmlspecialchars($_POST["alamat"]);

  $password = password_hash($password, PASSWORD_DEFAULT);

  $cekemail = mysqli_query($con, "SELECT * FROM tbl_login WHERE email = '$email' OR id_anggota = '$id'");

  if (mysqli_num_rows($cekemail) === 1) {
    echo "<script>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Email atau nis sudah terdaftar!',
      })
    </script>";
    exit;
  }

  $querysiswa = "INSERT INTO tbl_siswa VALUES ('$id','$nama','$alamat','$telpon','$jk','$kelas','false')";
  $querylogin = "INSERT INTO tbl_login (id_anggota, email, password, level) VALUES('$id', '$email', '$password', 'siswa')";

  $result1 = mysqli_query($con, $querylogin);
  $result2 = mysqli_query($con, $querysiswa);

  if ($result1) {
    echo "<script>
        Swal.fire({
          title: 'Selamat anda berhasil mendaftar',
          confirmButtonText: 'Lanjut',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            document.location.href='/perpustakaan/login';
          }
        })
      </script>";
  } else {
    echo "<script>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Terjadi sebuah kesalahan!',
      })
    </script>";
  }
}

?>