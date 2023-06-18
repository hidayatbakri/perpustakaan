<?php
$title = "Ubah Buku - Perpustakaan SMAN 3 Gowa";
$active = "buku";
include 'template/header.php';

$id = htmlspecialchars($_GET['id']);
$buku = mysqli_query($con, "SELECT * FROM tbl_buku WHERE id_buku = '$id'");
$buku = mysqli_fetch_assoc($buku);
?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Ubah Buku</h3>
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
                      <input type="text" class="form-control form-control-lg bg-light fs-6" name="judul" placeholder="Judul Buku" value="<?= $buku['judul'] ?>" required>
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-lg bg-light fs-6" name="penulis" placeholder="Penulis Buku" value="<?= $buku['penulis'] ?>" required>
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-lg bg-light fs-6" name="penerbit" placeholder="Penerbit Buku" value="<?= $buku['penerbit'] ?>" required>
                    </div>
                    <div class="input-group mb-3">
                      <input type="date" class="form-control form-control-lg bg-light fs-6" name="tahun_terbit" placeholder="Tahun Terbit" value="<?= $buku['tahun_terbit'] ?>" required>
                    </div>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control form-control-lg bg-light fs-6" name="stok" placeholder="Stok Buku" value="<?= $buku['stok'] ?>" required>
                    </div>
                    <label for="cover">Sampul Buku</label>
                    <div class="my-3">
                      <img src="<?= $pathbuku . $buku['gambar'] ?>" alt="buku-sampul" style="width: 200px; object-fit: cover;">
                    </div>
                    <div class="input-group mb-3">
                      <input type="hidden" name="gambarlama" value="<?= $buku['gambar'] ?>">
                      <input type="file" id="cover" name="gambar" class="form-control form-control-lg bg-light fs-6">
                    </div>
                  </div>
                  <div class="col-md-12 mt-3">
                    <div class="col-md-12 d-flex justify-content-end">
                      <a href="/perpustakaan/staff/buku" class="btn btn-light me-3">Kembali</a>
                      <button type="submit" name="update" class="btn btn-primary">Simpan</button>
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
  $judul = htmlspecialchars($_POST["judul"]);
  $penulis = htmlspecialchars($_POST["penulis"]);
  $penerbit = htmlspecialchars($_POST["penerbit"]);
  $tahun_terbit = htmlspecialchars($_POST["tahun_terbit"]);
  $stok = htmlspecialchars($_POST["stok"]);
  $gambarlama = htmlspecialchars($_POST['gambarlama']);

  if ($_FILES['gambar']['error'] == 4) {
    $gambar = $gambarlama;
  } else {
    if ($gambarlama != 'buku-default.png') {

      unlink('../assets/buku/' . $gambarlama);
    }
    $gambar = cekSampul();
  }

  // die;

  $result = mysqli_query($con, "UPDATE tbl_buku SET
                        judul = '$judul',
                        penulis = '$penulis',
                        penerbit = '$penerbit',
                        tahun_terbit = '$tahun_terbit',
                        gambar = '$gambar',
                        stok = '$stok' WHERE id_buku = '$id'");

  if ($result) {
    echo "<script>
        Swal.fire({
          title: 'Berhasil mengubah buku',
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