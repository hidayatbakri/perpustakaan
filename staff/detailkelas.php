<?php
$title = "Kelas - Perpustakaan SMAN 3 Gowa";
$active = "kelas";
include 'template/header.php';
$id = htmlspecialchars($_GET['id']);
$kelas = mysqli_query($con, "SELECT * FROM tbl_kelas WHERE id_kelas = '$id'");
$kelas = mysqli_fetch_assoc($kelas);
$listkelas = mysqli_query($con, "SELECT * FROM tbl_kelas");
$rows = mysqli_query($con, "SELECT * FROM tbl_siswa, tbl_login, tbl_kelas WHERE tbl_siswa.nisn = tbl_login.id_anggota AND tbl_siswa.id_kelas = tbl_kelas.id_kelas AND tbl_siswa.valid = 'true' AND tbl_kelas.id_kelas = '$id'")
?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Detail Kelas</h3>
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
              <form action="" method="post">
                <div class="d-flex justify-content-end mb-3">
                  <div class="form-check">
                    <input class="form-check-input" id="checkAll" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      Centang semua
                    </label>
                  </div>
                </div>
                <table class="table mt-5 table-hover table-striped" id="dataTable">
                  <thead class="bg-primary">
                    <tr>
                      <th class="text-white" scope="col">No</th>
                      <th class="text-white" scope="col">Nama</th>
                      <th class="text-white" scope="col">Nisn</th>
                      <th class="text-white" scope="col">Jenis Kelamin</th>
                      <th class="text-white" scope="col">Kelas</th>
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
                        <td><?= $row['nama_kelas'] ?></td>
                        <td>
                          <div class="form-check">
                            <input class="form-check-input" value="<?= $row['nisn'] ?>" type="checkbox" name="siswa[]" id="flexCheckDefault">
                          </div>
                        </td>
                      </tr>
                    <?php $i++;
                    endwhile; ?>
                  </tbody>
                </table>
                <div class="form-group my-3">
                  <select class="form-select" name="kelas" aria-label="Default select example" required>
                    <option selected>Pilih Kelas</option>
                    <?php while ($kls = mysqli_fetch_assoc($listkelas)) : ?>
                      <option value="<?= $kls['id_kelas'] ?>">Kelas <?= $kls['nama_kelas'] ?></option>
                    <?php endwhile; ?>
                  </select>
                </div>
                <div class="d-flex justify-content-end">
                  <a href="/perpustakaan/staff/kelas" class="btn btn-light me-2">Kembali</a>
                  <button class="btn btn-primary" name="ubah">Ubah Kelas</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  $("#checkAll").click(function() {
    $('input:checkbox').not(this).prop('checked', this.checked);
  });
</script>

<?php include 'template/footer.php';

if (isset($_POST['ubah'])) {
  $siswa = $_POST['siswa'];
  $kelas = htmlspecialchars($_POST['kelas']);
  for ($i = 0; $i < count($siswa); $i++) {
    $siswa[$i] = htmlspecialchars($siswa[$i]);
    mysqli_query($con, "UPDATE tbl_siswa SET id_kelas = '$kelas' WHERE nisn = '$siswa[$i]'");
  }

  if (mysqli_affected_rows($con) >= 0) {
    echo "<script>
    Swal.fire({
      title: 'Berhasil mengubah data',
      confirmButtonText: 'Lanjut',
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        document.location.href='/perpustakaan/staff/kelas';
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