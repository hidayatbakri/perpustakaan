<?php
$title = "Tambah Kunjungan - Perpustakaan SMAN 3 Gowa";
$active = "kunjungan";
include 'template/header.php';


$listkelas = mysqli_query($con, "SELECT * FROM tbl_kelas");

?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Tambah kunjungan</h3>
</div>
<div class="page-content">
  <section class="row">
    <div class="col-12">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Kunjungan</h4>
            </div>
            <div class="card-body">
              <form action="" method="post">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group mb-3">
                      <input type="date" class="form-control form-control-lg bg-light fs-6" name="tgl_kunjungan" placeholder="Tanggal Kunjungan" required>
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-lg bg-light fs-6" name="nama" placeholder="Nama" required>
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-lg bg-light fs-6" name="baca" placeholder="Baca" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-lg bg-light fs-6" name="pinjam" placeholder="Pinjam" required>
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-lg bg-light fs-6" name="hp" placeholder="No Telepon" required>
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-lg bg-light fs-6" name="keterangan" placeholder="Keterangan" required>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="input-group mb-3">
                      <textarea name="alamat" required class="form-control bg-light fs-6" placeholder="Alamat"></textarea>
                    </div>
                  </div>
                  <div class="col-md-12 mt-3">
                    <div class="col-md-12 d-flex justify-content-end">
                      <a href="/perpustakaan/staff/staff" class="btn btn-light me-3">Kembali</a>
                      <button type="submit" name="add" class="btn btn-primary">Simpan</button>
                    </div>
                  </div>
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
  $tgl_kunjungan = htmlspecialchars($_POST["tgl_kunjungan"]);
  $nama = htmlspecialchars($_POST["nama"]);
  $baca = htmlspecialchars($_POST["baca"]);
  $pinjam = htmlspecialchars($_POST["pinjam"]);
  $hp = htmlspecialchars($_POST["hp"]);
  $keterangan = htmlspecialchars($_POST["keterangan"]);
  $alamat = htmlspecialchars($_POST["alamat"]);


  $querykunjungan = "INSERT INTO tbl_kunjungan (nama, baca, tgl_kunjungan, pinjam, alamat, hp, keterangan) VALUES ('$nama','$baca','$tgl_kunjungan','$pinjam','$alamat','$hp','$keterangan')";

  $result1 = mysqli_query($con, $querykunjungan);

  if (mysqli_affected_rows($con)) {
    echo "<script>
        Swal.fire({
          title: 'Berhasil menambah kunjungaan',
          confirmButtonText: 'Lanjut',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            document.location.href='/perpustakaan/staff/kunjungan';
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