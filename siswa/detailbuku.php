<?php
$title = "Detail Buku - Perpustakaan SMAN 3 Gowa";
$active = "buku";
include 'template/header.php';
$id = htmlspecialchars($_GET['id']);
$rows = mysqli_query($con, "SELECT * FROM tbl_buku WHERE jenis = 'siswa' AND id_buku = '$id'");
$row = mysqli_fetch_assoc($rows);
?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Profile</h3>
</div>
<div class="page-content">
  <section class="row">
    <div class="col-md-8 col-sm-12">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Data diri anda</h4>
            </div>
            <div class="card-body pt-3">
              <img src="<?= $pathbuku . $row['gambar'] ?>" class="rounded mb-4" alt="sampul-buku" style="width: 170px; height: 230px; object-fit:cover;">
              <table class="table">
                <tbody>
                  <tr>
                    <th scope="row">Judul Buku</th>
                    <td><?= $row['judul']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Penulis</th>
                    <td><?= $row['penulis']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Penerbit</th>
                    <td><?= $row['penerbit']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Tahun Terbit</th>
                    <td><?= $row['tahun_terbit']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Stok</th>
                    <td><?= $row['stok']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Jenis</th>
                    <td><?= $row['jenis']; ?></td>
                  </tr>
                </tbody>
              </table>
              <div class="d-flex justify-content-end">
                <a href="/perpustakaan/siswa/buku" class="btn btn-secondary me-2">Kembali</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include 'template/footer.php'; ?>