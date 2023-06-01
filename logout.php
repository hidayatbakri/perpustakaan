<?php
session_start();
if (isset($_SESSION['login'])) {
  session_destroy();
  header("Location: /perpustakaan/login");
} else {
  header("Location: /perpustakaan/login");
}
