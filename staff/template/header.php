<?php
require '../koneksi.php';
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: /perpustakaan/login");
  exit;
}
$nip = $_SESSION['id'];

$ceklogin = mysqli_query($con, "SELECT * FROM tbl_login WHERE id_anggota = '$nip'");

if (mysqli_num_rows($ceklogin) != 1) {
  header("Location: /perpustakaan/login");
}

if ($_SESSION['level'] != 'staff') {
  header("Location: /perpustakaan/login");
}

$pathbuku = '/perpustakaan/assets/buku/';
$result = mysqli_query($con, "SELECT * FROM tbl_staff WHERE nip = '$nip'");


if (mysqli_num_rows($result) === 1) {
  $staff = mysqli_fetch_assoc($result);
}

function cekSampul($lokasi)
{
  $sizefile = htmlspecialchars($_FILES['gambar']['size']);
  $typefile = htmlspecialchars($_FILES['gambar']['type']);
  $error = htmlspecialchars($_FILES['gambar']['error']);
  $tmp = htmlspecialchars($_FILES['gambar']['tmp_name']);


  if ($error == 4) {
    return 'buku-default.png';
  } else {

    $ekstnsivalid = ['jpg', 'jpeg', 'png'];
    $ekstensi = explode('/', $typefile);

    if (!in_array($ekstensi[1], $ekstnsivalid)) {
      echo "<script>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Format gambar tidak didukung',
      })
    </script>";

      return false;
    }

    if ($sizefile > 512 * 1024) {
      echo "<script>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Ukuran gambar terlalu besar',
      })
    </script>";

      return false;
    }
    // die;
    $namaFile = md5(random_int(0, 10000000)) . '.' . $ekstensi[1];
    move_uploaded_file($tmp, '../assets/' . $lokasi . '/' . $namaFile);
    return $namaFile;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title; ?></title>
  <link rel="stylesheet" href="../assets/css/main/app.css?v=<?php echo time() ?>">
  <link rel="stylesheet" href="../assets/css/main/app-dark.css?v=<?php echo time() ?>">
  <link rel="stylesheet" href="../assets/css/shared/iconly.css?v=<?php echo time() ?>">
  <script src="../src/js/jQuery.min.js?v=<?php echo time() ?>"></script>
  <link href="../src/DataTables/datatables.min.css?v=<?php echo time() ?>" rel="stylesheet" />
  <script src="../src/DataTables/datatables.min.js?v=<?php echo time() ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <div id="app">
    <div id="sidebar" class="active">
      <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
          <div class="d-flex justify-content-between align-items-center">
            <div class="logo">
              <a href="index.html"><img src="../assets/logo/logosekolah1.png" alt="Logo" class="img-fluid h-100" width="300px" style="object-fit: cover;"></a>
            </div>
            <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path>
                  <g transform="translate(-210 -1)">
                    <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                    <circle cx="220.5" cy="11.5" r="4"></circle>
                    <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                  </g>
                </g>
              </svg>
              <div class="form-check form-switch fs-6">
                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark">
                <label class="form-check-label"></label>
              </div>
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                <path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z"></path>
              </svg>
            </div>
            <div class="sidebar-toggler  x">
              <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
          </div>
        </div>
        <div class="sidebar-menu">
          <ul class="menu">
            <li class="sidebar-title">Menu</li>

            <li class="sidebar-item  <?= $active == 'dashboard' ? 'active' : ''; ?>">
              <a href="/perpustakaan/staff/index" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
              </a>
            </li>
            <li class="sidebar-item <?= $active == 'staff' ? 'active' : ''; ?>">
              <a href="/perpustakaan/staff/staff" class='sidebar-link'>
                <i class="bi bi-person-badge-fill"></i>
                <span>Staff</span>
              </a>
            </li>
            <li class="sidebar-item <?= $active == 'profile' ? 'active' : ''; ?>">
              <a href="profile" class='sidebar-link'>
                <i class="bi bi-person-fill"></i>
                <span>Profil</span>
              </a>
            </li>

            <li class="sidebar-title">Umum</li>
            <li class="sidebar-item  <?= $active == 'struktur' ? 'active' : ''; ?>">
              <a href="/perpustakaan/staff/struktur" class='sidebar-link'>
              <i class="bi bi-diagram-3"></i>
                <span>Struktur</span>
              </a>
            </li>
            <li class="sidebar-item  <?= $active == 'pengaturan' ? 'active' : ''; ?>">
              <a href="/perpustakaan/staff/pengaturan" class='sidebar-link'>
                <i class="bi bi-gear"></i>
                <span>Pengaturan</span>
              </a>
            </li>
            <li class="sidebar-title">Data</li>
            <li class="sidebar-item <?= $active == 'siswa' ? 'active' : ''; ?> has-sub">
              <a href="#" class='sidebar-link'>
                <i class="bi bi-file-earmark-medical-fill"></i>
                <span>Siswa</span>
              </a>
              <ul class="submenu ">
                <li class="submenu-item ">
                  <a href="/perpustakaan/staff/siswa">Data Siswa</a>
                </li>
                <li class="submenu-item ">
                  <a href="/perpustakaan/staff/verifsiswa">Verifikasi Siswa</a>
                </li>
              </ul>
            </li>
            <li class="sidebar-item  <?= $active == 'guru' ? 'active' : ''; ?>">
              <a href="/perpustakaan/staff/guru" class='sidebar-link'>
                <i class="bi bi-person-lines-fill"></i>
                <span>Guru</span>
              </a>
            </li>
            <li class="sidebar-item  <?= $active == 'siswa' ? 'active' : ''; ?>">
            </li>
            <li class="sidebar-item  <?= $active == 'kelas' ? 'active' : ''; ?>">
              <a href="/perpustakaan/staff/kelas" class='sidebar-link'>
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Data Kelas</span>
              </a>
            </li>
            <li class="sidebar-item  <?= $active == 'buku' ? 'active' : ''; ?>">
              <a href="/perpustakaan/staff/buku" class='sidebar-link'>
                <i class="bi bi-book-half"></i>
                <span>Data Buku</span>
              </a>
            </li>
            <li class="sidebar-item  <?= $active == 'kunjungan' ? 'active' : ''; ?>">
              <a href="/perpustakaan/staff/kunjungan" class='sidebar-link'>
                <i class="bi bi-people-fill"></i>
                <span>Kunjungan</span>
              </a>
            </li>
            <li class="sidebar-title">Peminjaman</li>
            <li class="sidebar-item <?= $active == 'pinjaman' ? 'active' : ''; ?> has-sub">
              <a href="#" class='sidebar-link'>
                <i class="bi bi-stack"></i>
                <span>Peminjaman</span>
              </a>
              <ul class="submenu ">
                <li class="submenu-item ">
                  <a href="/perpustakaan/staff/pinjaman">Data Pinjaman</a>
                </li>
                <li class="submenu-item ">
                  <a href="/perpustakaan/staff/rekappinjaman">Rekap Pinjaman</a>
                </li>
              </ul>
            </li>

            <li class="sidebar-title">Lanjutan</li>

            <li class="sidebar-item  ">
              <a href="/perpustakaan/logout" onclick="confirm('Apakah anda yakin?')" class='text-danger sidebar-link'>
                <i class="bi bi-door-open-fill text-danger"></i>
                <span>Keluar</span>
              </a>
            </li>

          </ul>
        </div>
      </div>
    </div>
    <div id="main">