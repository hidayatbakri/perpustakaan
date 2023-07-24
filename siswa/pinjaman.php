<?php
$title = "Detail Pinjaman - Perpustakaan SMAN 3 Gowa";
$active = "pinjaman";
include 'template/header.php';
$getid = $_SESSION['id'];

$rows = mysqli_query($con, "SELECT tbl_siswa.nama, tbl_buku.judul, tbl_buku.gambar, tbl_buku.id_buku, tbl_peminjaman.tgl_pinjam, tbl_peminjaman.id_peminjaman, tbl_peminjaman.status, tbl_kelas.nama_kelas FROM tbl_siswa, tbl_kelas, tbl_buku, tbl_peminjaman WHERE tbl_peminjaman.id_anggota = tbl_siswa.nis AND tbl_peminjaman.id_buku = tbl_buku.id_buku AND tbl_siswa.id_kelas = tbl_kelas.id_kelas AND tbl_peminjaman.id_anggota = '$getid' AND (tbl_peminjaman.status = 'tidak' OR  tbl_peminjaman.status = 'req')");
$data = mysqli_query($con, "SELECT * FROM tbl_siswa, tbl_kelas WHERE tbl_siswa.id_kelas = tbl_kelas.id_kelas AND nis = '$getid'");
$data = mysqli_fetch_assoc($data);
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
              <ul>
                <li>Nama : <?= $data['nama'] ?></li>
                <li>Nis : <?= $data['nis'] ?></li>
                <li>Kelas : <?= $data['nama_kelas'] ?></li>
              </ul>
              <a href="/perpustakaan/siswa/addpinjaman" class="btn btn-primary mb-4">Tambah data Pinjaman</a>

              <table class="table mt-5 table-hover table-striped" id="dataTable">
                <thead class="bg-primary">
                  <tr>
                    <th class="text-white" scope="col">No</th>
                    <th class="text-white" scope="col">Judul Buku</th>
                    <th class="text-white" scope="col">Tanggal Pinjam</th>
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
                      <td><img src="<?= $pathbuku . $row['gambar'] ?>" alt="sampul-buku" style="width: 100px; object-fit: cover;"></td>
                      <?php if ($row['status'] == 'tidak') : ?>
                        <td class="text-warning">Belum dikembalikan</td>
                      <?php elseif ($row['status'] == 'req') : ?>
                        <td class="text-danger">Belum diverifikasi</td>
                      <?php endif; ?>
                    </tr>
                  <?php $i++;
                  endwhile; ?>
                </tbody>
              </table>
              <a href="/perpustakaan/staff/pinjaman" class="btn btn-light my-4 float-end">Kembali</a>
            </div>
          </div>
        </div>
      </div>
  </section>
</div>
</div>
<?php include 'template/footer.php';



?>