<?php
$title = "Buku - Perpustakaan SMAN 3 Gowa";
$active = "buku";
include 'template/header.php';

$rows = mysqli_query($con, "SELECT * FROM tbl_buku");
?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Data Buku</h3>
</div>
<div class="page-content">
  <section class="row">
    <div class="col-12">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Tabel Data Buku</h4>
            </div>
            <div class="card-body" style="overflow-x: scroll;">
              <a href="/perpustakaan/staff/addbuku" class="btn btn-primary mb-3">Tambah data Buku</a>
              <table class="table mt-5 table-hover table-striped" id="dataTable">
                <thead class="bg-primary">
                  <tr>
                    <th class="text-white" scope="col">No</th>
                    <th class="text-white" scope="col">Judul</th>
                    <th class="text-white" scope="col">Sampul</th>
                    <th class="text-white" scope="col">Penulis</th>
                    <th class="text-white" scope="col">Penerbit</th>
                    <th class="text-white" scope="col">Tahun Terbit</th>
                    <th class="text-white" scope="col">Stok</th>
                    <th class="text-white text-center" scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1;
                  while ($row = mysqli_fetch_assoc($rows)) : ?>
                    <tr>
                      <th scope="row"><?= $i; ?></th>
                      <td><?= $row['judul'] ?></td>
                      <td><img src="<?= $pathbuku . $row['gambar'] ?>" alt="sampul-buku" style="width: 100px; object-fit: cover;"></td>
                      <td><?= $row['penulis'] ?></td>
                      <td><?= $row['penerbit'] ?></td>
                      <td><?= $row['tahun_terbit'] ?></td>
                      <td><?= $row['stok'] ?></td>
                      <td class="">
                        <form action="" method="post">
                          <input type="hidden" value="<?= $row['id_buku']; ?>" name="id">
                          <input type="hidden" value="<?= $row['gambar']; ?>" name="gambar">
                          <button type="submit" name="delete" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                          <a href="/perpustakaan/staff/editbuku?id=<?= $row['id_buku'] ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
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
  $idbuku = htmlspecialchars($_POST['id']);
  $gambar = htmlspecialchars($_POST['gambar']);
  mysqli_query($con, "DELETE FROM tbl_buku WHERE id_buku = '$idbuku'");
  unlink('../assets/buku/' . $gambar);
  if (mysqli_affected_rows($con) >= 0) {
    echo "<script>
      Swal.fire({
        title: 'Berhasil menghapus data',
        confirmButtonText: 'Lanjut',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          document.location.href='/perpustakaan/staff/buku';
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