<?php
$title = "Guru - Perpustakaan SMAN 3 Gowa";
$active = "guru";
include 'template/header.php';

$rows = mysqli_query($con, "SELECT * FROM tbl_guru, tbl_login WHERE tbl_login.id_anggota = tbl_guru.nip AND tbl_guru.valid = 'true'");
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
              <a href="/perpustakaan/staff/addguru" class="btn btn-primary mb-3">Tambah data guru</a>
              <table class="table mt-5 table-hover table-striped" id="dataTable">
                <thead class="bg-primary">
                  <tr>
                    <th class="text-white" scope="col">No</th>
                    <th class="text-white" scope="col">Nama</th>
                    <th class="text-white" scope="col">Nip</th>
                    <th class="text-white" scope="col">Jenip Kelamin</th>
                    <th class="text-white" scope="col">Email</th>
                    <th class="text-white" scope="col">Hp</th>
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
                      <td><?= $row['email'] ?></td>
                      <td><?= $row['hp'] ?></td>
                      <td>
                        <form action="" method="post">
                          <input type="hidden" value="<?= $row['nip']; ?>" name="nip">
                          <button type="submit" name="delete" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                          <a href="/perpustakaan/staff/editguru?nip=<?= $row['nip'] ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                          <a href="/perpustakaan/staff/detailguru?nip=<?= $row['nip'] ?>" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
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
  $deletenip = htmlspecialchars($_POST['nip']);

  mysqli_query($con, "DELETE FROM tbl_guru WHERE nip = '$deletenip'");
  mysqli_query($con, "DELETE FROM tbl_login WHERE id_anggota = '$deletenip'");
  if (mysqli_affected_rows($con) >= 0) {
    echo "<script>
      Swal.fire({
        title: 'Berhasil menghapus data',
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
        text: 'Gagal menghapus data!',
      })
    </script>";
  }
}

?>