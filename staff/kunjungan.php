<?php
$title = "Kunjungan - Perpustakaan SMAN 3 Gowa";
$active = "kunjungan";
include 'template/header.php';

$rows = mysqli_query($con, "SELECT * FROM tbl_kunjungan");
?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Data kunjungan</h3>
</div>
<div class="page-content">
  <section class="row">
    <div class="col-12">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Tabel Data kunjungan</h4>
            </div>
            <div class="card-body" style="overflow-x: scroll;">
              <a href="/perpustakaan/staff/addkunjungan" class="btn btn-primary mb-3">Tambah data kunjungan</a>
              <table class="table mt-5 table-hover table-striped" id="dataTable">
                <thead class="bg-primary">
                  <tr>
                    <th class="text-white" scope="col">No</th>
                    <th class="text-white" scope="col">Hari/Tgl</th>
                    <th class="text-white" scope="col">Nama</th>
                    <th class="text-white" scope="col">Baca</th>
                    <th class="text-white" scope="col">Pinjam</th>
                    <th class="text-white" scope="col">Alamat</th>
                    <th class="text-white" scope="col">NO.HP</th>
                    <th class="text-white" scope="col">Keterangan</th>
                    <!-- <th class="text-white text-end" scope="col">Aksi</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1;
                  while ($row = mysqli_fetch_assoc($rows)) : ?>
                    <tr>
                      <th scope="row"><?= $i; ?></th>
                      <td><?= $row['tgl_kunjungan'] ?></td>
                      <td><?= $row['nama'] ?></td>
                      <td><?= $row['baca'] ?></td>
                      <td><?= $row['pinjam'] ?></td>
                      <td><?= $row['alamat'] ?></td>
                      <td><?= $row['hp'] ?></td>
                      <td><?= $row['keterangan'] ?></td>
                      <!-- <td class="d-flex justify-content-end">
                        <form action="" method="post">
                          <input type="hidden" value="<?= $row['id_kunjungan']; ?>" name="id">
                          <button type="submit" name="delete" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                          <a href="/perpustakaan/staff/editkunjungan?id=<?= $row['id_kunjungan'] ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                        </form>
                      </td> -->
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
  $idkunjungan = htmlspecialchars($_POST['id']);

  mysqli_query($con, "DELETE FROM tbl_kunjungan WHERE id_kunjungan = '$idkunjungan'");
  if (mysqli_affected_rows($con) >= 0) {
    echo "<script>
      Swal.fire({
        title: 'Berhasil menghapus data',
        confirmButtonText: 'Lanjut',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          document.location.href='/perpustakaan/staff/kunjungan';
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