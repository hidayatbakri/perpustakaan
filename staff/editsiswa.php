<?php
$title = "Ubah Siswa - Perpustakaan SMAN 3 Gowa";
$active = "siswa";
include 'template/header.php';

if (isset($_GET['nis'])) {
  $getnis = htmlspecialchars($_GET['nis']);
  $profile = mysqli_query($con, "SELECT tbl_siswa.nama, tbl_siswa.nis, tbl_siswa.alamat, tbl_siswa.id_kelas, tbl_kelas.nama_kelas, tbl_siswa.telepon, tbl_siswa.jk, tbl_login.email, tbl_login.level FROM tbl_siswa, tbl_login, tbl_kelas WHERE tbl_siswa.nis = '$getnis' AND tbl_login.id_anggota = '$getnis' AND tbl_siswa.id_kelas = tbl_kelas.id_kelas");
  $profile = mysqli_fetch_assoc($profile);

  $listkelas = mysqli_query($con, "SELECT * FROM tbl_kelas");
}

?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Ubah Siswa</h3>
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
                      <input type="text" class="form-control form-control-lg bg-light fs-6" name="nis" placeholder="Nis" value="<?= $profile['nis'] ?>" required>
                      <input type="hidden" class="form-control form-control-lg bg-light fs-6" name="nisInp" placeholder="Nis" value="<?= $profile['nis'] ?>" required>
                    </div>
                    <div class="input-group mb-3">
                      <input type="email" class="form-control form-control-lg bg-light fs-6" name="email" placeholder="Email Address" value="<?= $profile['email'] ?>" required>
                    </div>
                    <div class="input-group mb-3">
                      <input type="password" class="form-control form-control-lg bg-light fs-6" name="password" placeholder="Password">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-lg bg-light fs-6" name="nama" placeholder="Nama" value="<?= $profile['nama'] ?>" required>
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-lg bg-light fs-6" name="telpon" placeholder="Telepon" value="<?= $profile['telepon'] ?>" required>
                    </div>
                    <div class="input-group mb-3">
                      <select class="form-select bg-light fs-6" name="kelas" aria-label="Default select example">
                        <option value="<?= $profile['id_kelas'] ?>"><?= $profile['nama_kelas'] ?></option>
                        <?php while ($kelas = mysqli_fetch_assoc($listkelas)) : ?>
                          <option value="<?= $kelas['id_kelas'] ?>"><?= $kelas['nama_kelas'] ?></option>
                        <?php endwhile; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="input-group mb-3">
                      <select class="form-select bg-light fs-6" name="jk" aria-label="Default select example">
                        <option value="<?= $profile['jk'] ?>"><?= $profile['jk'] ?></option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                      </select>
                    </div>
                    <div class="input-group mb-3">
                      <textarea name="alamat" required class="form-control bg-light fs-6" placeholder="Alamat"><?= $profile['alamat'] ?></textarea>
                    </div>
                  </div>
                  <div class="col-md-12 mt-3">
                    <div class="col-md-12 d-flex justify-content-end">
                      <a href="/perpustakaan/staff/siswa" class="btn btn-light me-3">Kembali</a>
                      <button type="submit" name="update" class="btn btn-primary">Simpan</button>
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
<?php include 'template/footer.php';

if (isset($_POST['update'])) {
  $nisinput = htmlspecialchars($_POST['nisInp']);
  $nama = htmlspecialchars($_POST['nama']);
  $email = htmlspecialchars($_POST['email']);
  $jk = htmlspecialchars($_POST['jk']);
  $telepon = htmlspecialchars($_POST['telpon']);
  $kelas = htmlspecialchars($_POST['kelas']);
  $alamat = htmlspecialchars($_POST['alamat']);
  $password = htmlspecialchars($_POST['password']);

  $queryStaff = "UPDATE tbl_siswa SET
            nama = '$nama',
            alamat = '$alamat',
            telepon = '$telepon',
            id_kelas = '$kelas',
            jk = '$jk' WHERE nis = '$nisinput'";

  if (strlen($password) > 0) {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $queryLogin = "UPDATE tbl_login SET
              email = '$email',
              password = '$password' WHERE id_anggota = '$nisinput'";
  } else {
    $queryLogin = "UPDATE tbl_login SET
              email = '$email'  WHERE id_anggota = '$nisinput'";
  }

  mysqli_query($con, $queryStaff);
  mysqli_query($con, $queryLogin);

  echo mysqli_error($con);

  if (mysqli_affected_rows($con) >= 0) {
    echo "<script>
        Swal.fire({
          title: 'Berhasil mengubah data',
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
        text: 'Gagal mengubah data!',
      })
    </script>";
  }
}

?>