<?php
// Header untuk Konfigurasi Keamanan Komunikasi dan CORS Data
header("Access-Control-Allow-Origin: *");

// Import Function
require 'function.php';

if (isset($_POST['getComments'])) {
    echo getCommentsPost($_POST['post_id']);
    exit;
}

if (isset($_POST['submit_comment'])) {
    echo createComment($_POST);
    exit;
}
