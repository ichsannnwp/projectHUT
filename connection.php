<?php
session_start();

$hostname = "localhost";
$port = "3306";
$username = "root";
$password = "";
$database = "projek2025";

$koneksi = new mysqli($hostname, $username, $password, $database, $port);

if($koneksi->connect_error){
    die("Koneksi Gagal: " . $koneksi->connect_error);
}
?>