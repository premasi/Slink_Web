<!doctype html>
<html lang="en">

<?php
require "./function.php";
ob_start();
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>profil</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<!-- navugasi -->
<div class="animasi2">
    <?php
    include("./include/navbar.php");
    ?>

    <!-- Query profile -->
    <?php
    $user_id = $_SESSION['user_id'];

    if (isset($user_id)) {

        $query = "SELECT * FROM users WHERE id = $user_id";
        $get_profile = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($get_profile)) {
            $nama = $row['nama'];
            $username = $row['username'];
            $foto = $row['foto'];
            $email = $row['email'];
            $bio = $row['bio'];
            $date = $row['waktu_bergabung'];

            if ($foto == "" || empty($foto) || $foto == null) {
                $tag = "<img class='rounded-circle mt-5' width='150px' src='../Foto/user.png'><span class=' font-weight-bold'>$foto</span>";
            } else {
                $tag = "<img class='rounded-circle mt-5' width='150px' height='150px'src='../Foto/$foto'><span class=' font-weight-bold'>$foto</span>";
            }
        }


    ?>

    <!-- Query update -->
    <?php
        if (isset($_POST['update_prof'])) {
            $name = $_POST['name'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $bio = $_POST['bio'];

            $foto = $_FILES['image']['name'];
            $foto_temp = $_FILES['image']['tmp_name'];

            $query = "UPDATE users SET nama = '{$name}', ";
            $query .= "username = '{$username}', ";
            $query .= "email = '{$email}', ";
            $query .= "foto = '{$foto}', ";
            $query .= "bio = '{$bio}' WHERE id = $user_id ";

            move_uploaded_file($foto_temp, "../Foto/$foto");

            if(empty($foto)){
                $query = "SELECT * FROM users WHERE id = $user_id ";

                $select_image = mysqli_query($conn,$query);

                while ($row = mysqli_fetch_array($select_image)){

                    $foto = $row['foto'];
                }

                if(!$select_image){
                    die("Query".mysqli_error($conn));
                }
           }

            $update_user = mysqli_query($conn, $query);

            if (!$update_user) {
                die(mysqli_error($conn));
            } 

            header("location: profil1.php");
        }
    }
    ?>


    <!-- profil -->
    <div class="container-xl ">
        <form class="profil " action="" method="post" enctype="multipart/form-data">
            <div class="container rounded bg-white ms-5 mt-5 mb-5">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div
                            class="d-flex flex-column align-items-center text-center p-3 py-5 shadow-sm p-3 mb-5 bg-body rounded">
                            <!-- Foto -->
                            <?php echo $tag; ?>
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Your Avatar</label>
                                <input class="form-control form-control-sm" name="image" id="formFileSm" type="file">
                            </div>
                            <br>
                            <span>
                                <div class="row">
                                    <!-- <div class="col">
                                        Followrs<br> 9999
                                    </div> -->
                                    <?php
                                    //count jumlah post berdasarkan user_id
                                    $query = "SELECT * FROM posts WHERE user_id = $user_id";
                                    $count_post = mysqli_query($conn, $query);

                                    $count = mysqli_num_rows($count_post);


                                    ?>
                                    <div class="col">
                                        Post <br> <?php echo $count; ?>
                                    </div>
                                    <!-- <div class="col">
                                        Like <br> 9999
                                    </div> -->
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-5 border-right">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Profile Settings</h4>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <label class="labels">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="full name"
                                        value="<?php echo $nama; ?>">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <label class="labels">Username</label>
                                    <input type="text" name="username" class="form-control"
                                        placeholder="enter your email" value="<?php echo $username; ?>">
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Email </label>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="enter address line " value="<?php echo $email; ?>">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <label for="floatingTextarea">Bio</label>
                                <div class="col-md-12">
                                    <textarea class="form-control" name="bio" placeholder="Leave a comment here"
                                        id="floatingTextarea"><?php echo $bio; ?></textarea>
                                </div>
                            </div>
                            <div class="mt-5 text-center"></div>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="p-3 py-5">
                            <br><br>
                            <div class="col-md-12"><label class="labels">Waktu Bergabung</label><br>
                                <span class="fs-3"><?php echo $date; ?></span>
                                <br><br>
                                <div class=" col-md-12">
                                    <input class="btn btn-success profile-button" name="update_prof" type="submit"
                                        value="Save Profile">
                                    <a class="btn btn-outline-danger mx-3" href="./cms.php?logout=<?= true ?>"
                                        id="logout">Logout</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    </body>

</html>