<?php
$title = "Tambah Pinjaman - Perpustakaan SMAN 3 Gowa";
$active = "pinjaman";
include 'template/header.php';


$listkelas = mysqli_query($con, "SELECT * FROM tbl_kelas");

$jenis = '';
if (isset($_GET['getJenis'])) {
  $jenis = htmlspecialchars($_GET['getJenis']);
  if ($jenis == 'siswa') {
    $listsiswa = mysqli_query($con, "SELECT * FROM tbl_siswa, tbl_kelas WHERE tbl_siswa.id_kelas = tbl_kelas.id_kelas AND valid = 'true'");
  } elseif ($jenis == 'guru') {
    $listguru = mysqli_query($con, "SELECT * FROM tbl_guru, tbl_login WHERE tbl_login.id_anggota = tbl_guru.nip");
  }
}
$listbuku = mysqli_query($con, "SELECT * FROM tbl_buku WHERE jenis = '$jenis' ORDER BY id_buku DESC");
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
                      </select>
                      <div class="d-flex justify-content-end">
                        <button class="btn btn-primary px-3 my-3" type="submit">Lanjut</button>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="mytext-primary mt-4 fw-bold">Peminjaman buku <?= $jenis; ?></h3>
              </div>
              <div class="card-body">
                <form action="" method="post">
                  <?php if ($jenis == "siswa") : ?>
                    <h5 class="text-secondary bold">Daftar siswa</h5>
                    <table class="table mt-5 table-hover table-striped w-100" id="dataTable">
                      <thead class="bg-primary">
                        <tr>
                          <th class="text-white" scope="col">No</th>
                          <th class="text-white" scope="col">Nama</th>
                          <th class="text-white" scope="col">Nisn</th>
                          <th class="text-white" scope="col">Jenis Kelamin</th>
                          <th class="text-white" scope="col">Kelas</th>
                          <th class="text-white" scope="col">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1;
                        while ($row = mysqli_fetch_assoc($listsiswa)) : ?>
                          <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['nisn'] ?></td>
                            <td><?= $row['jk'] ?></td>
                            <td><?= $row['nama_kelas'] ?></td>
                            <td>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="id" required value="<?= $row['nisn']; ?>">
                              </div>
                            </td>
                          </tr>
                        <?php $i++;
                        endwhile; ?>
                      </tbody>
                    </table>

                  <?php elseif ($jenis == "guru") : ?>
                    <table class="table mt-5 table-hover table-striped" id="dataTable">
                      <thead class="bg-primary">
                        <tr>
                          <th class="text-white" scope="col">No</th>
                          <th class="text-white" scope="col">Nama</th>
                          <th class="text-white" scope="col">Nip</th>
                          <th class="text-white" scope="col">Jenip Kelamin</th>
                          <th class="text-white" scope="col">Email</th>
                          <th class="text-white" scope="col">Hp</th>
                          <th class="text-white" scope="col">Alamat</th>
                          <th class="text-white" scope="col">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1;
                        while ($row = mysqli_fetch_assoc($listguru)) : ?>
                          <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['nip'] ?></td>
                            <td><?= $row['jk'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['hp'] ?></td>
                            <td><?= $row['alamat'] ?></td>
                            <td>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="id" required value="<?= $row['nip']; ?>">
                              </div>
                            </td>
                          </tr>
                        <?php $i++;
                        endwhile; ?>
                      </tbody>
                    </table>

                  <?php endif; ?>
                  <h5 class="text-secondary bold pt-4">Daftar buku</h5>
                  <table class="table table-hover table-striped" id="dataTable2">
                    <thead class="bg-primary">
                      <tr>
                        <th class="text-white" scope="col">No</th>
                        <th class="text-white" scope="col">Judul</th>
                        <th class="text-white" scope="col">Sampul</th>
                        <th class="text-white" scope="col">Penulis</th>
                        <th class="text-white" scope="col">Penerbit</th>
                        <th class="text-white" scope="col">Stok</th>
                        <th class="text-white text-center" scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1;
                      while ($row = mysqli_fetch_assoc($listbuku)) : ?>
                        <tr>
                          <th scope="row"><?= $i; ?></th>
                          <td><?= $row['judul'] ?></td>
                          <td><img src="<?= $pathbuku . $row['gambar'] ?>" alt="sampul-buku" style="width: 100px; object-fit: cover;"></td>
                          <td><?= $row['penulis'] ?></td>
                          <td><?= $row['penerbit'] ?></td>
                          <td><span class="<?= $row['stok'] < 1 ? 'text-danger' : '' ?>"><?= $row['stok'] ?></span></td>
                          <td class="">
                            <input type="checkbox" class="idbuku" <?= $row['stok'] < 1 ? 'disabled' : '' ?> name="buku[]" value="<?= $row['id_buku']; ?>" style="width: 30px; height: 30px; ">
                          </td>
                        </tr>
                      <?php $i++;
                      endwhile; ?>
                    </tbody>
                  </table>
                  <div class="row">
                    <div class="col-md-12 d-flex justify-content-end mt-3">
                      <a href="/perpustakaan/staff/pinjaman" class="btn btn-light me-3">Kembali</a>
                      <button type="submit" name="add" class="btn btn-primary">Tambah Pinjaman</button>
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


<?php include 'template/footer.php';

if (isset($_POST["add"])) {

  if (!isset($_POST['buku'])) {
    echo "<script>
      Swal.fire({
        title: 'Pilih peminjaman terlebih dahulu',
        confirmButtonText: 'Oke',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          document.location.href='';
        }
      })
    </script>";
    exit;
  }

  $postnisn = htmlspecialchars($_POST["id"]);
  $buku = $_POST["buku"];
  $status;

  for ($i = 0; $i < count($buku); $i++) {
    $cekstok = mysqli_query($con, "SELECT stok FROM tbl_buku WHERE id_buku = '$buku[$i]'");
    $cekstok = mysqli_fetch_assoc($cekstok);

    if ($cekstok['stok'] > 0) {
      $stoknow = $cekstok['stok'] - 1;
      $buku[$i] = htmlspecialchars($buku[$i]);
      $querypinjam = "INSERT INTO tbl_peminjaman (id_anggota, id_buku, tgl_pinjam, status, jenis) VALUES ('$postnisn','$buku[$i]', CURRENT_DATE(),'tidak', '$jenis')";
      mysqli_query($con, "UPDATE tbl_buku SET stok = $stoknow WHERE id_buku = '$buku[$i]'");
      $result1 = mysqli_query($con, $querypinjam);

      if ($result1) {
        $status = true;
      } else {
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