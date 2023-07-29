<?php
$title = "Ubah Guru - Perpustakaan SMAN 3 Gowa";
$active = "guru";
include 'template/header.php';

if (isset($_GET['nip'])) {
  $getnip = htmlspecialchars($_GET['nip']);
  $row = mysqli_query($con, "SELECT * FROM tbl_guru, tbl_login WHERE tbl_login.id_anggota = tbl_guru.nip AND tbl_guru.nip = '$getnip'");
  $row = mysqli_fetch_assoc($row);
}

?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Ubah Guru</h3>
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
              <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group mb-3">
                      <input type="disabled" disabled class="form-control form-control-lg bg-light fs-6" name="nip" placeholder="Nip" required value="<?= $row['nip'] ?>">
                    </div>
                    <div class="input-group mb-3">
                      <input type="email" class="form-control form-control-lg bg-light fs-6" name="email" placeholder="Email Address" required value="<?= $row['email'] ?>">
                    </div>
                    <div class="input-group mb-3">
                      <input type="password" class="form-control form-control-lg bg-light fs-6" name="password" placeholder="Password">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-lg bg-light fs-6" name="nama" placeholder="Nama" required value="<?= $row['nama'] ?>">
                    </div>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control form-control-lg bg-light fs-6" name="hp" placeholder="Telepon" required value="<?= $row['hp'] ?>">
                    </div>
                    <div class="input-group mb-3">
                      <select class="form-select bg-light fs-6" name="jk" aria-label="Default select example">
                        <option value="<?= $row['jk'] ?>"><?= $row['jk'] ?></option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                      </select>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <input type="hidden" name="gambarlama" value="<?= $row['foto'] ?>">
                    <input type="file" class="form-control" name="gambar">
                  </div>
                  <div class="col-md-12">
                    <div class="input-group mb-3">
                      <textarea name="alamat" required class="form-control bg-light fs-6" placeholder="Alamat"><?= $row['alamat'] ?></textarea>
                    </div>
                  </div>
                  <div class="col-md-12 mt-3">
                    <div class="col-md-12 d-flex justify-content-end">
                      <a href="/perpustakaan/staff/staff" class="btn btn-light me-3">Kembali</a>
                      <button type="submit" name="update" class="btn btn-primary">Simpan</button>
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

<?php include 'template/footer.php';

if (isset($_POST['update'])) {
  $nama = htmlspecialchars($_POST['nama']);
  $email = htmlspecialchars($_POST['email']);
  $jk = htmlspecialchars($_POST['jk']);
  $hp = htmlspecialchars($_POST['hp']);
  $alamat = htmlspecialchars($_POST['alamat']);
  $password = htmlspecialchars($_POST['password']);
  $gambarlama = htmlspecialchars($_POST['gambarlama']);

  if ($_FILES['gambar']['error'] == 4) {
    $gambar = $gambarlama;
  } else {
    if ($gambarlama != 'buku-default.png') {

      unlink('../assets/profile/' . $gambarlama);
    }
    $gambar = cekSampul("profile");
  }

  $queryguru = "UPDATE tbl_guru SET
            nama = '$nama',
            alamat = '$alamat',
            hp = '$hp',
            foto = '$gambar',
            jk = '$jk' WHERE nip = '$getnip'";

  if (strlen($password) > 0) {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $queryLogin = "UPDATE tbl_login SET
              email = '$email',
              password = '$password' WHERE id_anggota = '$getnip'";
  } else {
    $queryLogin = "UPDATE tbl_login SET
              email = '$email'  WHERE id_anggota = '$getnip'";
  }

  mysqli_query($con, $queryguru);
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
            document.location.href='/perpustakaan/staff/guru';
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