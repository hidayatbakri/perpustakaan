<?php
$title = "Edit Anggota Struktur - Perpustakaan SMAN 3 Gowa";
$active = "struktur";
include 'template/header.php';
$id = $_GET['id'];
$row = mysqli_query($con, "SELECT * FROM tbl_struktur, tbl_jabatan WHERE tbl_jabatan.id_jabatan = tbl_struktur.id_jabatan AND id_struktur = '$id'");
$row = mysqli_fetch_assoc($row);
$jabatan = mysqli_query($con, "SELECT * FROM tbl_jabatan");
?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Ubah Anggota Struktur</h3>
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
                      <input type="text" class="form-control form-control-lg fs-6" name="nama" placeholder="Nama" value="<?= $row['nama']?>" required>
                    </div>
                    <select class="form-select" name="jabatan" aria-label="Default select example">
                      <option selected value="<?= $row['id_jabatan'] ?>"><?= $row['nama_jabatan'] ?></option>
                      <?php while($jbt = mysqli_fetch_assoc($jabatan)) : ?>
                      <option value="<?= $jbt['id_jabatan'] ?>"><?= $jbt['nama_jabatan'] ?></option>
                      <?php endwhile; ?>
                    </select>
                    <label for="foto" class="py-2">Foto: </label>
                    <div class="input-group mb-3">
                    <input type="hidden" name="gambarlama" value="<?= $row['foto'] ?>">
                      <input type="file" class="form-control fs-6" id="foto" name="gambar" placeholder="Foto">
                    </div>
                  </div>
                  <div class="col-md-12 mt-3">
                    <div class="col-md-12 d-flex justify-content-end">
                      <a href="/perpustakaan/staff/kelas" class="btn btn-light me-3">Kembali</a>
                      <button type="submit" name="update" class="btn btn-primary">Simpan</button>
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

if (isset($_POST["update"])) {
  $nama = htmlspecialchars($_POST["nama"]);
  $jabatan = htmlspecialchars($_POST["jabatan"]);
  $gambarlama = htmlspecialchars($_POST['gambarlama']);
  // $foto = cekSampul("struktur");
  
  if ($_FILES['gambar']['error'] == 4) {
    $foto = $gambarlama;
  } else {
    unlink('../assets/struktur/' . $gambarlama);
    $foto = cekSampul("struktur");
  }
  
  $result = mysqli_query($con, "UPDATE tbl_struktur SET
                        nama = '$nama', 
                        id_jabatan = '$jabatan', 
                        foto = '$foto' WHERE id_struktur = '$id'");



  if ($result) {
    echo "<script>
        Swal.fire({
          title: 'Berhasil mengubah data',
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
}

?>