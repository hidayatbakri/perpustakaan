<?php
$title = "Staff - Perpustakaan SMAN 3 Gowa";
$active = "staff";
include 'template/header.php';
?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Data Staff</h3>
</div>
<div class="page-content">
  <section class="row">
    <div class="col-12">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Tabel Data Staff</h4>
            </div>
            <div class="card-body">
              <a href="/perpustakaan/staff/addstaff" class="btn btn-primary">Tambah data</a>
              <table class="table mt-5 table-hover table-striped">
                <thead class="bg-primary">
                  <tr>
                    <th class="text-white" scope="col">No</th>
                    <th class="text-white" scope="col">Nama</th>
                    <th class="text-white" scope="col">Nip</th>
                    <th class="text-white" scope="col">Jenis Kelamin</th>
                    <th class="text-white" scope="col">Email</th>
                    <th class="text-white" scope="col">Alamat</th>
                    <th class="text-white" scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Arman</td>
                    <td>111</td>
                    <td>Perempuan</td>
                    <td>arman@mail.com</td>
                    <td>Jl.Rumahdia</td>
                    <td>
                      <form action="" method="post">
                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                        <a href="/perpustakaan/staff/editstaff" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                        <a href="/perpustakaan/staff/editstaff" class="btn btn-info btn-sm"><i class="bi bi-eye-fill"></i></a>
                      </form>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php include 'template/footer.php'; ?>