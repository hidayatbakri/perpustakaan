<?php
$title = "Ubah Kunjungan - Perpustakaan SMAN 3 Gowa";
$active = "ubah_kunjungan";
include 'template/header.php';

$id = htmlspecialchars($_GET['id']);
$kunjungan = mysqli_query($con, "SELECT * FROM tbl_kunjungan WHERE id_kunjungan = '$id'");
$kunjungan = mysqli_fetch_assoc($kunjungan);

?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Ubah kunjungan</h3>
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
                      <input type="date" class="form-control form-control-lg bg-light fs-6" name="tgl_kunjungan" value="<?= $kunjungan['tgl_kunjungan'] ?>" placeholder="Tanggal Kunjungan" required>
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-lg bg-light fs-6" name="nama" placeholder="Nama" value="<?= $kunjungan['nama'] ?>" required>
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-lg bg-light fs-6" name="baca" placeholder="Baca" value="<?= $kunjungan['baca'] ?>" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-lg bg-light fs-6" name="pinjam" placeholder="Pinjam" value="<?= $kunjungan['pinjam'] ?>" required>
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-lg bg-light fs-6" name="hp" placeholder="No Telepon" value="<?= $kunjungan['hp'] ?>" required>
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-lg bg-light fs-6" name="keterangan" placeholder="Keterangan" value="<?= $kunjungan['keterangan'] ?>" required>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="input-group mb-3">
                      <textarea name="alamat" required class="form-control bg-light fs-6" placeholder="Alamat"><?= $kunjungan['alamat'] ?></textarea>
                    </div>
                  </div>
                  <div class="col-md-12 mt-3">
                    <div class="col-md-12 d-flex justify-content-end">
                      <a href="/perpustakaan/staff/kunjungan" class="btn btn-light me-3">Kembali</a>
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


  $querykunjungan = "UPDATE tbl_kunjungan SET
                    tgl_kunjungan = '$tgl_kunjungan',
                    nama = '$nama',
                    baca = '$baca',
                    pinjam = '$pinjam',
                    hp = '$hp',
                    keterangan = '$keterangan',
                    alamat = '$alamat' WHERE id_kunjungan = '$id'";

  $result1 = mysqli_query($con, $querykunjungan);

  if (mysqli_affected_rows($con)) {
    echo "<script>
        Swal.fire({
          title: 'Berhasil mengubah kunjungan',
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