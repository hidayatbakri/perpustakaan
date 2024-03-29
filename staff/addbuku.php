<?php
$title = "Tambah Buku - Perpustakaan SMAN 3 Gowa";
$active = "buku";
include 'template/header.php';


?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Tambah Buku</h3>
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
              <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-12">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-lg bg-light fs-6" name="judul" placeholder="Judul Buku" required>
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-lg bg-light fs-6" name="penulis" placeholder="Penulis Buku" required>
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-lg bg-light fs-6" name="penerbit" placeholder="Penerbit Buku" required>
                    </div>
                    <div class="input-group mb-3">
                      <input type="date" class="form-control form-control-lg bg-light fs-6" name="tahun_terbit" placeholder="Tahun Terbit" required>
                    </div>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control form-control-lg bg-light fs-6" name="stok" placeholder="Stok Buku" required>
                    </div>
                    <select class="form-select mb-3" name="jenis" required aria-label="Default select example">
                      <option selected>Jenis buku</option>
                      <option value="siswa">Siswa</option>
                      <option value="guru">Guru</option>
                      <option value="umum">Umum</option>
                    </select>
                    <label for="cover">Sampul Buku</label>
                    <div class="input-group mb-3">
                      <input type="file" id="cover" name="gambar" class="form-control form-control-lg bg-light fs-6">
                    </div>
                  </div>
                  <div class="col-md-12 mt-3">
                    <div class="col-md-12 d-flex justify-content-end">
                      <a href="/perpustakaan/staff/buku" class="btn btn-light me-3">Kembali</a>
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
  $judul = htmlspecialchars($_POST["judul"]);
  $penulis = htmlspecialchars($_POST["penulis"]);
  $penerbit = htmlspecialchars($_POST["penerbit"]);
  $tahun_terbit = htmlspecialchars($_POST["tahun_terbit"]);
  $stok = htmlspecialchars($_POST["stok"]);
  $jenis = htmlspecialchars($_POST["jenis"]);

  $gambar = cekSampul("buku");


  $result = mysqli_query($con, "INSERT INTO tbl_buku (judul, penulis, penerbit, tahun_terbit, stok, gambar, jenis) VALUES ('$judul', '$penulis', '$penerbit', '$tahun_terbit', '$stok', '$gambar', '$jenis')");

  if ($result) {
    echo "<script>
        Swal.fire({
          title: 'Berhasil menambah buku',
          confirmButtonText: 'Lanjut',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            document.location.href='/perpustakaan/staff/buku';
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