<?php
$title = "Verifikasi Guru - Perpustakaan SMAN 3 Gowa";
$active = "guru";
include 'template/header.php';

$rows = mysqli_query($con, "SELECT * FROM tbl_guru, tbl_login WHERE tbl_guru.nip = tbl_login.id_anggota AND tbl_guru.valid = 'false'");
?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Data Guru</h3>
</div>
<div class="page-content">
  <section class="row">
    <div class="col-12">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Tabel Data Guru</h4>
            </div>
            <div class="card-body" style="overflow-x: scroll;">
              <table class="table mt-5 table-hover table-striped" id="dataTable">
                <thead class="bg-primary">
                  <tr>
                    <th class="text-white" scope="col">No</th>
                    <th class="text-white" scope="col">Nama</th>
                    <th class="text-white" scope="col">Nip</th>
                    <th class="text-white" scope="col">Jenis Kelamin</th>
                    <th class="text-white" scope="col">hp</th>
                    <th class="text-white" scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1;
                  while ($row = mysqli_fetch_assoc($rows)) : ?>
                    <tr>
                      <th scope="row"><?= $i; ?></th>
                      <td><?= $row['nama'] ?></td>
                      <td><?= $row['nip'] ?></td>
                      <td><?= $row['jk'] ?></td>
                      <td><?= $row['hp'] ?></td>
                      <td>
                        <form action="" method="post">
                          <input type="hidden" name="nip" value="<?= $row['nip'] ?>">
                          <button type="submit" onclick="return confirm('Apakah anda yakin?')" name="delete" class="btn btn-danger">
                            <i class="bi bi-x-circle"></i>
                          </button>
                          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $row['nip'] ?>">
                            <i class="bi bi-check-all"></i>
                          </button>
                        </form>
                      </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal<?= $row['nip'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-scrollable">
                        <form action="" method="post">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Verifikasi Guru</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <input type="hidden" name="nipinput" value="<?= $row['nip'] ?>">
                              <h5>Profil guru</h5>
                              <div class="d-flex justify-content-center my-5">
                                <img class="rounded" src="../assets/profile/<?= $row['foto'] ?>" style="width: 150px; height: 180px; object-fit: cover;" alt="">
                              </div>
                              <ul>
                                <li>Nama : <?= $row['nama'] ?></li>
                                <li>Nip : <?= $row['nip'] ?></li>
                                <li>Jenis Kelamin : <?= $row['jk'] ?></li>
                                <li>Telepon : <?= $row['hp'] ?></li>
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
  $getnip = htmlspecialchars($_POST['nipinput']);

  mysqli_query($con, "UPDATE tbl_guru set valid = 'true' WHERE nip = '$getnip'");
  if (mysqli_affected_rows($con) >= 0) {
    echo "<script>
      Swal.fire({
        title: 'Berhasil verifikasi guru',
        confirmButtonText: 'Lanjut',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          document.location.href='/perpustakaan/staff/verifguru';
        }
      })
    </script>";
  } else {
    echo "<script>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Gagal verifikasi guru!',
      })
    </script>";
  }
} elseif (isset($_POST['delete'])) {
  $nip = htmlspecialchars($_POST['nip']);
  mysqli_query($con, "DELETE FROM tbl_guru WHERE nip = '$nip'");
  mysqli_query($con, "DELETE FROM tbl_login WHERE id_anggota = '$nip'");

  if (mysqli_affected_rows($con)) {
    echo "<script>
      Swal.fire({
        title: 'Berhasil menghapus data',
        confirmButtonText: 'Lanjut',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          document.location.href='/perpustakaan/staff/verifguru';
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