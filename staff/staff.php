<?php
$title = "Staff - Perpustakaan SMAN 3 Gowa";
$active = "staff";
include 'template/header.php';

$rows = mysqli_query($con, "SELECT tbl_staff.nama, tbl_staff.nip, tbl_staff.alamat, tbl_staff.jk, tbl_login.email, tbl_login.level FROM tbl_staff, tbl_login WHERE tbl_staff.nip = tbl_login.id_anggota")
?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Data Staff</h3>
</div>
<div class="page-content">
  <section class="row">
    <div class="col-12">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Tabel Data Staff</h4>
            </div>
            <div class="card-body">
              <a href="/perpustakaan/staff/addstaff" class="btn btn-primary">Tambah data</a>
              <table class="table mt-5 table-hover table-striped">
                <thead class="bg-primary">
                  <tr>
                    <th class="text-white" scope="col">No</th>
                    <th class="text-white" scope="col">Nama</th>
                    <th class="text-white" scope="col">Nip</th>
                    <th class="text-white" scope="col">Jenis Kelamin</th>
                    <th class="text-white" scope="col">Email</th>
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
                      <td><?= $row['nip'] ?></td>
                      <td><?= $row['jk'] ?></td>
                      <td><?= $row['email'] ?></td>
                      <td><?= $row['alamat'] ?></td>
                      <td>
                        <form action="" method="post">
                          <input type="hidden" value="<?= $row['nip']; ?>" name="nip">
                          <button type="submit" name="delete" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                          <a href="/perpustakaan/staff/editstaff?nip=<?= $row['nip'] ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                          <a href="/perpustakaan/staff/detailstaff?nip=<?= $row['nip'] ?>" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
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
  if ($deletenip != $nip) {
    mysqli_query($con, "DELETE FROM tbl_staff WHERE nip = '$deletenip'");
    mysqli_query($con, "DELETE FROM tbl_login WHERE id_anggota = '$deletenip'");
    if (mysqli_affected_rows($con) >= 0) {
      echo "<script>
        Swal.fire({
          title: 'Berhasil menghapus data',
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
          text: 'Gagal menghapus data!',
        })
      </script>";
    }
  } else {
    echo "<script>
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Anda tidak dapat menghapus diri anda!',
    })
  </script>";
  }
}

?>