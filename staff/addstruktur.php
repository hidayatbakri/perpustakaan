<?php
$title = "Tambah Struktur - Perpustakaan SMAN 3 Gowa";
$active = "struktur";
include 'template/header.php';

$jabatan = mysqli_query($con, "SELECT * FROM tbl_jabatan");

?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Tambah Struktur Baru</h3>
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
                      <input type="text" class="form-control form-control-lg fs-6" name="nama" placeholder="Nama" required>
                    </div>
                    
                    <select class="form-select" name="jabatan" aria-label="Default select example">
                      <option selected>Pilih jabatan</option>
                      <?php while($row = mysqli_fetch_assoc($jabatan)) : ?>
                      <option value="<?= $row['id_jabatan'] ?>"><?= $row['nama_jabatan'] ?></option>
                      <?php endwhile; ?>
                    </select>
                    <button type="button" class="btn p-0 border-0 my-3 text-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                      Tambah Jabatan
                    </button> <br>
                    <label for="foto" class="py-2">Foto: </label>
                    <div class="input-group mb-3">
                      <input type="file" class="form-control fs-6" id="foto" name="gambar" placeholder="Foto" required>
                    </div>
                  </div>
                  <div class="col-md-12 mt-3">
                    <div class="col-md-12 d-flex justify-content-end">
                      <a href="/perpustakaan/staff/struktur" class="btn btn-light me-3">Kembali</a>
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

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Jabatan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="input-group mb-3">
                <input type="text" class="form-control form-control-lg fs-6" name="nama" placeholder="Nama Jabatan" required>
              </div>
              <div class="input-group mb-3">
                <input type="number" class="form-control form-control-lg fs-6" name="tingkat" placeholder="Tingkatan Jabatan" required>
              </div>
            </div>
            
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" name="jabatan" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include 'template/footer.php';

if (isset($_POST["add"])) {
  $nama = htmlspecialchars($_POST["nama"]);
  $jabatan = htmlspecialchars($_POST["jabatan"]);
  $foto = cekSampul("struktur");
  $result = mysqli_query($con, "INSERT INTO tbl_struktur (nama, id_jabatan, foto) VALUES ('$nama', '$jabatan', '$foto')");

  if ($result) {
    echo "<script>
        Swal.fire({
          title: 'Berhasil menambah data',
          confirmButtonText: 'Lanjut',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            document.location.href='/perpustakaan/staff/struktur';
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
}elseif(isset($_POST['jabatan'])){
  $nama = htmlspecialchars($_POST['nama']);
  $tingkat = htmlspecialchars($_POST['tingkat']);

  mysqli_query($con, "INSERT INTO tbl_jabatan (nama_jabatan, tingkat) VALUES ('$nama', '$tingkat')");
  if(mysqli_affected_rows($con)){
    echo "<script>
        Swal.fire({
          title: 'Berhasil menambah jabatan',
          confirmButtonText: 'Lanjut',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            document.location.href='/perpustakaan/staff/addstruktur';
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