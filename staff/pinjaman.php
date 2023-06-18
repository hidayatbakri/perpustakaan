<?php
$title = "Pinjaman - Perpustakaan SMAN 3 Gowa";
$active = "pinjaman";
include 'template/header.php';
mysqli_query($con, "SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");

$listkelas = mysqli_query($con, "SELECT * FROM tbl_kelas");
if (isset($_GET['getkelas'])) {
  $getkelas = htmlspecialchars($_GET['getkelas']);

  $rows = mysqli_query($con, "SELECT tbl_siswa.nama, tbl_peminjaman.id_anggota, tbl_peminjaman.tgl_pinjam, tbl_peminjaman.id_peminjaman, tbl_peminjaman.status, tbl_kelas.nama_kelas FROM tbl_siswa, tbl_kelas, tbl_buku, tbl_peminjaman WHERE tbl_kelas.id_kelas = '$getkelas' AND tbl_peminjaman.id_anggota = tbl_siswa.nis AND tbl_peminjaman.id_buku = tbl_buku.id_buku AND tbl_siswa.id_kelas = tbl_kelas.id_kelas GROUP BY tbl_peminjaman.id_anggota ORDER BY tbl_peminjaman.tgl_pinjam DESC");
  // $listsiswa = mysqli_query($con, "SELECT * FROM tbl_siswa WHERE id_kelas = '$getkelas' AND valid = 'true'");
  // $listbuku = mysqli_query($con, "SELECT * FROM tbl_buku");
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
              <a href="/perpustakaan/staff/addpinjaman" class="btn btn-primary mb-4">Tambah data Pinjaman</a>
              <form action="" method="get">
                <div class="row mb-3">
                  <div class="col-md-12">
                    <div class="input-group mb-3">
                      <select class="form-select bg-light fs-6" name="getkelas" aria-label="Default select example">
                        <option selected>Pilih Kelas</option>
                        <?php while ($kelas = mysqli_fetch_assoc($listkelas)) : ?>
                          <option value="<?= $kelas['id_kelas'] ?>"><?= $kelas['nama_kelas'] ?></option>
                        <?php endwhile; ?>
                      </select>
                    </div>
                    <button class="btn btn-primary float-end" type="submit">Cari Kelas</button>
                  </div>
                </div>
              </form>
              <?php
              if (isset($_GET['getkelas'])) :
              ?>
                <table class="table mt-5 table-hover table-striped" id="dataTable">
                  <thead class="bg-primary">
                    <tr>
                      <th class="text-white" scope="col">No</th>
                      <th class="text-white" scope="col">Nama siswa</th>
                      <th class="text-white" scope="col">Kelas</th>
                      <th class="text-white text-end" scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    while ($row = mysqli_fetch_assoc($rows)) : ?>
                      <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['nama_kelas'] ?></td>
                        <td class="d-flex justify-content-end">
                          <a href="/perpustakaan/staff/detailpinjaman?id=<?= $row['id_anggota'] ?>" class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Detail</a>
                        </td>
                      </tr>
                    <?php $i++;
                    endwhile; ?>
                  </tbody>
                </table>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
  </section>
</div>
</div>
<?php include 'template/footer.php';



?>