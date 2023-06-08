<?php
$title = "Tambah Siswa - Perpustakaan SMAN 3 Gowa";
$active = "siswa";
include 'template/header.php';


?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Tambah Siswa</h3>
</div>
<div class="page-content">
  <section class="row">
    <div class="col-12">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Formulir</h4>
            </div>
            <div class="card-body">
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
                    <option value="1">VII A</option>
                    <option value="2">VII B</option>
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
                <div class="col-md-12 d-flex justify-content-end">
                  <a href="/perpustakaan/staff/staff" class="btn btn-light me-3">Kembali</a>
                  <button type="submit" name="add" class="btn btn-primary">Simpan</button>
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
<?php include 'template/footer.php'; 

if (isset($_POST["add"])) {
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
          title: 'Berhasil menambah siswa',
          confirmButtonText: 'Lanjut',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            document.location.href='/perpustakaan/staff/siswa';
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