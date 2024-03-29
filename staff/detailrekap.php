<?php
$title = "Detail Rekap - Perpustakaan SMAN 3 Gowa";
$active = "rekap";
include 'template/header.php';
$getnis = htmlspecialchars($_GET['id']);
$rows = mysqli_query($con, "SELECT tbl_siswa.nama, tbl_peminjaman.tgl_kembali, tbl_buku.judul, tbl_buku.gambar, tbl_buku.id_buku, tbl_peminjaman.tgl_pinjam, tbl_peminjaman.id_peminjaman, tbl_peminjaman.status, tbl_kelas.nama_kelas FROM tbl_siswa, tbl_kelas, tbl_buku, tbl_peminjaman WHERE tbl_peminjaman.id_anggota = '$getnis' AND tbl_peminjaman.id_anggota = tbl_siswa.nis AND tbl_peminjaman.id_buku = tbl_buku.id_buku AND tbl_siswa.id_kelas = tbl_kelas.id_kelas AND tbl_peminjaman.status = 'ya'");
$datasiswa = mysqli_query($con, "SELECT * FROM tbl_siswa, tbl_kelas WHERE tbl_siswa.id_kelas = tbl_kelas.id_kelas AND nis = '$getnis'");
$datasiswa = mysqli_fetch_assoc($datasiswa);
?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Data Rekap</h3>
</div>
<div class="page-content">
  <section class="row">
    <div class="col-12">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Tabel Data Rekap</h4>
            </div>
            <div class="card-body" style="overflow-x: scroll;">
              <ul>
                <li>Nama : <?= $datasiswa['nama'] ?></li>
                <li>Nis : <?= $datasiswa['nis'] ?></li>
                <li>Kelas : <?= $datasiswa['nama_kelas'] ?></li>
              </ul>
              <table class="table mt-5 table-hover table-striped" id="dataTable">
                <thead class="bg-primary">
                  <tr>
                    <th class="text-white" scope="col">No</th>
                    <th class="text-white" scope="col">Judul Buku</th>
                    <th class="text-white" scope="col">Tanggal Pinjam</th>
                    <th class="text-white" scope="col">Tanggal Kembali</th>
                    <th class="text-white" scope="col">Sampul</th>
                    <th class="text-white" scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1;
                  while ($row = mysqli_fetch_assoc($rows)) : ?>
                    <tr>
                      <th scope="row"><?= $i; ?></th>
                      <td><?= $row['judul'] ?></td>
                      <td><?= $row['tgl_pinjam'] ?></td>
                      <td><?= $row['tgl_kembali'] ?></td>
                      <td><img src="<?= $pathbuku . $row['gambar'] ?>" alt="sampul-buku" style="width: 100px; object-fit: cover;"></td>
                      <td class="<?= $row['status'] == 'tidak' ? 'text-danger' : 'text-success' ?>"><?= $row['status'] == "tidak" ? "Belum dikembalikan" : "Dikembalikan" ?></td>
                    </tr>
                  <?php $i++;
                  endwhile; ?>
                </tbody>
              </table>
              <a href="/perpustakaan/staff/rekappinjaman" class="btn btn-light my-4 float-end">Kembali</a>
            </div>
          </div>
        </div>
      </div>
  </section>
</div>
</div>
<?php include 'template/footer.php';

if (isset($_POST['verif'])) {
  $idpinjaman = htmlspecialchars($_POST['id']);
  $buku = htmlspecialchars($_POST["buku"]);

  $cekstok = mysqli_query($con, "SELECT stok FROM tbl_buku WHERE id_buku = '$buku'");
  $cekstok = mysqli_fetch_assoc($cekstok);
  $stoknow = $cekstok['stok'] + 1;
  mysqli_query($con, "UPDATE tbl_buku SET stok = $stoknow WHERE id_buku = '$buku'");
  mysqli_query($con, "UPDATE tbl_peminjaman set status = 'ya', tgl_kembali = CURRENT_DATE() WHERE id_peminjaman = '$idpinjaman'");
  if (mysqli_affected_rows($con) >= 0) {
    echo "<script>
      Swal.fire({
        title: 'Berhasil menyelesaikan pinjaman',
        confirmButtonText: 'Lanjut',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          document.location.href='';
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