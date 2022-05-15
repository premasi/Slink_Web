<?php
// Import Function
require "function.php";

// Query Insert Data ke DB
$query = "CALL getFollower(2)";

// Eksekusi Query
// $follower = queryGetData($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uji Coba</title>
</head>

<body>
    <?= json_encode(getPostLikes(2)); ?>

</body>

</html>

<?php foreach ($follower as $user) : ?>
    <div class="media border p-3 mb-3 shadow">
        <div class="media-body">
            <h2><?= $user['username']; ?></h2>
            <p class="mt-1 mb-1">Likes: <?= $user['jml_like']; ?></p>
            <p class="mt-1 mb-1">Posts: <?= $user['jml_post']; ?></p>
        </div>
    </div>
<?php endforeach; ?>