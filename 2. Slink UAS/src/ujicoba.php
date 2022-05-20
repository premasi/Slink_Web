<?php
// Import Function
require "function.php";

// // Query Insert Data ke DB
// $query = "CALL getFollower(2)";

// //Eksekusi Query
// $follower = queryGetData($query);
$user_id = $_SESSION['user_id'];
// Query Insert Data ke DB
$query = "CALL getPosts(6)";

//Eksekusi Query
$posts = queryGetData($query);
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
    <?php foreach ($follower as $user) : ?>
        <div class="media border p-3 mb-3 shadow">
            <div class="media-body">
                <h2><?= $user['username']; ?></h2>
                <p class="mt-1 mb-1">Likes: <?= $user['jml_like']; ?></p>
                <p class="mt-1 mb-1">Posts: <?= $user['jml_post']; ?></p>
            </div>
        </div>
    <?php endforeach; ?>

    <br>
    <hr>
    <br>

    <?php foreach ($posts as $post) : ?>
        <div class="media border p-3 mb-3 shadow">
            <div class="media-body">
                <h2><?= $post['judul']; ?></h2>
                <h5><span style="color: #45625D;">by</span><?= " " . $post["username"]; ?></h5>
                <a class="btn col-1 mt-1 mb-1 shadow" href="<?= $post["link"] ?>" style="background-color:#6aa5a9; color: white;" target="_blank">Go Link</a>
                <p class="mt-1 mb-1"><?= $post['deskripsi']; ?></p>
                <i <?php if (checkPostLiked($user_id, $post['id'])) : ?> class="bi bi-heart-fill text-danger fs-5 mx-1 like_button" <?php else : ?> class="bi bi-heart fs-5 mx-1 like_button" <?php endif ?> data-id="<?= $post["id"] ?>"></i>
                <i class="bi bi-chat fs-5 mx-1 comment_button" data-bs-toggle="modal" data-bs-target="#modal_form" data-id="<?= $post['id'] ?>"></i>
                <i <?php if (checkPostBookmarked($user_id, $post['id'])) : ?> class="bi bi-bookmark-fill text-primary fs-5 mx-1 bookmark_button" <?php else : ?> class="bi bi-bookmark fs-5 mx-1 bookmark_button" <?php endif ?> data-id="<?= $post["id"] ?>"></i>
                <br>
                <span class="likes"><?= getPostLikes($post['id']); ?> Likes</span>
            </div>
        </div>
    <?php endforeach; ?>


</body>

</html>