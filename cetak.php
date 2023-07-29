<?php

require 'koneksi.php';
$nisn = htmlspecialchars($_GET['id']);
$profile = mysqli_query($con, "SELECT * FROM tbl_siswa, tbl_login, tbl_kelas WHERE tbl_siswa.nisn = '$nisn' AND tbl_login.id_anggota = '$nisn' AND tbl_kelas.id_kelas = tbl_siswa.id_kelas");
if (mysqli_num_rows($profile)) {

  $profile = mysqli_fetch_assoc($profile);
  $id = explode(".", $profile['foto']);
  $id = $id[0];
  $peminjaman = mysqli_query($con, "SELECT COUNT(*) AS total FROM tbl_peminjaman WHERE id_anggota = '$nisn' AND status = 'tidak'");
  $peminjaman = mysqli_fetch_assoc($peminjaman);
  $perpus = mysqli_query($con, "SELECT * FROM tbl_profile LIMIT 1");
  $perpus = mysqli_fetch_assoc($perpus);
} else {
  header("Location: /perpustakaan/");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link href="./src/bootstrap/css/bootstrap.min.css?v=<?php echo time() ?>" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="src/js/jQuery.min.js?v=<?php echo time() ?>"></script>
  <script src="./assets/js/qrcode.min.js"></script>

  <style type="text/css">
    /* Kode CSS Untuk PAGE ini dibuat oleh http://jsfiddle.net/2wk6Q/1/ */
    body {
      width: 100%;
      height: 100%;
      margin: 0;
      padding: 0;
      background-color: #FAFAFA;
      font: 12pt "Tahoma";
    }

    * {
      box-sizing: border-box;
      -moz-box-sizing: border-box;
    }

    .page {
      width: 210mm;
      min-height: 297mm;
      padding: 14mm;
      margin: 10mm auto;
      /* border: 1px #D3D3D3 solid; */
      border-radius: 5px;
      background: white;
      /* box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); */
    }

    .subpage {
      padding: .0cm;
      /* border: 5px red solid; */
      /* height: 257mm; */
      /* outline: 2cm #FFEAEA solid; */
    }

    @page {
      size: A4;
      margin: 0;
    }

    @media print {

      html,
      body {
        width: 210mm;
        height: 297mm;
      }

      .page {
        margin: 0;
        border: initial;
        border-radius: initial;
        width: initial;
        min-height: initial;
        box-shadow: initial;
        background: initial;
        page-break-after: always;
      }
    }
  </style>
</head>

<body>
  <div class="book">
    <div class="page">
      <div class="subpage">
        <div class="card" style="width: 420px;">
          <div class="card-body p-4">
            <h4 class="text-center">Keterangan</h4>
            <p class="text-secondary text-center"><?= $perpus['nama_perpus'] ?></p>
            <div class="d-flex justify-content-center my-3">
              <div id="qrcode" class="mb-3"></div>
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
                <tr>
                  <th scope="row">Status</th>
                  <td><?= $peminjaman['total'] < 1 ? '<span class="text-success">Bebas</span>' : '<span class="text-success">Tidak Bebas</span>' ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <script>
        let qrcode = new QRCode("qrcode", {
          text: `<?= $url ?>check?id=<?= $id; ?>`,
          width: 128,
          height: 128,
          colorDark: "#000000",
          colorLight: "#ffffff",
          correctLevel: QRCode.CorrectLevel.H
        });
      </script>

    </div>
    <script>
      print();
    </script>
</body>

</html>