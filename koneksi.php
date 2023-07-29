<?php

$con = mysqli_connect("localhost", "root", "", "perpustakaan");
mysqli_query($con, "SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
$url = '/perpustakaan/';

// Buat kunci dan IV dengan panjang yang sesuai (misalnya 128, 192, atau 256 bit)
$key = openssl_random_pseudo_bytes(16);
$method = 'AES-256-CBC';
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));
