<?php
$title = "Tambah Pinjaman - Perpustakaan SMAN 3 Gowa";
$active = "pinjaman";
include 'template/header.php';


$listkelas = mysqli_query($con, "SELECT * FROM tbl_kelas");

if (isset($_GET['cariKelas'])) {
  $getkelas = htmlspecialchars($_GET['getkelas']);

  $listsiswa = mysqli_query($con, "SELECT * FROM tbl_siswa WHERE id_kelas = '$getkelas' AND valid = 'true'");
  $listbuku = mysqli_query($con, "SELECT * FROM tbl_buku");
}
?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Tambah Peminjaman</h3>
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
              <form action="" method="get">
                <div class="row">
                  <div class="col-md-12">
                    <div class="input-group mb-3">
                      <select class="form-select bg-light fs-6" name="getkelas" aria-label="Default select example">
                        <option selected>Pilih Kelas</option>
                        <?php while ($kelas = mysqli_fetch_assoc($listkelas)) : ?>
                          <option value="<?= $kelas['id_kelas'] ?>"><?= $kelas['nama_kelas'] ?></option>
                        <?php endwhile; ?>
                      </select>
                    </div>
                    <button class="btn btn-primary float-end" type="submit" name="cariKelas">Cari Kelas</button>
                  </div>
                </div>
              </form>
              <?php
              if (isset($_GET['getkelas'])) :
              ?>
                <form action="" method="post">
                  <div class="row mt-5">
                    <div class="col-md-12">
                      <div class="input-group mb-3">
                        <select class="form-select bg-light fs-6" name="siswa" aria-label="Default select example">
                          <option selected>Pilih Siswa</option>
                          <?php while ($siswa = mysqli_fetch_assoc($listsiswa)) : ?>
                            <option value="<?= $siswa['nis'] ?>"><?= $siswa['nama'] ?></option>
                          <?php endwhile; ?>
                        </select>
                      </div>
                      <div class="input-group mb-3">
                        <select class="form-select bg-light fs-6" id="buku" name="buku" aria-label="Default select example">
                          <option selected>Pilih Buku</option>
                          <?php while ($buku = mysqli_fetch_assoc($listbuku)) : ?>
                            <option class="<?= $buku['stok'] <= 0 ? 'text-danger' : '' ?>" value="<?= $buku['id_buku'] ?>"><?= $buku['judul'] ?> | Stok : <?= $buku['stok'] ?></option>
                          <?php endwhile; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-12 mt-3">
                      <div class="col-md-12 d-flex justify-content-end">
                        <a href="/perpustakaan/staff/pinjaman" class="btn btn-light me-3">Kembali</a>
                        <button type="submit" name="add" class="btn btn-primary">Simpan</button>
                      </div>
                    </div>
                </form>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include 'template/footer.php';

if (isset($_POST["add"])) {
  $postnis = htmlspecialchars($_POST["siswa"]);
  $buku = htmlspecialchars($_POST["buku"]);

  $cekstok = mysqli_query($con, "SELECT stok FROM tbl_buku WHERE id_buku = '$buku'");
  $cekstok = mysqli_fetch_assoc($cekstok);

  if ($cekstok['stok'] > 0) {
    $stoknow = $cekstok['stok'] - 1;
    $querypinjam = "INSERT INTO tbl_peminjaman (id_anggota, id_buku, tgl_pinjam, status) VALUES ('$postnis','$buku', CURRENT_DATE(),'tidak')";
    mysqli_query($con, "UPDATE tbl_buku SET stok = $stoknow WHERE id_buku = '$buku'");
    $result1 = mysqli_query($con, $querypinjam);

    if ($result1) {
      echo "<script>
        Swal.fire({
          title: 'Berhasil menambah pinjaman',
          confirmButtonText: 'Lanjut',
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            document.location.href='/perpustakaan/staff/pinjaman';
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
  } else {
    echo "<script>
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Stok buku telah habis!',
    })
    </script>";
  }
}

?>