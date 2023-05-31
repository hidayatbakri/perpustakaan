<?php
session_start(); 
if(isset($_SESSION['login'])){
  session_destroy();
  header("Location: /perpustakaan/login.php");
}else{
  header("Location: /perpustakaan/login.php");
}
