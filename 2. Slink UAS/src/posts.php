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

        <!-- Navigation -->
        <?php
        include("./include/navbar.php");


        ?>

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

                                <?php
                                // show comment berdasarkan post
                                $query = "SELECT * FROM comments WHERE post_id = $temp";
                                $select_comment = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($select_comment)) {
                                    $user_id = $row['user_id'];
                                    $com_id = $row['id'];

                                    $query_username = "SELECT * FROM users WHERE id = $user_id";
                                    $send_user = mysqli_query($conn, $query_username);

                                    while ($row2 = mysqli_fetch_assoc($send_user)) {
                                        $foto = $row2['foto'];

                                        if ($foto == "" || empty($foto) || $foto == null) {
                                            $tag = "<img class='rounded-circle shadow-1-strong me-3' src='../Foto/user.png' alt='avatar' width='65' height='65' />";
                                        } else {
                                            $tag = "<img class='rounded-circle shadow-1-strong me-3' src='../Foto/$foto' alt='avatar' width='65' height='65' />";
                                        }

                                ?>
                                        <div class="row mt-3 mb-3">
                                            <div class="col">
                                                <div class="d-flex flex-start">
                                                    <?php echo $tag; ?>
                                                    <div class="flex-grow-1 flex-shrink-1">
                                                        <div>
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <p class="mb-1">
                                                                    <?php echo $row2['username']; ?> <span class="small">- <?php echo $row['waktu_komentar']; ?></span>
                                                                </p>
                                                                <a href="" onclick=""><i class="fas fa-reply fa-xs" ></i><span class="small"> Reply</span></a>
                                                            </div>
                                                            <p class="small mb-0">
                                                                <?php echo $row['komentar']; ?>
                                                            </p>
                                                        </div>

                                                        <div class="d-flex flex-start mt-4">

                                                            <!-- reply comments query -->
                                                            <?php
                                                            if (isset($com_id)) {

                                                                if (isset($_POST['reply_submit'])) {
                                                                    $comment_author = $_SESSION['user_id'];
                                                                    $temp;
                                                                    $reply_content = $_POST['reply_content'];

                                                                    $query = "INSERT INTO comments VALUES (null, '{$reply_content}', $temp, $comment_author,  $com_id, now()) ";
                                                                    $send_reply = mysqli_query($conn, $query);

                                                                    if (!$send_reply) {
                                                                        die(mysqli_error($conn));
                                                                    }
                                                                }
                                                            }


                                                            ?>


                                                            <a class="me-3" href="#">
                                                                <img class="rounded-circle shadow-1-strong" src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(11).webp" alt="avatar" width="65" height="65" />
                                                            </a>
                                                            <div class="flex-grow-1 flex-shrink-1">
                                                                <div>
                                                                    <div class="d-flex justify-content-between align-items-center">
                                                                        <p class="mb-1">
                                                                            Simona Disa <span class="small">- 3 hours ago</span>
                                                                        </p>
                                                                    </div>
                                                                    <p class="small mb-0">
                                                                        letters, as opposed to using 'Content here, content here',
                                                                        making it look like readable English.
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
            </div>
        </div>

        <footer>
            <div class=" row">
                <div class="col-lg-12 text-center mt-5">
                    <p><small>Copyright &copy; Slink 2022</small></p>
                </div>
            </div>
        </footer>


        <!-- Reply comment form -->
        <div class="flex-grow-1 flex-shrink-1">
            <form action="" method="post">
                <div class="input-group mb-3">
                    <textarea type="text" class="form-control" placeholder="Your Reply" name="reply_content"></textarea>
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit" name="reply_submit">Button</button>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Form-->
        <div class="modal fade" id="modal_form" tabindex="-1" aria-labelledby="modal_form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_label">Komentar</h5>
                        <div id="message"></div>
                        <button type="button" class="btn-close" id="close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Komentar-->
                    </div>
                    <hr>
                    <div class="mb-5">
                        <form action="" method="POST" id="comment_form">
                            <input type="hidden" name="user_id" value="<?= $user_id ?>">
                            <input type="hidden" name="post_id" id="post_id">
                            <input type="hidden" name="parent_comment_id" id="parent_comment_id" value="0">
                            <input type="hidden" name="submit_comment">
                            <div class="row mb-2 mx-1">
                                <div class="col-8">
                                    <textarea class="form-control form-control-sm" id="comment" name="comment" placeholder="Tulis comment..." required></textarea>
                                </div>
                                <div class="col-3">
                                    <button type="submit" class="btn btn-outline-primary" name="button_submit_comment">Comment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="js/home.js"></script>
    </body>

    </html>