<?php
$title = "Pengaturan - Perpustakaan SMAN 3 Gowa";
$active = "pengaturan";
include 'template/header.php';
$profile = mysqli_query($con, "SELECT * from tbl_profile LIMIT 1");
?>

<style>
  iframe {
    height: 180px !important;
    margin: 0;
    padding: 0;
    border-radius: 8px;
    width: 100%;
  }
</style>

<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Profile</h3>
</div>
<div class="page-content">
  <section class="row">
    <div class="col-md-8 col-sm-12">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Data profile website perpustakaan</h4>
            </div>
            <div class="card-body pt-3">
              <?php while ($row = mysqli_fetch_assoc($profile)) : ?>
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">
                        <div class="d-flex justify-content-center mb-3">
                          <img src="../assets/logo/<?= $row['logo'] ?>" width="90" alt="">
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">Nama Sekolah</th>
                      <td><?= $row['nama_sekolah']; ?></td>
                    </tr>
                    <tr>
                      <th scope="row">Nama Perpustakaan</th>
                      <td><?= $row['nama_perpus']; ?></td>
                    </tr>
                    <tr>
                      <th scope="row">Motto</th>
                      <td><?= $row['motto']; ?></td>
                    </tr>
                    <tr>
                      <th scope="row">Email</th>
                      <td><?= $row['email']; ?></td>
                    </tr>
                    <tr>
                      <th scope="row">Alamat</th>
                      <td><?= $row['alamat']; ?></td>
                    </tr>
                    <tr>
                      <th colspan="2" scope="row">Map / Lokasi</th>
                    </tr>
                    <tr>
                      <td colspan="2" class="p-0">
                        <div class="card border-0 w-100">
                          <div class="card-body">
                            <?= $row['map']; ?>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>

                <!-- modal edit -->
                <div class="modal fade" id="editData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="" method="post" enctype="multipart/form-data">

                        <div class="modal-body">
                          <div class="form-floating mb-3">
                            <input type="hidden" class="form-control" name="id" id="floatingInput" value="<?= $row['id_profile']; ?>">
                            <input type="text" class="form-control" name="sekolah" id="floatingInput" value="<?= $row['nama_sekolah']; ?>">
                            <label for="floatingInput">Nama sekolah</label>
                          </div>
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="perpus" id="floatingInput" value="<?= $row['nama_perpus']; ?>">
                            <label for="floatingInput">Nama perpustakaan</label>
                          </div>
                          <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" id="floatingInput" value="<?= $row['email']; ?>">
                            <label for="floatingInput">Email</label>
                          </div>
                          <div class="form-floating mb-3">
                            <textarea name="motto" class="form-control"><?= $row['motto'] ?></textarea>
                            <label for="floatingInput">Motto</label>
                          </div>
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="alamat" id="floatingInput" value="<?= $row['alamat']; ?>">
                            <label for="floatingInput">Alamat</label>
                          </div>
                          <div class="form-floating mb-2">
                            <input type="text" class="form-control" name="map" id="floatingInput" value="<?= htmlspecialchars($row['map']); ?>">
                            <label for="floatingInput">Map / Lokasi</label>
                          </div>
                          <a class="mb-4" href="./petunjuk-map">Cara menambah lokasi</a>
                          <div class="form-group mb-3">
                            <input type="hidden" name="gambarlama" value="<?= $row['logo'] ?>">
                            <label>Logo</label>
                            <input type="file" class="form-control" name="gambar">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" name="update" class="btn btn-primary">Simpan</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              <?php endwhile; ?>
              <div class="d-flex justify-content-end">
                <?php if (!mysqli_num_rows($profile)) : ?>
                  <button type="button" class="btn btn-primary mt-5 me-3" data-bs-toggle="modal" data-bs-target="#addData">
                    Tambah Profil
                  </button>
                <?php else : ?>
                  <button type="button" class="btn btn-primary mt-5 me-3" data-bs-toggle="modal" data-bs-target="#editData">
                    Ubah Profil
                  </button>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php include 'template/footer.php';

if (isset($_POST['update'])) {
  $id = htmlspecialchars($_POST['id']);
  $sekolah = htmlspecialchars($_POST['sekolah']);
  $perpus = htmlspecialchars($_POST['perpus']);
  $email = htmlspecialchars($_POST['email']);
  $motto = htmlspecialchars($_POST['motto']);
  $alamat = htmlspecialchars($_POST['alamat']);
  $map = $_POST['map'];
  $gambarlama = htmlspecialchars($_POST['gambarlama']);

  if ($_FILES['gambar']['error'] == 4) {
    $gambar = $gambarlama;
  } else {
    unlink('../assets/logo/' . $gambarlama);
    $gambar = cekSampul("logo");
  }

  mysqli_query($con, "UPDATE tbl_profile SET
              nama_sekolah = '$sekolah',
              nama_perpus = '$perpus',
              email = '$email',
              motto = '$motto',
              alamat = '$alamat',
              map = '$map',
              logo = '$gambar' WHERE id_profile = '$id'");
  if (mysqli_affected_rows($con)) {
    echo "<script>
      Swal.fire({
        title: 'Berhasil update profile perpustakaan',
        confirmButtonText: 'Lanjut',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          document.location.href='/perpustakaan/staff/pengaturan';
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
    // echo mysqli_error($con);
  }
}

?>
<?php if (!mysqli_num_rows($profile)) : ?>

  <!-- Modal -->
  <div class="modal fade" id="addData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="post" enctype="multipart/form-data">

          <div class="modal-body">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" name="sekolah" id="floatingInput" placeholder="name@example.com">
              <label for="floatingInput">Nama sekolah</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" name="perpus" id="floatingInput" placeholder="name@example.com">
              <label for="floatingInput">Nama perpustakaan</label>
            </div>
            <div class="form-floating mb-3">
              <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
              <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating mb-3">
              <textarea name="motto" class="form-control"></textarea>
              <label for="floatingInput">Motto</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" name="alamat" id="floatingInput" placeholder="name@example.com">
              <label for="floatingInput">Alamat</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" name="map" id="floatingInput" placeholder="name@example.com">
              <label for="floatingInput">Map / Lokasi</label>
            </div>
            <div class="form-group mb-3">
              <label>Logo</label>
              <input type="file" class="form-control" name="gambar">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" name="add" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php

  if (isset($_POST['add'])) {
    $sekolah = htmlspecialchars($_POST['sekolah']);
    $perpus = htmlspecialchars($_POST['perpus']);
    $email = htmlspecialchars($_POST['email']);
    $motto = htmlspecialchars($_POST['motto']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $map = $_POST['map'];

    $gambar = cekSampul("logo");
    $result = mysqli_query($con, "INSERT INTO tbl_profile (nama_sekolah, nama_perpus, logo, email, motto, alamat, map) VALUES ('$sekolah', '$perpus', '$gambar', '$email', '$motto', '$alamat', '$map')");

    if ($result) {
      echo "<script>
        Swal.fire({
          title: 'Berhasil menambah profile perpustakaan',
          confirmButtonText: 'Lanjut',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            document.location.href='/perpustakaan/staff/pengaturan';
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


endif; ?>