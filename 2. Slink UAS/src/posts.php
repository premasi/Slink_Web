<?php
require "function.php";
ob_start();

//mengambil post berdasarkan category
if (isset($_GET['p_id'])) {
    $temp = $_GET['p_id'];

    $query = "SELECT * FROM posts WHERE id = $temp";
    $select_post = queryGetData($query);





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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.2/font/bootstrap-icons.min.css" integrity="sha512-YzwGgFdO1NQw1CZkPoGyRkEnUTxPSbGWXvGiXrWk8IeSqdyci0dEDYdLLjMxq1zCoU0QBa4kHAFiRhUL3z2bow==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <title>Slink | Home</title>
    </head>

    <body>

        <!-- Header Berisi Navbar -->
        <header class="animasi3">
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
        </header>

        <!-- Page Content -->
        <div class="container">

            <div class="row">

                <!-- Blog Entries Column -->
                <div class="col-md-8">



                    <!-- Form dan Tombol Cari -->
                    <form action="" method="POST">
                        <div class="input-group mb-3 mt-4 row">
                            <div class="col-9">
                                <input type="text" class="form-control" placeholder="Cari Posts..." id="keyword" name="keyword" />
                            </div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-outline-success col-12" type="button" name="submit_search">Cari</button>
                            </div>
                        </div>
                    </form>

                    <!-- Posts Terbaru -->
                    <div class="row" id="new_posts">
                        <?php if (count($select_post) == 0) : ?>
                            <h3 class="d-flex justify-content-center mt-4">Posts Tidak Ditemukan</h3>
                        <?php endif; ?>
                        <?php foreach ($select_post as $post) : ?>
                            <div class="media border pl-3 pt-3 pb-3 pr-5 mb-3 shadow">
                                <div class='card'>
                                    <div class="media-body p-5 mr-5">
                                        <h2><?= $post['judul']; ?></h2>

                                        <?php
                                        //select username
                                        $username = $post['user_id'];

                                        $query_username = "SELECT * FROM users WHERE id = '$username' ";
                                        $select_username = mysqli_query($conn, $query_username);

                                        while ($row = mysqli_fetch_array($select_username)) {
                                        ?>

                                            <img src="img_avatar3.png" alt="image" class="mr-3 mt-3 rounded-circle" style="width:60px;">
                                            <div class="media-body">
                                                <h4><?= $row["username"]; ?> <small><small><?= $post["waktu_aksi"]; ?></small></small></h4>
                                                <p><?= $post["deskripsi"]; ?></p>
                                            </div>

                                            <a class="btn shadow mb-3" href="<?= $post["link"] ?>" style="background-color:#6aa5a9; color: white;" target="_blank">Go Link</a><br>
                                            <i <?php if (checkPostLiked($row['id'], $post['id'])) : ?> class="bi bi-heart-fill text-danger fs-5 mx-1 like_button" <?php else : ?> class="bi bi-heart fs-5 mx-1 like_button" <?php endif ?> data-id="<?= $post["id"] ?>"></i>
                                            <i class="bi bi-chat fs-5 mx-1 comment_button" data-bs-toggle="modal" data-bs-target="#modal_form" data-id="<?= $post['id'] ?>"></i>
                                            <i <?php if (checkPostBookmarked($row['id'], $post['id'])) : ?> class="bi bi-bookmark-fill text-primary fs-5 mx-1 bookmark_button" <?php else : ?> class="bi bi-bookmark fs-5 mx-1 bookmark_button" <?php endif ?> data-id="<?= $post["id"] ?>"></i>
                                            <br>

                                        <?php } ?>
                                        <span class="likes"><?= getPostLikes($post['id']); ?> Likes</span>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>

                <?php
            }

            //insert comments

            if (isset($_POST['create_comment'])) {
                global $conn;
                $comment_author = $_SESSION['user_id'];
                $temp;
                $comment_content = $_POST['comment_content'];

                $query = "INSERT INTO comments VALUES (null, '{$comment_content}', $temp, $comment_author, null, now()) ";
                $send_comment = mysqli_query($conn, $query);

                if (!$send_comment) {
                    die(mysqli_error($conn));
                }
            }

                ?>


                <div class="row">
                    <div class="media border pl-3 pt-3 pb-3 pr-5 mb-3 shadow">
                        <div class="card">
                            <div class="card-body p-4">
                                <form action="" method="post" role="form">
                                    <div class="form-group">
                                        <textarea class="form-control mb-3" name="comment_content" rows="3">Your Comments!</textarea>
                                    </div>
                                    <button type="submit" name="create_comment" class="btn btn-primary mb-5">Submit</button>
                                </form>

                                <div class="row">
                                    <div class="col">
                                        <div class="d-flex flex-start">
                                            <?php
                                            // show comment berdasarkan post
                                            $query = "SELECT * FROM comments WHERE post_id = $temp";
                                            $select_comment = mysqli_query($conn, $query);

                                            while ($row = mysqli_fetch_assoc($select_comment)) {
                                                $user_id = $row['user_id'];

                                                $query_username = "SELECT * FROM users WHERE id = $user_id";
                                                $send_user = mysqli_query($conn, $query_username);

                                                while ($row2 = mysqli_fetch_assoc($send_user)) {

                                            ?>
                                                    <img class="rounded-circle shadow-1-strong me-3" src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" alt="avatar" width="65" height="65" />
                                                    <div class="flex-grow-1 flex-shrink-1">
                                                        <div>
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p class="mb-1">
                                                                    <?php echo $row2['username']; ?> <span class="small">- <?php echo $row['waktu_komentar']; ?></span>
                                                                </p>
                                                            </div>
                                                            <p class="small mb-0">
                                                                <?php echo $row['komentar']; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                        </div>
                                    </div>
                                </div>
                        <?php

                                                }
                                            }

                        ?>
                            </div>
                        </div>
                    </div>
                </div>


                </div>
            </div>
        </div>

        <footer>
            <div class=" row">
                <div class="col-lg-12 text-center mt-5">
                    <p><small>Copyright &copy; Slink 2022</small></p>
                </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="js/home.js"></script>
    </body>

    </html>