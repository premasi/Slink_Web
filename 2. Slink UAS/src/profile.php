<?php
require "./function.php";

ob_start();

$user_id = $_SESSION['user_id'];

// Get Data Profile
if (isset($user_id)) {

    $profile = getProfile($user_id);

    $nama = $profile[0]['nama'];
    $username = $profile[0]['username'];
    $foto = $profile[0]['foto'];
    $bio = $profile[0]['bio'];
    $date = $profile[0]['waktu_bergabung'];
    $count_posts = $profile[0]['count_posts'];
    $count_likes = $profile[0]['count_likes'];
    $count_follower = $profile[0]['count_follower'];
    $count_following = $profile[0]['count_following'];

    if ($foto == "" || empty($foto) || $foto == null) {
        $tag = "<img class='rounded-circle mt-5' width='150px' src='../Foto/user.png'><span class=' font-weight-bold'>$foto</span>";
    } else {
        $tag = "<img class='rounded-circle mt-5' width='150px' height='150px'src='../Foto/$foto'><span class=' font-weight-bold'>$foto</span>";
    }

    // Update Profile
    if (isset($_POST['update_prof'])) {
        $profileStatus = updateProfile($_POST, $_FILES, $user_id);
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>profil</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.2/font/bootstrap-icons.min.css" integrity="sha512-YzwGgFdO1NQw1CZkPoGyRkEnUTxPSbGWXvGiXrWk8IeSqdyci0dEDYdLLjMxq1zCoU0QBa4kHAFiRhUL3z2bow==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<!-- navigasi -->
<div class="animasi2">

    <?php include("./include/navbar.php"); ?>

    <!-- profil -->
    <div class="container-xl ">
        <form class="profil " action="" method="post" enctype="multipart/form-data">
            <div class="container rounded bg-white ms-5 mt-5 mb-5">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5 shadow-sm p-3 mb-5 bg-body rounded">
                            <!-- Foto -->
                            <?php echo $tag; ?>
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Your Avatar</label>
                                <input class="form-control form-control-sm" name="image" id="formFileSm" type="file">
                            </div>
                            <br>
                            <span>
                                <div class="row">
                                    <div class="col">
                                        Post <br> <?= $count_posts; ?>
                                    </div>
                                    <div class="col">
                                        Like <br> <?= $count_likes; ?>
                                    </div>
                                    <div class="row mt-3 d-flex justify-content-center">
                                        <div class="col">
                                            Follower <br> <?= $count_follower; ?>
                                        </div>

                                        <div class="col">
                                            Following <br> <?= $count_following; ?>
                                        </div>
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-5 border-right">
                        <div class="p-3 py-5">
                            <?php if (isset($profileStatus["error_space"])) echo $profileStatus["error_space"] ?>
                            <?php if (isset($profileStatus["error_username"])) echo $profileStatus["error_username"] ?>
                            <?php if (isset($profileStatus["success"])) echo $profileStatus["success"] ?>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Profile Settings</h4>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <label class="labels">Nama</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Nama" value="<?php echo $nama; ?>">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <label class="labels">Username</label>
                                    <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $username; ?>">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <label for="floatingTextarea">Bio</label>
                                <div class="col-md-12">
                                    <textarea class="form-control" name="bio" placeholder="Masukan Bio" id="floatingTextarea"><?php echo $bio; ?></textarea>
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
                                    <button class="btn btn-success profile-button" name="update_prof" type="submit">Save Profile</button>
                                    <a class="btn btn-outline-danger mx-3" href="./cms.php?logout=<?= true ?>" id="logout">Logout</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </script>
    </body>

</html>