<?php
// Import Function
require "function.php";

// // Query Insert Data ke DB
// $query = "CALL getFollower(2)";
$email = "rdsuryamp@gmail.com";
// //Eksekusi Query
// $follower = queryGetData($query);
$user_id = $_SESSION['user_id'];
// Query Insert Data ke DB
$query = "CALL getPosts(6)";

//Eksekusi Query
$posts = queryGetData($query);

sendOTP($email);
