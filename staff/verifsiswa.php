<?php
$title = "Verifikasi Siswa - Perpustakaan SMAN 3 Gowa";
$active = "siswa";
include 'template/header.php';

$rows = mysqli_query($con, "SELECT tbl_siswa.foto, tbl_siswa.valid, tbl_siswa.nama, tbl_siswa.nisn, tbl_siswa.alamat, tbl_siswa.jk, tbl_siswa.id_kelas, tbl_login.email, tbl_login.level, tbl_kelas.nama_kelas as 'kelas' FROM tbl_siswa, tbl_login, tbl_kelas WHERE tbl_siswa.nisn = tbl_login.id_anggota AND tbl_siswa.id_kelas = tbl_kelas.id_kelas AND tbl_siswa.valid = 'false'")
?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Data Siswa</h3>
</div>
<div class="page-content">
  <section class="row">
    <div class="col-12">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Tabel Data Siswa</h4>
            </div>
            <div class="card-body" style="overflow-x: scroll;">
              <table class="table mt-5 table-hover table-striped" id="dataTable">
                <thead class="bg-primary">
                  <tr>
                    <th class="text-white" scope="col">No</th>
                    <th class="text-white" scope="col">Nama</th>
                    <th class="text-white" scope="col">Nisn</th>
                    <th class="text-white" scope="col">Jenis Kelamin</th>
                    <th class="text-white" scope="col">Kelas</th>
                    <th class="text-white" scope="col">Alamat</th>
                    <th class="text-white" scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1;
                  while ($row = mysqli_fetch_assoc($rows)) : ?>
                    <tr>
                      <th scope="row"><?= $i; ?></th>
                      <td><?= $row['nama'] ?></td>
                      <td><?= $row['nisn'] ?></td>
                      <td><?= $row['jk'] ?></td>
                      <td><?= $row['kelas'] ?></td>
                      <td><?= $row['alamat'] ?></td>
                      <td>
                        <form action="" method="post">
                          <input type="hidden" name="nisn" value="<?= $row['nisn'] ?>">
                          <button type="submit" onclick="return confirm('Apakah anda yakin?')" name="delete" class="btn btn-danger">
                            <i class="bi bi-x-circle"></i>
                          </button>
                          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $row['nisn'] ?>">
                            <i class="bi bi-check-all"></i>
                          </button>
                        </form>
                      </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal<?= $row['nisn'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-scrollable">
                        <form action="" method="post">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Verifikasi Siswa</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <input type="hidden" name="nisninput" value="<?= $row['nisn'] ?>">
                              <h5>Profil siswa</h5>
                              <div class="d-flex justify-content-center my-5">
                                <img class="rounded" src="../assets/profile/<?= $row['foto'] ?>" style="width: 150px; height: 180px; object-fit: cover;" alt="">
                              </div>
                              <ul>
                                <li>Nama : <?= $row['nama'] ?></li>
                                <li>Nisn : <?= $row['nisn'] ?></li>
                                <li>Jenis Kelamin : <?= $row['jk'] ?></li>
                                <li>Kelas : <?= $row['kelas'] ?></li>
                                <li>Alamat : <?= $row['alamat'] ?></li>
                              </ul>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                              <button type="submit" name="verif" class="btn btn-primary">Verifikasi</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  <?php $i++;
                  endwhile; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>






<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php include 'template/footer.php';

if (isset($_POST['verif'])) {
  $getnisn = htmlspecialchars($_POST['nisninput']);

  mysqli_query($con, "UPDATE tbl_siswa set valid = 'true' WHERE nisn = '$getnisn'");
  if (mysqli_affected_rows($con) >= 0) {
    echo "<script>
      Swal.fire({
        title: 'Berhasil verifikasi siswa',
        confirmButtonText: 'Lanjut',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          document.location.href='/perpustakaan/staff/verifsiswa';
        }
      })
    </script>";
  } else {
    echo "<script>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Gagal verifikasi siswa!',
      })
    </script>";
  }
} elseif (isset($_POST['delete'])) {
  $nisn = htmlspecialchars($_POST['nisn']);
  mysqli_query($con, "DELETE FROM tbl_siswa WHERE nisn = '$nisn'");
  mysqli_query($con, "DELETE FROM tbl_login WHERE id_anggota = '$nisn'");

  if (mysqli_affected_rows($con)) {
    echo "<script>
      Swal.fire({
        title: 'Berhasil menghapus data',
        confirmButtonText: 'Lanjut',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          document.location.href='/perpustakaan/staff/verifsiswa';
        }
      })
    </script>";
  } else {
    echo "<script>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Gagal menghapus data!',
      })
    </script>";
  }
}

?>