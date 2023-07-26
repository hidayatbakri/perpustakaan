<?php
$title = "Surat Keterangan - Perpustakaan SMAN 3 Gowa";
$active = "keterangan";
include 'template/header.php';
$nis = $_SESSION['id'];
$profile = mysqli_query($con, "SELECT * FROM tbl_siswa, tbl_login, tbl_kelas WHERE tbl_siswa.nis = '$nis' AND tbl_login.id_anggota = '$nis' AND tbl_kelas.id_kelas = tbl_siswa.id_kelas");
$profile = mysqli_fetch_assoc($profile);
$peminjaman = mysqli_query($con, "SELECT COUNT(*) AS total FROM tbl_peminjaman WHERE id_anggota = '$nis' AND status = 'tidak'");
$peminjaman = mysqli_fetch_assoc($peminjaman);
?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Keterangan Perpustakaan</h3>
</div>
<div class="page-content">
  <section class="row">
    <div class="col-md-8 col-sm-12">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Detail</h4>
            </div>
            <div class="card-body pt-3">
              <?php if($peminjaman['total'] > 0) :?>
                  <div class="alert alert-warning" role="alert">
                    Anda belum menyelesaikan semua peminjaman
                  </div>
                <?php endif;?>
                <div style="width: 100%" class="d-flex justify-content-center my-3">
                  <div id="qrcode"></div>
                <!-- <i class="bi bi-x-octagon text-danger" style="font-size: 200px"></i> -->
                </div>
              <!-- <i class="bi bi-x-octagon text-danger" style="font-size: 200px"></i> -->
              </div>
              <table class="table">
                <tbody>
                  <tr>
                    <th scope="row">Nama</th>
                    <td><?= $profile['nama']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Nis</th>
                    <td><?= $profile['nis']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Kelas</th>
                    <td><?= $profile['nama_kelas']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Email</th>
                    <td><?= $profile['email']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Jenis Kelamin</th>
                    <td><?= $profile['jk']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Alamat</th>
                    <td><?= $profile['alamat']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Level</th>
                    <td><?= $profile['level']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Total Peminjaman</th>
                    <td><?= $peminjaman['total']; ?></td>
                  </tr>
                </tbody>
              </table>
              <div class="d-flex justify-content-end">
                <a href="/perpustakaan/siswa/editprofil" class="btn btn-secondary me-2">Ubah Password</a>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Ubah profil
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah profil</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Informasikan ke staff perpustakaan jika ada data yang salah!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mengerti</button>
      </div>
    </div>
  </div>
</div>

<?php include 'template/footer.php'; ?>

<script>
  new QRCode(document.getElementById("qrcode"), "http://jindo.dev.naver.com/collie");
</script>