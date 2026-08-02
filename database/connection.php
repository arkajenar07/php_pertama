<?php

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'kantor';

$connection = mysqli_connect($host, $user, $password, $database);

if (!$connection) {
    die("Koneksi database gagal: " . mysqli_connect_error());//
}