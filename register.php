<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Halaman Daftar</title>
  <link rel="stylesheet" href="./src/css/style.css?v=<?php echo time() ?>">
  <link rel="stylesheet" href="./src/css/login.css?v=<?php echo time() ?>">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link href="./src/bootstrap/css/bootstrap.min.css?v=<?php echo time() ?>" rel="stylesheet">
</head>

<body>
  <!-- --------- main container ----------  -->
  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <!-- --------- login container ----------  -->
    <div class="row border position-relative rounded-5 p-3 bg-white shadow box-area">
      <a href="/perpustakaan/">
        <div class="kembali position-absolute bg-white shadow-sm d-flex justify-content-center align-items-center">
          <i class="fas fa-chevron-left"></i>
        </div>
      </a>

    

      <!-- --------- right box ----------  -->
      <div class="col-12 right-box">
        <div class="row align-items-center py-3">
          <div class="header-text mb-4">
            <h3>Selamat datang</h3>
            <p>Silahkan isi formulir untuk daftar.</p>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="input-group mb-3">
                <input type="text" class="form-control form-control-lg bg-light fs-6" name="email" placeholder="Email Address">
              </div>
              <div class="input-group mb-3">
                <input type="password" class="form-control form-control-lg bg-light fs-6" name="password" placeholder="Password">
              </div>
              
            </div>
            <div class="col-md-6">
              
              <div class="input-group mb-3">
                <input type="text" class="form-control form-control-lg bg-light fs-6" name="nama" placeholder="Nama">
              </div>
              <div class="input-group mb-3">
                <input type="text" class="form-control form-control-lg bg-light fs-6" name="telpon" placeholder="Telepon">
              </div>
            </div>
            <div class="col-md-12">
              <textarea name="alamat" class="form-control" placeholder="Alamat"></textarea>
            </div>
            <div class="col-md-12 mt-3">

              <div class="input-group mb-3">
                <button type="submit" class="btn btn-primary btn-lg w-100 fs-6">Daftar</button>
              </div>
              <div class="input-group mb-2">
                <a href="login.php" class="btn btn-light btn-lg w-100 fs-6">Masuk</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>