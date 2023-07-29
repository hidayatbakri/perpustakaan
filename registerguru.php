<?php
include 'koneksi.php';
if (isset($_SESSION['login'])) {
  header("Location: /perpustakaan/");
}

$listkelas = mysqli_query($con, "SELECT * FROM tbl_kelas");

function cekSampul($lokasi)
{
  $sizefile = htmlspecialchars($_FILES['gambar']['size']);
  $typefile = htmlspecialchars($_FILES['gambar']['type']);
  $error = htmlspecialchars($_FILES['gambar']['error']);
  $tmp = htmlspecialchars($_FILES['gambar']['tmp_name']);


  if ($error == 4) {
    return 'buku-default.png';
  } else {

    $ekstnsivalid = ['jpg', 'jpeg', 'png'];
    $ekstensi = explode('/', $typefile);

    if (!in_array($ekstensi[1], $ekstnsivalid)) {
      echo "<script>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Format gambar tidak didukung',
      })
    </script>";

      return false;
    }

    if ($sizefile > 512 * 1024) {
      echo "<script>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Ukuran gambar terlalu besar',
      })
    </script>";

      return false;
    }
    // die;
    $namaFile = md5(random_int(0, 10000000)) . '.' . $ekstensi[1];
    move_uploaded_file($tmp, 'assets/' . $lokasi . '/' . $namaFile);
    return $namaFile;
  }
}

?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Halaman Daftar - Guru</title>
  <link rel="stylesheet" href="./src/css/style.css?v=<?php echo time() ?>">
  <link rel="stylesheet" href="./src/css/login.css?v=<?php echo time() ?>">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link href="./src/bootstrap/css/bootstrap.min.css?v=<?php echo time() ?>" rel="stylesheet">
</head>

<body>
  <!-- --------- main container ----------  -->
  <div class="page-content container mt-5">
    <section class="row">
      <div class="col-12">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h4 class="py-4">Formulir</h4>
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg bg-light fs-6" name="nip" placeholder="Nip" required>
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
                        <input type="number" class="form-control form-control-lg bg-light fs-6" name="hp" placeholder="Telepon" required>
                      </div>
                      <div class="input-group mb-3">
                        <select class="form-select bg-light fs-6" name="jk" aria-label="Default select example">
                          <option selected>Pilih Jenis Kelamin</option>
                          <option value="Laki-Laki">Laki-Laki</option>
                          <option value="Perempuan">Perempuan</option>
                        </select>
                      </div>
                    </div>
                    <label for="gambar">Gambar :</label>
                    <div class="input-group mb-3">
                      <input type="file" class="form-control form-control-lg bg-light fs-6" name="gambar" required>
                    </div>
                    <div class="col-md-12">
                      <div class="input-group mb-3">
                        <textarea name="alamat" required class="form-control bg-light fs-6" placeholder="Alamat"></textarea>
                      </div>
                    </div>
                    <div class="col-md-12 mt-3">
                      <div class="col-md-12 d-flex justify-content-end">
                        <a href="/perpustakaan/login" class="btn btn-light me-3">Kembali</a>
                        <button type="submit" name="add" class="btn btn-primary">Simpan</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>


<?php
require 'koneksi.php';
if (isset($_POST["add"])) {
  $id = htmlspecialchars($_POST["nip"]);
  $nama = htmlspecialchars($_POST["nama"]);
  $email = htmlspecialchars($_POST["email"]);
  $password = htmlspecialchars($_POST["password"]);
  $hp = htmlspecialchars($_POST["hp"]);
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

  $gambar = cekSampul("profile");

  $queryguru = "INSERT INTO tbl_guru VALUES ('$id','$nama','$jk','$hp','$alamat', '$gambar', 'false')";
  $querylogin = "INSERT INTO tbl_login (id_anggota, email, password, level) VALUES('$id', '$email', '$password', 'guru')";

  $result1 = mysqli_query($con, $querylogin);
  $result2 = mysqli_query($con, $queryguru);

  if ($result1) {
    echo "<script>
        Swal.fire({
          title: 'Berhasil daftar sebagai guru',
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