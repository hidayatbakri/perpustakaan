<?php
$title = "Tambah Pinjaman - Perpustakaan SMAN 3 Gowa";
$active = "pinjaman";
include 'template/header.php';


$listkelas = mysqli_query($con, "SELECT * FROM tbl_kelas");

// if (isset($_GET['cariKelas'])) {
//   $getkelas = htmlspecialchars($_GET['getkelas']);

$listsiswa = mysqli_query($con, "SELECT * FROM tbl_siswa WHERE id_kelas = '$getkelas' AND valid = 'true'");
$listbuku = mysqli_query($con, "SELECT * FROM tbl_buku");
// }
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
      <form action="" method="post">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Formulir</h4>
              </div>
              <div class="card-body">
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



                  </div>
                  <div class="col-md-12 mt-3">
                    <div class="col-md-12 d-flex justify-content-end">
                      <a href="/perpustakaan/staff/pinjaman" class="btn btn-light me-3">Kembali</a>
                      <button type="submit" name="add" class="btn btn-primary">Simpan</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="mytext-primary mt-4 fw-bold" data-aos="zoom-in-right" data-aos-duration="1000">Data Buku</h3>
                  <h5 class="text-secondary bold" data-aos="zoom-in-right" data-aos-duration="1000" data-aos-delay="50">Daftar buku yang tersedia</h5>
                </div>
                <div class="card-body">
                  <input type="text" class="mb-3 form-control cari" name="cari" placeholder="Cari buku ...">
                  <div class="input-group mb-3">
                    <div class="d-flex justify-content-center flex-wrap" id="container-buku">
                      <?php while ($buku = mysqli_fetch_assoc($listbuku)) : ?>
                        <div class="card card-buku border-0 m-3 position-relative" style="position: relative;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?= $buku['judul'] ?>">
                          <input type="checkbox" class="" name="buku[]" value="<?= $buku['id_buku']; ?>" style="width: 30px; height: 30px; position: absolute; right: 10px; top: 10px;">
                          <img class="img-fluid img-buku-populer rounded-2" style="width: 200px; height: 250px; object-fit:cover;" data-aos="fade-right" data-aos-delay="0" src="/perpustakaan/assets/buku/<?= $buku['gambar'] ?>" alt="buku-populer">
                          <div class="position-absolute text-white p-2" style="background: rgba(0, 0, 0, .5); border-radius: 0 8px 8px 0; bottom: 10px;">
                            <span><?= $buku['judul'] ?></span>
                          </div>
                        </div>
                      <?php endwhile; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
</div>

<script>
  $('.buku').on('keyup', () => {
    console.log('oke')
    $.get('ajaxcaribuku.php', function(data) {
      console.log('Data : ' + data);
    });
  });
</script>

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