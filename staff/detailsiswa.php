<?php
$title = "Profile - Perpustakaan SMAN 3 Gowa";
$active = "profile";
include 'template/header.php';
$getnisn = $_GET['nisn'];
$profile = mysqli_query($con, "SELECT * FROM tbl_siswa, tbl_login, tbl_kelas WHERE tbl_siswa.nisn = '$getnisn' AND tbl_login.id_anggota = '$getnisn' AND tbl_siswa.id_kelas = tbl_kelas.id_kelas");
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
              <div class="d-flex justify-content-center mb-3">
                <img class="rounded" src="../assets/profile/<?= $profile['foto'] ?>" style="width: 150px; height: 180px; object-fit: cover;" alt="">
              </div>
              <table class="table">
                <tbody>
                  <tr>
                    <th scope="row">Nama</th>
                    <td><?= $profile['nama']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Nisn</th>
                    <td><?= $profile['nisn']; ?></td>
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
                <a href="/perpustakaan/staff/editsiswa?nisn=<?= $getnisn ?>" class="btn btn-primary mt-5">Ubah Profil</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php include 'template/footer.php'; ?>