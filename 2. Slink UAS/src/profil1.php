<!doctype html>
<html lang="en">

<?php require "./function.php"; 
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
    <nav class="navbar navbar-expand-lg bg-white shadow-sm p-3">
        <div class="container-fluid">
            <a class="navbar-brand ms-5" href="../index.php"><img src="../Foto/logo.png" alt="" width="105" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About as</a>
                    </li>
                </ul>
                </ul>
                <img src="../Foto/raka.jpg" class="rounded-circle me-3" width="40px">

                <?php 
                $user_id = $_SESSION['user_id'];
                $query = "SELECT * FROM users WHERE id = $user_id";
                $select_user = mysqli_query($conn, $query);

                while($row = mysqli_fetch_assoc($select_user)){
                    $id = $row['id'];
                    $nama = $row['nama'];
                    $foto = $row['foto'];
                    $email = $row['email'];
                    
                }
                
                
                ?>
                <a class="nav-link me-5" href="./home.php">Raka Guntara</a>

                <!-- <button class=" btn " type=" button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                    aria-controls="offcanvasRight"></button> -->
            </div>
        </div>
    </nav>




    <!-- profil -->
    <div class="container-xl ">
        <div class="profil ">
            <div class="container rounded bg-white ms-5 mt-5 mb-5">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div
                            class="d-flex flex-column align-items-center text-center p-3 py-5 shadow-sm p-3 mb-5 bg-body rounded">
                            <img class="rounded-circle mt-5" width="150px" src="../Foto/raka.jpg"><span
                                class=" font-weight-bold">Raka Guntara</span>
                            <br>
                            <span>
                                <div class="row">
                                    <!-- <div class="col">
                                        Followrs<br> 9999
                                    </div> -->
                                    <div class="col">
                                        Post <br> 9999
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
                                <div class="col-md-12"><label class="labels">Name</label><input type="text"
                                        class="form-control" placeholder="first name" value=""></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12"><label class="labels">Username</label><input type="text"
                                        class="form-control" placeholder="enter your email" value=""></div>
                                <div class="col-md-12"><label class="labels">Email </label><input type="text"
                                        class="form-control" placeholder="enter address line " value=""></div>
                            </div>
                            <div class="row mt-2">
                                <label for="floatingTextarea">Bio</label>
                                <div class="col-md-12"><textarea class="form-control" placeholder="Leave a comment here"
                                        id="floatingTextarea"></textarea>

                                </div>
                            </div>
                            <div class="mt-5 text-center"></div>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="p-3 py-5">
                            <br><br>
                            <div class="col-md-12"><label class="labels">Waktu Bergabung</label><br>
                                <span class="fs-3">10-10-2022</span>
                                <br><br>
                                <div class=" col-md-12"><button class="btn btn-success profile-button " type="button"
                                        style="">Save
                                        Profile</button><button type="button"
                                        class="btn btn-outline-danger mx-3">Logout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    </body>

</html>