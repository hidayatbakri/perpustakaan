<?php
$title = "Profile - Perpustakaan SMAN 3 Gowa";
$active = "profile";
include 'template/header.php';
$getnis = $_GET['nis'];
$profile = mysqli_query($con, "SELECT tbl_siswa.nama, tbl_siswa.nis, tbl_siswa.alamat, tbl_siswa.jk, tbl_login.email, tbl_login.level, tbl_kelas.nama_kelas, tbl_siswa.telepon FROM tbl_siswa, tbl_login, tbl_kelas WHERE tbl_siswa.nis = '$getnis' AND tbl_login.id_anggota = '$getnis' AND tbl_siswa.id_kelas = tbl_kelas.id_kelas");
$profile = mysqli_fetch_assoc($profile);
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
                    <th scope="row">Telepon</th>
                    <td><?= $profile['telepon']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Kelas</th>
                    <td><?= $profile['nama_kelas']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Level</th>
                    <td><?= $profile['level']; ?></td>
                  </tr>
                </tbody>
              </table>
              <div class="d-flex justify-content-end">
                <a href="/perpustakaan/staff/siswa" class="btn btn-light mt-5 me-3">Kembali</a>
                <a href="/perpustakaan/staff/editsiswa?nis=<?= $getnis ?>" class="btn btn-primary mt-5">Ubah Profil</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php include 'template/footer.php'; ?>