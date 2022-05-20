<?php

// Import Function
require "function.php";


// Redirect Ke Halaman Login Ketika Belum Login
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}


$user_id = $_SESSION['user_id']; // sementara

// Handler Logout
if (isset($_GET['logout'])) {
  logout();
}

// Handler Tombol Insert Data Post
if (isset($_POST["submit_createPost"])) {

  // Eksekusi Create Post
  $postStatus = createPost($_POST);
}

// Handler Tombol Update Data Post
if (isset($_POST["submit_updatePost"])) {

  // Eksekusi Update Post
  $postStatus = updatePost($_POST);
}

// Handler Tombol Delete Data Post
if (isset($_GET["delete_id"])) {
  $postStatus = deletePost($_GET["delete_id"]);
}

// Ambil Data Post untuk Ditampilkan
$posts = queryGetData("SELECT * FROM posts WHERE user_id = $user_id");

// Ambil Data Post Sesuai Keyword Pencarian
if (isset($_POST["submit_search"])) {
  $posts = searchPostsPrivate($_POST["keyword"], $user_id);
}
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
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <title>Slink | Your Posts</title>
</head>

<body>
  <div class="animasi3">
    <nav class="navbar navbar-expand-sm" style="background-color: #6aa5a9;">
      <div class="container-fluid">
        <a class="navbar-brand" href="./home.php"><img src="../Foto/logo.png" alt=""></a>
      </div>
      <a class="navbar-brand p-2 text-white" href="./cms.php">
        <h3>Cms</h3>
      </a>
      <a class="navbar-brand p-2 text-white" href="./cms.php?logout=<?= true ?>" id="logout">
        <h3>Log Out</h3>
      </a>
    </nav>
  </div>

  <div class="animasi3">
    <main class="container shadow p-3 mb-5 bg-body rounded m-auto mt-5">
      <div class="row mb-2 d-flex">
        <!-- Tombol Trigger Modal untuk Insert/Tambah Data -->
        <div class="col-3">
          <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal_form" id="trigger_createPost">+ Tambah Post</button>
        </div>
        <div class="col-6 justify-content-center">
          <?php if (isset($postStatus["error_space"])) echo $postStatus["error_space"] ?>
          <?php if (isset($postStatus["error_link"])) echo $postStatus["error_link"] ?>
          <?php if (isset($postStatus["success"])) echo $postStatus["success"] ?>
        </div>
      </div>

      <!-- Form dan Tombol Cari -->
      <form action="" method="POST">
        <div class="input-group mb-3 mt-4 col-4 row">
          <div class="col-4">
            <input type="text" class="form-control" placeholder="Cari Posts..." id="keyword" name="keyword" />
          </div>
          <div class="col-3">
            <button type="submit" class="btn btn-outline-success col-4" type="button" name="submit_search">Cari</button>
          </div>
        </div>
      </form>



      <!-- Card Menampilkan Data-->
      <section class="row" id="list_posts">
        <?php if (count($posts) == 0) : ?>
          <h3 class="d-flex justify-content-center">Posts Tidak Ditemukan</h3>
        <?php endif; ?>
        <?php foreach ($posts as $post) : ?>
          <div class="col-sm-4 mb-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title"><?= $post['judul']; ?></h5>
                <p class="card-text"><?= $post['deskripsi']; ?></p>
                <div class="row">
                  <a class="btn btn-primary col-5" href="<?= $post['link']; ?>" target="_blank">Go Link</a>
                  <div class="col-1"></div>
                  <div class="d-grid gap-2 d-md-flex col-4">
                    <button class="btn btn-outline-danger " type="button" onclick="return confirm('Yakin Menghapus Post?')"><a href="cms.php?delete_id=<?= $post["id"]; ?>" class="text-reset text-decoration-none">Delete</a></button>
                    <button class="btn btn-outline-success  trigger_updatePost" type=" button" data-bs-toggle="modal" data-bs-target="#modal_form" data-id="<?= $post['id'] ?>">Update</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </section>


      <!-- Modal Form-->
      <div class="modal fade" id="modal_form" tabindex="-1" aria-labelledby="modal_form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal_label">Tambah Data Post</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
              <input type="hidden" name="id" id="id">
              <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
              <div class="modal-body">
                <div class="form-floating">
                  <input type="text" class="form-control form-control-sm" id="judul" name="judul" placeholder="Judul" required />
                  <label for="judul">Judul</label>
                </div>
                <div class="form-floating">
                  <textarea class="form-control form-control-sm" id="deskripsi" name="deskripsi" placeholder="Deskripsi" required></textarea>
                  <label for="deskripsi">Deskripsi</label>
                </div>
                <div class="form-floating">
                  <input type="text" class="form-control form-control-sm" id="link" name="link" placeholder="Link" required />
                  <label for="link">Link</label>
                </div>
              </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-danger">Reset</button>
                <button type="submit" class="btn btn-primary" id="modal_button">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="js/cms.js"></script>
  <footer>
    <div class="row">
      <div class="col-lg-12 text-center mt-5">
        <p><small>Copyright &copy; Slink 2022</small></p>
      </div>>
    </div>
  </footer>
</body>

</html>