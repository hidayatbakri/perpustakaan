<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="./src/css/style.css?v=<?php echo time()?>">
    <link rel="stylesheet" href="./src/css/login.css?v=<?php echo time()?>">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="./src/bootstrap/css/bootstrap.min.css?v=<?php echo time()?>" rel="stylesheet">
  </head>
  <body>
    <!-- --------- main container ----------  -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">

    <!-- --------- login container ----------  -->
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
    
    <!-- --------- left box ----------  -->
        <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #103cbe;">
            <div class="featured-image mb-3">
                <img  src="./assets/illustration/computer_illustration_1.png" alt="" class="img-fluid" style="width: 250px;">
            </div>
            <p class="text-white fs-2" style="font-family: 'courirer New', Courier, monospace; font-weight: 600;">Halaman Login</p>
            <small class="text-white text-wrap text-center" style="width :17rem; font-family: 'Courier New', ">Sistem informasi perpustakaan SMPN 1 Bontonompo</small>
        </div>
    
    <!-- --------- right box ----------  -->
        <div class="col-md-6 right-box">
            <div class="row align-items-center py-3">
                <div class="header-text mb-4">
                    <h3>Selamat datang</h3>
                    <p>Silahkan isi formulir untuk masuk</p>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-lg bg-light fs-6" name="email" placeholder="Email Address">
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control form-control-lg bg-light fs-6" name="password" placeholder="Password">
                </div>
                <div class="input-group mb-5">
                    <small><a href="#" class="text-decoration-none">Lupa Password?</a></small>
                </div>
                <div class="input-group mb-3">
                    <button type="submit" class="btn btn-primary btn-lg w-100 fs-6">Masuk</button>
                </div>
                <div class="input-group mb-3">
                    <button type="submit" class="btn btn-light btn-lg w-100 fs-6">Daftar</button>
                </div>
            </div>
        </div>
      </div>
    </div>
  </body>
</html>