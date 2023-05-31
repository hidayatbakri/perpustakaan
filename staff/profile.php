<?php
$title = "Profile - Perpustakaan SMAN 3 Gowa";
$active = "profile";
include 'template/header.php';
$nip = $_SESSION['id'];
$profile = mysqli_query($con, "SELECT tbl_staff.nama, tbl_staff.nip, tbl_staff.alamat, tbl_staff.jk, tbl_login.email, tbl_login.level FROM tbl_staff, tbl_login WHERE tbl_staff.nip = '$nip' AND tbl_login.id_anggota = '$nip'");
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
                    <th scope="row">Nip</th>
                    <td><?= $profile['nip']; ?></td>
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
                <a href="#" class="btn btn-primary mt-5">Ubah Profil</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php include 'template/footer.php'; ?>