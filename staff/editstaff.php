<?php
$title = "Ubah Staff - Perpustakaan SMAN 3 Gowa";
$active = "staff";
include 'template/header.php';

if (isset($_GET['nip'])) {

  $getnip = htmlspecialchars($_GET['nip']);
  $profile = mysqli_query($con, "SELECT tbl_staff.nama, tbl_staff.nip, tbl_staff.alamat, tbl_staff.jk, tbl_login.email, tbl_login.level FROM tbl_staff, tbl_login WHERE tbl_staff.nip = '$getnip' AND tbl_login.id_anggota = '$getnip'");
  $profile = mysqli_fetch_assoc($profile);
}
?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Ubah Staff</h3>
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
                      <input type="hidden" class="form-control form-control-lg bg-light fs-6" name="nip" placeholder="Nip" value="<?= $profile['nip'] ?>" required>
                      <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Nip" value="<?= $profile['nip'] ?>" required>
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-lg bg-light fs-6" name="nama" placeholder="Nama" value="<?= $profile['nama'] ?>" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group mb-3">
                      <input type="email" class="form-control form-control-lg bg-light fs-6" name="email" placeholder="Email" value="<?= $profile['email'] ?>" required>
                    </div>
                    <div class="input-group mb-3">
                      <input type="password" class="form-control form-control-lg bg-light fs-6" name="password" placeholder="Password">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="input-group mb-3">
                      <select class="form-select bg-light fs-6" name="jk" aria-label="Default select example">
                        <option value="<?= $profile['jk'] ?>" selected><?= $profile['jk'] ?></option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                      </select>
                    </div>
                    <div class="input-group mb-3">
                      <div class="form-floating">
                        <textarea class="form-control bg-light fs-6" name="alamat" placeholder="Alamat" id="floatingTextarea"><?= $profile['alamat'] ?></textarea>
                        <label for="floatingTextarea">Alamat</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 d-flex justify-content-end">
                    <a href="/perpustakaan/staff/staff" class="btn btn-light me-3">Kembali</a>
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
<?php include 'template/footer.php';

if (isset($_POST['update'])) {
  $nipinput = htmlspecialchars($_POST['nip']);
  $nama = htmlspecialchars($_POST['nama']);
  $email = htmlspecialchars($_POST['email']);
  $jk = htmlspecialchars($_POST['jk']);
  $alamat = htmlspecialchars($_POST['alamat']);
  $password = htmlspecialchars($_POST['password']);

  if (strlen($password) > 0) {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $queryStaff = "UPDATE tbl_staff SET
              nama = '$nama',
              alamat = '$alamat',
              jk = '$jk' WHERE nip = '$nipinput'";
    $queryLogin = "UPDATE tbl_login SET
              email = '$email',
              password = '$password' WHERE id_anggota = '$nipinput'";
  } else {
    $queryStaff = "UPDATE tbl_staff SET
              nama = '$nama',
              alamat = '$alamat',
              jk = '$jk' WHERE nip = '$nipinput'";
    $queryLogin = "UPDATE tbl_login SET
              email = '$email'  WHERE id_anggota = '$nipinput'";
  }

  mysqli_query($con, $queryStaff);
  mysqli_query($con, $queryLogin);

  if (mysqli_affected_rows($con) >= 0) {
    echo "<script>
        Swal.fire({
          title: 'Berhasil mengubah data',
          confirmButtonText: 'Lanjut',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            document.location.href='/perpustakaan/staff/staff';
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