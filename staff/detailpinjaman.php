<?php
$title = "Detail Pinjaman - Perpustakaan SMAN 3 Gowa";
$active = "pinjaman";
include 'template/header.php';
$getid = htmlspecialchars($_GET['id']);
$getjenis = htmlspecialchars($_GET['jenis']);

if ($getjenis == 'siswa') {
  $rows = mysqli_query($con, "SELECT tbl_siswa.nama, tbl_buku.judul, tbl_buku.gambar, tbl_buku.id_buku, tbl_peminjaman.tgl_pinjam, tbl_peminjaman.id_peminjaman, tbl_peminjaman.status, tbl_kelas.nama_kelas FROM tbl_siswa, tbl_kelas, tbl_buku, tbl_peminjaman WHERE tbl_peminjaman.id_anggota = '$getid' AND tbl_peminjaman.id_anggota = tbl_siswa.nis AND tbl_peminjaman.id_buku = tbl_buku.id_buku AND tbl_siswa.id_kelas = tbl_kelas.id_kelas AND (tbl_peminjaman.status = 'tidak' OR tbl_peminjaman.status = 'req')");
  $data = mysqli_query($con, "SELECT * FROM tbl_siswa, tbl_kelas WHERE tbl_siswa.id_kelas = tbl_kelas.id_kelas AND nis = '$getid'");
  $data = mysqli_fetch_assoc($data);
} elseif ($getjenis == 'guru') {
  $rows = mysqli_query($con, "SELECT * FROM tbl_guru, tbl_buku, tbl_peminjaman WHERE  tbl_peminjaman.id_anggota = '$getid' AND tbl_peminjaman.id_buku = tbl_buku.id_buku  AND tbl_peminjaman.status = 'tidak' ORDER BY tbl_peminjaman.tgl_pinjam DESC");
  $data = mysqli_query($con, "SELECT * FROM tbl_guru WHERE nip = '$getid'");
  $data = mysqli_fetch_assoc($data);
}
?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Data Pinjaman</h3>
</div>
<div class="page-content">
  <section class="row">
    <div class="col-12">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Tabel Data Pinjaman</h4>
            </div>
            <div class="card-body" style="overflow-x: scroll;">
              <?php if ($getjenis == 'siswa') : ?>
                <ul>
                  <li>Nama : <?= $data['nama'] ?></li>
                  <li>Nis : <?= $data['nis'] ?></li>
                  <li>Kelas : <?= $data['nama_kelas'] ?></li>
                </ul>


              <?php elseif ($getjenis == 'guru') : ?>
                <ul>
                  <li>Nama : <?= $data['nama'] ?></li>
                  <li>Nip : <?= $data['nip'] ?></li>
                  <li>Telepon : <?= $data['hp'] ?></li>
                </ul>
              <?php endif; ?>
              <form action="" method="post">
                <table class="table mt-5 table-hover table-striped" id="dataTable">
                  <thead class="bg-primary">
                    <tr>
                      <th class="text-white" scope="col">No</th>
                      <th class="text-white" scope="col">Judul Buku</th>
                      <th class="text-white" scope="col">Tanggal Pinjam</th>
                      <th class="text-white" scope="col">Sampul</th>
                      <th class="text-white" scope="col">Status</th>
                      <th class="text-white" scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    while ($row = mysqli_fetch_assoc($rows)) : ?>
                      <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $row['judul'] ?></td>
                        <td><?= $row['tgl_pinjam'] ?></td>
                        <td><img src="<?= $pathbuku . $row['gambar'] ?>" alt="sampul-buku" style="width: 100px; object-fit: cover;"></td>
                        <?php if ($row['status'] == 'tidak') : ?> <td class="text-warning">Belum dikembalikan</td>
                        <?php elseif ($row['status'] == 'req') : ?>
                          <td class="text-danger">Belum diverifikasi</td>
                        <?php endif; ?>
                        <td class="">
                          <?php if ($row['status'] == 'tidak') : ?>
                            <div>
                              <input class="form-check-input" name="id[]" type="checkbox" id="checkboxNoLabel" value="<?= $row['id_peminjaman'] ?>" style="width: 30px; height: 30px;">
                            </div>
                            <!-- <input type="text" value="<?= $row['id_peminjaman']; ?>" name="id">
                            <input type="text" value="<?= $row['id_buku']; ?>" name="buku">
                            <button type="submit" name="verif" class="btn btn-success btn-sm" onclick="return confirm(`Selesaikan peminjaman <?= $row['judul'] ?>?`)"><i class="bi bi-check"></i> Selesai</button> -->
                          <?php endif; ?>
                        </td>
                      </tr>
                    <?php $i++;
                    endwhile; ?>
                  </tbody>
                </table>
                <div class="d-flex justify-content-end mt-4">
                  <a href="/perpustakaan/staff/pinjaman" class="btn btn-light">Kembali</a>
                  <button name="submit" class="btn btn-primary ms-3">Selesaikan Peminjaman</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </section>
</div>
</div>
<?php include 'template/footer.php';

if (isset($_POST['submit'])) {
  if (!isset($_POST['id'])) {
    echo "<script>
      Swal.fire({
        title: 'Pilih peminjaman terlebih dahulu',
        confirmButtonText: 'Oke',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          document.location.href='';
        }
      })
    </script>";
    exit;
  }
  $id = $_POST['id'];

  for ($i = 0; $i < count($id); $i++) {
    $id[$i] = htmlspecialchars($id[$i]);
    $row = mysqli_query($con, "SELECT * FROM tbl_peminjaman WHERE id_peminjaman = '$id[$i]'");
    $row = mysqli_fetch_assoc($row);
    $buku = $row['id_buku'];
    $cekstok = mysqli_query($con, "SELECT stok FROM tbl_buku WHERE id_buku = '$buku'");
    $cekstok = mysqli_fetch_assoc($cekstok);
    $stoknow = $cekstok['stok'] + 1;
    mysqli_query($con, "UPDATE tbl_buku SET stok = $stoknow WHERE id_buku = '$buku'");

    mysqli_query($con, "UPDATE tbl_peminjaman set status = 'ya', tgl_kembali = CURRENT_DATE() WHERE id_peminjaman = '$id[$i]'");
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
}

?>