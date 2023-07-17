<?php
$title = "Tambah Pinjaman - Perpustakaan SMAN 3 Gowa";
$active = "pinjaman";
include 'template/header.php';


$listkelas = mysqli_query($con, "SELECT * FROM tbl_kelas");

$jenis = '';
if(isset($_GET['getJenis'])){
  $jenis = htmlspecialchars($_GET['getJenis']);
}

if (isset($_GET['getKelas'])) {
  $getkelas = htmlspecialchars($_GET['getKelas']);
  $listsiswa = mysqli_query($con, "SELECT * FROM tbl_siswa WHERE id_kelas = '$getkelas' AND valid = 'true'");
}
$listbuku = mysqli_query($con, "SELECT * FROM tbl_buku");
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
              <div class="row mt-5">
                <div class="col-md-12">
                  <form action="" method="get">
                    <div class="from-group">
                      <label for="tip">Jenis Peminjaman :</label>
                      <select name="getJenis" class="form-select" id="jenis">
                        <option value="siswa">Siswa</option>
                        <option value="guru">Guru</option>
                        <option value="umum">Umum</option>
                      </select>
                      <button class="btn btn-primary px-3 my-3 float-end" type="submit">Lanjut</button>
                    </div>
                  </form>
                  <?php if($jenis == "siswa") : ?>
                  <form action="" method="get">
                    <div class="from-group">
                      <input type="hidden" name="getJenis" value="<?= $jenis;?>">
                      <select name="getKelas" class="form-select" id="kelas">
                        <option >Pilih Kelas</option>
                        <?php while($row = mysqli_fetch_assoc($listkelas)) : ?>
                          <option value="<?= $row['id_kelas'] ?>"><?= $row['nama_kelas']?></option>
                        <?php endwhile;?>
                      </select>
                      <button class="btn btn-primary px-3 my-3 float-end" type="submit">Cari</button>
                    </div>
                  </form>
                  <?php endif;?>
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
                <form action="" method="post">
                  <div class="input-group mb-3">
                    <select class="form-select bg-light fs-6" name="siswa" aria-label="Default select example">
                      <?php if(!isset($_GET['getKelas'])) : ?>
                      <option selected>Pilih kelas terlebih dahulu</option>
                      <?php else : ?>
                      <option selected>Pilih Siswa</option>
                      <?php while ($siswa = mysqli_fetch_assoc($listsiswa)) : ?>
                        <option value="<?= $siswa['nis'] ?>"><?= $siswa['nama'] ?></option>
                      <?php endwhile; endif;?>
                    </select>
                  </div>
                  <input type="text" class="mb-3 form-control cari" name="cari" placeholder="Cari buku ...">
                  <div class="input-group mb-3">
                    <div class="d-flex justify-content-center flex-wrap" id="container-buku">
                      <?php while ($buku = mysqli_fetch_assoc($listbuku)) : ?>
                        <div class="card card-buku border-0 m-3 position-relative" style="position: relative;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?= $buku['judul'] ?>">
                          <input type="checkbox" <?= $buku['stok'] < 1 ? 'disabled' : '' ?> name="buku[]" value="<?= $buku['id_buku']; ?>" style="width: 30px; height: 30px; position: absolute; right: 10px; top: 10px;">
                          <img class="img-fluid img-buku-populer rounded-2" style="width: 200px; height: 250px; object-fit:cover;" data-aos="fade-right" data-aos-delay="0" src="/perpustakaan/assets/buku/<?= $buku['gambar'] ?>" alt="buku-populer">
                          <div class="position-absolute text-white p-2" style="background: rgba(0, 0, 0, .6); border-radius: 0 8px 8px 0; bottom: 10px;">
                            <span style="font-size: 15px;"><?= $buku['judul'] ?> | <span class="<?= $buku['stok'] < 1 ? 'text-danger' : '' ?>">Stok : <?= $buku['stok']?></span></span>
                          </div>
                        </div>
                      <?php endwhile; ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 d-flex justify-content-end">
                      <a href="/perpustakaan/staff/pinjaman" class="btn btn-light me-3">Kembali</a>
                      <button type="submit" name="add" class="btn btn-primary">Simpan</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
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
  $buku = $_POST["buku"];
  $status;
  
  for ($i=0; $i < count($buku); $i++) { 
    $cekstok = mysqli_query($con, "SELECT stok FROM tbl_buku WHERE id_buku = '$buku[$i]'");
    $cekstok = mysqli_fetch_assoc($cekstok);
    
    if ($cekstok['stok'] > 0) {
      $stoknow = $cekstok['stok'] - 1;
        $querypinjam = "INSERT INTO tbl_peminjaman (id_anggota, id_buku, tgl_pinjam, status) VALUES ('$postnis','$buku[$i]', CURRENT_DATE(),'tidak')";
        mysqli_query($con, "UPDATE tbl_buku SET stok = $stoknow WHERE id_buku = '$buku[$i]'");
        $result1 = mysqli_query($con, $querypinjam);

        if($result1){
          $status = true;
        }else{
          $status = false;
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

  if ($status) {
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
}
?>