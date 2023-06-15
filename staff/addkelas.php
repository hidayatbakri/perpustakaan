<?php
$title = "Tambah Kelas - Perpustakaan SMAN 3 Gowa";
$active = "kelas";
include 'template/header.php';


?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Tambah Kelas</h3>
</div>
<div class="page-content">
  <section class="row">
    <div class="col-12">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Formulir</h4>
            </div>
            <div class="card-body">
              <form action="" method="post">
                <div class="row">
                  <div class="col-md-12">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-lg bg-light fs-6" name="nama_kelas" placeholder="Nama Kelas" required>
                    </div>
                  </div>
                  <div class="col-md-12 mt-3">
                    <div class="col-md-12 d-flex justify-content-end">
                      <a href="/perpustakaan/staff/kelas" class="btn btn-light me-3">Kembali</a>
                      <button type="submit" name="add" class="btn btn-primary">Simpan</button>
                    </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include 'template/footer.php';

if (isset($_POST["add"])) {
  $nama_kelas = htmlspecialchars($_POST["nama_kelas"]);

  $result = mysqli_query($con, "INSERT INTO tbl_kelas (nama_kelas) VALUES ('$nama_kelas')");

  if ($result) {
    echo "<script>
        Swal.fire({
          title: 'Berhasil menambah kelas',
          confirmButtonText: 'Lanjut',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            document.location.href='/perpustakaan/staff/kelas';
          }
        })
      </script>";
  } else {
    echo "<script>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Terjadi sebuah kesalahan!',
      })
    </script>";
  }
}

?>