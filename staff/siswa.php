<?php
$title = "Siswa - Perpustakaan SMAN 3 Gowa";
$active = "siswa";
include 'template/header.php';

$rows = mysqli_query($con, "SELECT tbl_siswa.valid, tbl_siswa.nama, tbl_siswa.nis, tbl_siswa.alamat, tbl_siswa.jk, tbl_siswa.id_kelas, tbl_login.email, tbl_login.level, tbl_kelas.nama_kelas as 'kelas' FROM tbl_siswa, tbl_login, tbl_kelas WHERE tbl_siswa.nis = tbl_login.id_anggota AND tbl_siswa.id_kelas = tbl_kelas.id_kelas AND tbl_siswa.valid = 'true'")
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
            <a href="/perpustakaan/staff/addsiswa" class="btn btn-primary">Tambah data siswa</a>
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
                        <form action="" method="post">
                          <input type="hidden" value="<?= $row['nis']; ?>" name="nis">
                          <button type="submit" name="delete" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                          <a href="/perpustakaan/staff/editsiswa?nis=<?= $row['nis'] ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                          <a href="/perpustakaan/staff/detailsiswa?nis=<?= $row['nis'] ?>" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
                        </form>
                      </td>
                    </tr>
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
<?php include 'template/footer.php'; 

if (isset($_POST['delete'])) {
  $deletenis = htmlspecialchars($_POST['nis']);

  mysqli_query($con, "DELETE FROM tbl_siswa WHERE nis = '$deletenis'");
  mysqli_query($con, "DELETE FROM tbl_login WHERE id_anggota = '$deletenis'");
  if (mysqli_affected_rows($con) >= 0) {
    echo "<script>
      Swal.fire({
        title: 'Berhasil menghapus data',
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
        text: 'Gagal menghapus data!',
      })
    </script>";
  }
}

?>