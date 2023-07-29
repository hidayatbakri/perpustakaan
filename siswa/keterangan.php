<?php
$title = "Surat Keterangan - Perpustakaan SMAN 3 Gowa";
$active = "keterangan";
include 'template/header.php';
$nisn = $_SESSION['id'];
$profile = mysqli_query($con, "SELECT * FROM tbl_siswa, tbl_login, tbl_kelas WHERE tbl_siswa.nisn = '$nisn' AND tbl_login.id_anggota = '$nisn' AND tbl_kelas.id_kelas = tbl_siswa.id_kelas");
$profile = mysqli_fetch_assoc($profile);
$peminjaman = mysqli_query($con, "SELECT COUNT(*) AS total FROM tbl_peminjaman WHERE id_anggota = '$nisn' AND status = 'tidak'");
$peminjaman = mysqli_fetch_assoc($peminjaman);


$encryptdata = explode('.', $profile['foto']);
?>



<header class="mb-3">
  <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
  </a>
</header>

<div class="page-heading">
  <h3>Keterangan Perpustakaan</h3>
</div>
<div class="page-content">
  <section class="row">
    <div class="col-md-8 col-sm-12">
      <div class="row">
        <div class="col-12">
          <div class="card p-3">
            <div class="card-header">
              <h4>Detail</h4>
            </div>
            <div class="card-body pt-3">
              <?php if ($peminjaman['total'] > 0) : ?>
                <div class="alert alert-warning" role="alert">
                  Anda belum menyelesaikan semua peminjaman
                </div>
                <div style="width: 100%" class="text-center my-3">
                  <i class="bi bi-x-octagon text-danger" style="font-size: 200px"></i>
                </div>

              <?php else : ?>
                <div style="width: 100%" class="text-center my-3">
                  <i class="bi bi-patch-check text-success" style="font-size: 200px"></i>
                </div>
              <?php endif; ?>
              <!-- <div style="width: 100%" class="d-flex justify-content-center my-3"> -->
              <!-- <i class="bi bi-x-octagon text-danger" style="font-size: 200px"></i> -->
            </div>
            <table class="table">
              <tbody>
                <tr>
                  <th scope="row">Nama</th>
                  <td><?= $profile['nama']; ?></td>
                </tr>
                <tr>
                  <th scope="row">Nisn</th>
                  <td><?= $profile['nisn']; ?></td>
                </tr>
                <tr>
                  <th scope="row">Kelas</th>
                  <td><?= $profile['nama_kelas']; ?></td>
                </tr>
                <tr>
                  <th scope="row">Email</th>
                  <td><?= $profile['email']; ?></td>
                </tr>
                <tr>
                  <th scope="row">Jenis Kelamin</th>
                  <td><?= $profile['jk']; ?></td>
                </tr>
                <tr>
                  <th scope="row">Alamat</th>
                  <td><?= $profile['alamat']; ?></td>
                </tr>
                <tr>
                  <th scope="row">Level</th>
                  <td><?= $profile['level']; ?></td>
                </tr>
                <tr>
                  <th scope="row">Total Peminjaman</th>
                  <td><?= $peminjaman['total']; ?></td>
                </tr>
              </tbody>
            </table>
            <div class="d-flex justify-content-end">
              <button class="btn btn-primary m-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Qr Code</button>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</section>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Qr Code</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body ">
    <div class="alert-copy"></div>
    <div class="d-flex justify-content-center">
      <div id="qrcode"></div>
    </div>
    <input type="text" style="position: absolute; left: -99999px !important; opacity: 0;" value="<?= $url . 'check?id=' . $encryptdata[0] ?>" id="myInput">
    <div class="d-flex justify-content-end mt-5">
      <button class="btn btn-secondary me-3" onclick="copy()"><i class="bi bi-clipboard"></i> Salin</button>
      <a href="<?= $url ?>cetak?id=<?= $profile['nisn'] ?>" class="btn btn-primary" target="_blank"><i class="bi bi-printer"></i> Cetak</a>
    </div>
  </div>
</div>


<?php include 'template/footer.php';

?>

<script>
  new QRCode(document.getElementById("qrcode"), $('#myInput').val());

  function copy() {
    // // Get the text field
    // var copyText = document.getElementById("myInput");

    // // Select the text field
    // copyText.select();
    // copyText.setSelectionRange(0, 99999); // For mobile devices

    // // Copy the text inside the text field
    // navigator.clipboard.writeText(copyText.value);
    let copyText = $('#myInput').select().val();
    document.execCommand('copy');
    console.log(copyText)
    $('.alert-copy').html(`
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Berhasil!</strong> Sukses salin url.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    `)
  }
</script>