<?php
$title = "Ubah Staff - Perpustakaan SMAN 3 Gowa";
$active = "staff";
include 'template/header.php';

$nissession = $_SESSION['id'];
$profile = mysqli_query($con, "SELECT * FROM tbl_login WHERE tbl_login.id_anggota = '$nissession'");
$profile = mysqli_fetch_assoc($profile);



?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Ubah Data Diri</h3>
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
                  <div class="col-md-12">
                    <div class="input-group mb-3">
                      <input type="password" class="form-control form-control-lg bg-light fs-6" name="password" placeholder="Password">
                    </div>
                  </div>

                  <div class="col-md-12 d-flex justify-content-end">
                    <a href="/perpustakaan/staff/profile" class="btn btn-light me-3">Kembali</a>
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
<?php
include 'template/footer.php';

if (isset($_POST['update'])) {
  $password = htmlspecialchars($_POST['password']);

  if (strlen($password) > 0) {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $queryLogin = "UPDATE tbl_login SET
              password = '$password' WHERE id_anggota = '$nissession'";
  }

  mysqli_query($con, $queryLogin);

  if (mysqli_affected_rows($con) >= 0) {
    echo "<script>
        Swal.fire({
          title: 'Berhasil mengubah data',
          confirmButtonText: 'Lanjut',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            document.location.href='/perpustakaan/siswa/profile';
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