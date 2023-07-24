<?php
$title = "Tambah Pinjaman - Perpustakaan SMAN 3 Gowa";
$active = "pinjaman";
include 'template/header.php';

$listbuku = mysqli_query($con, "SELECT * FROM tbl_buku WHERE jenis = 'siswa' ORDER BY id_buku DESC");
?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Tambah Peminjaman</h3>
</div>
<div class="page-content">
  <section class="row">
    <div class="col-12">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="mytext-primary mt-4 fw-bold">Peminjaman buku siswa</h3>
            </div>
            <div class="card-body">
              <form action="" method="post">
                <h5 class="text-secondary bold pt-4">Daftar buku</h5>
                <table class="table table-hover table-striped" id="dataTable2">
                  <thead class="bg-primary">
                    <tr>
                      <th class="text-white" scope="col">No</th>
                      <th class="text-white" scope="col">Judul</th>
                      <th class="text-white" scope="col">Sampul</th>
                      <th class="text-white" scope="col">Penulis</th>
                      <th class="text-white" scope="col">Penerbit</th>
                      <th class="text-white" scope="col">Stok</th>
                      <th class="text-white text-center" scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    while ($row = mysqli_fetch_assoc($listbuku)) : ?>
                      <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $row['judul'] ?></td>
                        <td><img src="<?= $pathbuku . $row['gambar'] ?>" alt="sampul-buku" style="width: 100px; object-fit: cover;"></td>
                        <td><?= $row['penulis'] ?></td>
                        <td><?= $row['penerbit'] ?></td>
                        <td><span class="<?= $row['stok'] < 1 ? 'text-danger' : '' ?>"><?= $row['stok'] ?></span></td>
                        <td class="">
                          <input type="checkbox" class="idbuku" <?= $row['stok'] < 1 ? 'disabled' : '' ?> name="buku[]" value="<?= $row['id_buku']; ?>" style="width: 30px; height: 30px; ">
                        </td>
                      </tr>
                    <?php $i++;
                    endwhile; ?>
                  </tbody>
                </table>
                <div class="row">
                  <div class="col-md-12 d-flex justify-content-end mt-3">
                    <a href="/perpustakaan/staff/pinjaman" class="btn btn-light me-3">Kembali</a>
                    <button type="submit" name="add" class="btn btn-primary">Tambah Pinjaman</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


<?php include 'template/footer.php';

if (isset($_POST["add"])) {
  $postnis = $_SESSION['id'];
  $buku = $_POST["buku"];
  $status;

  for ($i = 0; $i < count($buku); $i++) {
    $cekstok = mysqli_query($con, "SELECT stok FROM tbl_buku WHERE id_buku = '$buku[$i]'");
    $cekstok = mysqli_fetch_assoc($cekstok);

    if ($cekstok['stok'] > 0) {
      $stoknow = $cekstok['stok'] - 1;
      $querypinjam = "INSERT INTO tbl_peminjaman (id_anggota, id_buku, tgl_pinjam, status, jenis) VALUES ('$postnis','$buku[$i]', CURRENT_DATE(),'req', 'siswa')";
      mysqli_query($con, "UPDATE tbl_buku SET stok = $stoknow WHERE id_buku = '$buku[$i]'");
      $result1 = mysqli_query($con, $querypinjam);

      if ($result1) {
        $status = true;
      } else {
        $status = false;
      }
    } else {
      echo "<script>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Stok buku telah habis!',
      })
      </script>";
    }
  }

  if ($status) {
    echo "<script>
      Swal.fire({
        title: 'Berhasil menambah pinjaman',
        confirmButtonText: 'Lanjut',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          document.location.href='/perpustakaan/siswa/pinjaman';
        }
      })
      </script>";
  } else {
    echo "<script>
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Terjadi sebuah kesalahan!',
    })
    </script>";
  }
}
?>