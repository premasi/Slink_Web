<?php
// Header untuk Konfigurasi Keamanan Komunikasi dan CORS Data
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Import Function
require 'function.php';

// Get Data Mahasiswa untuk Diedit Lalu Kirim dalam Bentuk JSON untuk Ditampilkan
if (isset($_POST["id"])) {
    $id = $_POST['id'];

    $post =  queryGetData("SELECT * FROM posts WHERE id = $id");

    echo json_encode($post[0]);
}
