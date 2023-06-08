<?php
$title = "Verifikasi Siswa - Perpustakaan SMAN 3 Gowa";
$active = "siswa";
include 'template/header.php';

$rows = mysqli_query($con, "SELECT tbl_siswa.valid, tbl_siswa.nama, tbl_siswa.nis, tbl_siswa.alamat, tbl_siswa.jk, tbl_siswa.id_kelas, tbl_login.email, tbl_login.level, tbl_kelas.nama_kelas as 'kelas' FROM tbl_siswa, tbl_login, tbl_kelas WHERE tbl_siswa.nis = tbl_login.id_anggota AND tbl_siswa.id_kelas = tbl_kelas.id_kelas AND tbl_siswa.valid = 'false'")
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
            <div class="card-body">
              <table class="table mt-5 table-hover table-striped">
                <thead class="bg-primary">
                  <tr>
                    <th class="text-white" scope="col">No</th>
                    <th class="text-white" scope="col">Nama</th>
                    <th class="text-white" scope="col">Nis</th>
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
                      <td><?= $row['nis'] ?></td>
                      <td><?= $row['jk'] ?></td>
                      <td><?= $row['kelas'] ?></td>
                      <td><?= $row['alamat'] ?></td>
                      <td>
                      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $row['nis'] ?>">
                        <i class="bi bi-check-all"></i>
                      </button>
                      </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal<?= $row['nis'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <form action="" method="post">
                          <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Verifikasi Siswa</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <input type="hidden" name="nisinput" value="<?= $row['nis']?>">
                            <h5>Profil siswa</h5>
                            <ul>
                              <li>Nama : <?= $row['nama'] ?></li>
                              <li>Nis : <?= $row['nis'] ?></li>
                              <li>Jenis Kelamin : <?= $row['jk'] ?></li>
                              <li>Kelas : <?= $row['kelas'] ?></li>
                              <li>Alamat : <?= $row['alamat'] ?></li>
                            </ul>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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

if(isset($_POST['verif'])){
  $getnis = htmlspecialchars($_POST['nisinput']);

  mysqli_query($con, "UPDATE tbl_siswa set valid = 'true' WHERE nis = '$getnis'");
  if(mysqli_affected_rows($con) >= 0){
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
}

?>