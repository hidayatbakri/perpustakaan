<?php
$title = "Pinjaman - Perpustakaan SMAN 3 Gowa";
$active = "pinjaman";
include 'template/header.php';

$listkelas = mysqli_query($con, "SELECT * FROM tbl_kelas");


$jenis = '';
if (isset($_GET['getJenis'])) {
  $jenis = htmlspecialchars($_GET['getJenis']);
  if ($jenis == 'siswa') {

    $rows = mysqli_query($con, "SELECT * FROM tbl_siswa, tbl_kelas, tbl_buku, tbl_peminjaman WHERE tbl_siswa.nis = tbl_peminjaman.id_anggota AND tbl_siswa.id_kelas = tbl_kelas.id_kelas AND tbl_peminjaman.jenis = '$jenis' AND (tbl_peminjaman.status = 'tidak' OR tbl_peminjaman.status = 'req') GROUP BY tbl_peminjaman.id_anggota ORDER BY tbl_peminjaman.tgl_pinjam DESC");
  } elseif ($jenis == 'guru') {

    $rows = mysqli_query($con, "SELECT * FROM tbl_guru, tbl_buku, tbl_peminjaman WHERE  tbl_peminjaman.id_anggota = tbl_guru.nip AND tbl_peminjaman.id_buku = tbl_buku.id_buku  AND tbl_peminjaman.status = 'tidak' GROUP BY tbl_peminjaman.id_anggota ORDER BY tbl_peminjaman.tgl_pinjam DESC");
  }
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
              <h4>Tabel data pinjaman <?= $jenis; ?></h4>
            </div>
            <div class="card-body" style="overflow-x: scroll;">
              <a href="/perpustakaan/staff/addpinjaman" class="btn btn-primary mb-4">Tambah data Pinjaman</a>

              <form action="" method="get">
                <div class="from-group">
                  <label for="tip">Jenis Peminjaman :</label>
                  <select name="getJenis" class="form-select" id="jenis">
                    <option value="siswa">Siswa</option>
                    <option value="guru">Guru</option>
                  </select>
                  <div class="row">
                    <div class="col d-flex justify-content-end">

                      <button class="btn btn-primary px-3 my-3" type="submit">Pilih</button>
                    </div>
                  </div>
                </div>
              </form>

              <?php if ($jenis == "siswa") : ?>
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
                          <?php if ($row['status'] == 'req') : ?>
                            <form action="" method="post">
                              <input type="hidden" name="id" value="<?= $row['id_anggota']; ?>">
                              <button name="batal" class="btn btn-secondary">Batalkan</button>
                              <button name="verif" class="btn btn-primary mx-2">Verifikasi</button>
                            </form>
                          <?php endif; ?>
                          <a href="/perpustakaan/staff/detailpinjaman?id=<?= $row['id_anggota'] ?>&jenis=<?= $row['jenis'] ?>" class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Lihat Detail</a>
                        </td>
                      </tr>
                    <?php $i++;
                    endwhile; ?>
                  </tbody>
                </table>
              <?php elseif ($jenis == 'guru') : ?>
                <table class="table mt-5 table-hover table-striped" id="dataTable">
                  <thead class="bg-primary">
                    <tr>
                      <th class="text-white" scope="col">No</th>
                      <th class="text-white" scope="col">Nama siswa</th>
                      <th class="text-white" scope="col">Nip</th>
                      <th class="text-white" scope="col">Telepon</th>
                      <th class="text-white text-end" scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    while ($row = mysqli_fetch_assoc($rows)) : ?>
                      <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['nip'] ?></td>
                        <td><?= $row['hp'] ?></td>
                        <td class="d-flex justify-content-end">
                          <a href="/perpustakaan/staff/detailpinjaman?id=<?= $row['id_anggota'] ?>&jenis=<?= $row['jenis'] ?>" class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Lihat Detail</a>
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

if (isset($_POST['verif'])) {
  $id = htmlspecialchars($_POST['id']);
  mysqli_query($con, "UPDATE tbl_peminjaman SET status = 'tidak' WHERE id_anggota = '$id' AND status = 'req'");
  if (mysqli_affected_rows($con)) {
    echo "<script>
      Swal.fire({
        title: 'Berhasil melakukan verifikasi',
        confirmButtonText: 'Lanjut',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          document.location.href='/perpustakaan/staff/pinjaman';
        }
      })
      </script>";
  }
}

?>