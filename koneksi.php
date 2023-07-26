<?php 

$con = mysqli_connect("localhost", "root", "", "perpustakaan");
mysqli_query($con, "SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");