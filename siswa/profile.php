<?php
$title = "Profile - Perpustakaan SMAN 3 Gowa";
$active = "profile";
include 'template/header.php';
$nisn = $_SESSION['id'];
$profile = mysqli_query($con, "SELECT * FROM tbl_siswa, tbl_login, tbl_kelas WHERE tbl_siswa.nisn = '$nisn' AND tbl_login.id_anggota = '$nisn' AND tbl_kelas.id_kelas = tbl_siswa.id_kelas");
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