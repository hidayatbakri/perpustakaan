<?php
$title = "Struktur - Perpustakaan SMAN 3 Gowa";
$active = "struktur";
include 'template/header.php';

$rows = mysqli_query($con, "SELECT * FROM tbl_struktur, tbl_jabatan WHERE tbl_jabatan.id_jabatan = tbl_struktur.id_jabatan ORDER BY tingkat ASC");
?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Struktur Perpustakaan</h3>
</div>
<div class="page-content">
  <section class="row">
    <div class="col-12">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Tabel Data Struktur</h4>
            </div>
            <div class="card-body" style="overflow-x: scroll;">
              <a href="/perpustakaan/staff/addstruktur" class="btn btn-primary mb-3">Tambah data struktur</a>
              <table class="table mt-5 table-hover table-striped" id="dataTable">
                <thead class="bg-primary">
                  <tr>
                    <th class="text-white" scope="col">No</th>
                    <th class="text-white" scope="col">Nama</th>
                    <th class="text-white" scope="col">Jabatan</th>
                    <th class="text-white text-end" scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1;
                  while ($row = mysqli_fetch_assoc($rows)) : ?>
                    <tr>
                      <th scope="row"><?= $i; ?></th>
                      <td><?= $row['nama'] ?></td>
                      <td><?= $row['nama_jabatan'] ?></td>
                      <td class="d-flex justify-content-end">
                        <form action="" method="post">
                          <input type="hidden" value="<?= $row['foto']; ?>" name="gambar">  
                          <input type="hidden" value="<?= $row['id_struktur']; ?>" name="id">
                          <button type="submit" name="delete" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                          <a href="/perpustakaan/staff/editstruktur?id=<?= $row['id_struktur'] ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                          <a href="/perpustakaan/staff/detailstruktur?id=<?= $row['id_struktur'] ?>" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
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
  </section>
</div>
</div>
<?php include 'template/footer.php';

if (isset($_POST['delete'])) {
  $id = htmlspecialchars($_POST['id']);
  $gambar = htmlspecialchars($_POST['gambar']);
  unlink('../assets/struktur/' . $gambar);
  mysqli_query($con, "DELETE FROM tbl_struktur WHERE id_struktur = '$id'");
  if (mysqli_affected_rows($con) >= 0) {
    echo "<script>
      Swal.fire({
        title: 'Berhasil menghapus data',
        confirmButtonText: 'Lanjut',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          document.location.href='/perpustakaan/staff/struktur';
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