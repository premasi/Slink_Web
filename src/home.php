<?php
// Import Function
require "function.php";

// Redirect Ke Halaman Login Ketika Belum Login
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
}


// Handler Logout
if (isset($_GET['logout'])) {
  logout();
}

$posts = queryGetData("SELECT posts.judul, posts.deskripsi, posts.link, users.username FROM posts INNER JOIN users ON posts.user_id = users.id");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="../css/style3.css" />
  <title>Slink | Home</title>
</head>

<body>
  <div class="animasi3">
    <nav class="navbar navbar-expand-sm" style="background-color: #6aa5a9">
      <div class="container-fluid">
        <a class="navbar-brand" href="./home.php"><img src="../Foto/logo.png" alt="" /></a>
      </div>
      <a class="navbar-brand p-2 text-white" href="./cms.php">
        <h3>Cms</h3>
      </a>
      <a class="navbar-brand p-2 text-white" id="logout" id="logout" name='logout' href="./home.php?logout=<?= true ?>">
        <h3>Log Out</h3>
      </a>
    </nav>
  </div>

  <div class="container row mt-3 m-auto p-3" id="postingan">
    <?php foreach ($posts as $post) : ?>
      <div class="media border p-3 mb-3 shadow">
        <div class="media-body">
          <h2><?= $post['judul']; ?></h2>
          <h5><span style="color: #45625D;">by</span><?= " " . $post["username"]; ?></h5>
          <a class="btn col-1 mt-1 mb-1 shadow" href="<?= $post["link"] ?>" style="background-color:#6aa5a9; color: white;" target="_blank">Go Link</a>
          <p class="mt-1 mb-1"><?= $post['deskripsi']; ?></p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <footer>
    <div class="row">
      <div class="col-lg-12 text-center mt-5">
        <p><small>Copyright &copy; Slink 2022</small></p>
      </div>
    </div>
  </footer>
</body>

</html>