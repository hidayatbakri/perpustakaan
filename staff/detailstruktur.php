<?php
$title = "Profile - Perpustakaan SMAN 3 Gowa";
$active = "profile";
include 'template/header.php';
$id = $_GET['id'];
$row = mysqli_query($con, "SELECT * FROM tbl_struktur, tbl_jabatan WHERE tbl_jabatan.id_jabatan = tbl_struktur.id_jabatan AND id_struktur = '$id'");
$row = mysqli_fetch_assoc($row);
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
              <h4>Data diri <?= $row['nama_jabatan'] ?></h4>
            </div>
            <div class="card-body pt-3">
              <img src="/perpustakaan/assets/struktur/<?= $row['foto']?>" class="rounded-circle mb-5" style="border: 1px solid rgba(0,0,0,.5); height: 140px; width: 140px; object-fit: cover;"/>
              <table class="table">
                <tbody>
                  <tr>
                    <th scope="row">Nama</th>
                    <td><?= $row['nama']; ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Jabatan</th>
                    <td><?= $row['nama_jabatan']; ?></td>
                  </tr>
                  
                </tbody>
              </table>
              <div class="d-flex justify-content-end">
                <a href="/perpustakaan/staff/struktur" class="btn btn-light mt-5 me-3">Kembali</a>
                <a href="/perpustakaan/staff/editstruktur?id=<?= $id ?>" class="btn btn-primary mt-5">Ubah Profil</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php include 'template/footer.php'; ?>