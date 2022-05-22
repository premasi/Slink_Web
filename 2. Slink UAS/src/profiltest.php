<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil muncul</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-white shadow-sm p-3">
        <div class="container-fluid">
            <a class="navbar-brand ms-5" href="../index.php"><img src="../Foto/logo.png" alt="" width="105px" /></a>
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
                <a class="nav-link me-5 " href="" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                    aria-controls="offcanvasRight">Raka Guntara</a>

                <!-- <button class="btn " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                    aria-controls="offcanvasRight"></button> -->
            </div>
        </div>
    </nav>
    <!-- 
    <div class="animasi2">
        <nav class="navbar navbar-expand">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.php"><img src="../Foto/logo.png" alt="" /></a>
            </div>
            <button class="btn " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                aria-controls="offcanvasRight">profil</button>
            <a class="navbar-brand position-absolute top-50 start-50 translate-middle p-1 text-black " href="./cms.php">
                <h3>Home</h3>
            </a>
        </nav>
    </div> -->


    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Profile</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container d-flex justify-content-center align-items-center">

                <div class="card ">
                    <div class="upper">
                    </div>
                    <div class="user text-center">

                        <div class="position-absolute " style="margin-top: 400px; margin-right: 150px;">
                            <a class="navbar-brand" href="./profil1.php"><img src="../Foto/setting.svg" alt="" /></a>
                        </div>
                        <div class="mx-5 position-absolute " style="margin-top: 420px; margin-right: 50px;">
                            <a class="navbar-brand" href="../index.php"><img src="../Foto/bookmark.svg" alt="" /></a>
                        </div>
                        <div class="profile m-4">
                            <img src="../Foto/raka.jpg" class="rounded-circle" width="80">
                        </div>
                        <br>
                    </div>
                    <div class="mt-4 text-center">
                        <h4 class="mb-0">Raka Rianda Guntara</h4>
                        <span class="text-muted d-block mb-2">Pantai Selatan</span>
                        <button class="btn btn-success btn-sm follow ">
                            <div class="mx-5 fw-semibold">Follow</div>
                        </button>
                        <div class="d-flex justify-content-between align-items-center mt-4 px-4">
                            <div class="stats">
                                <h6 class="mb-0">Followers</h6>
                                <span>9999</span>
                            </div>
                            <div class="stats">
                                <h6 class="mb-0">Post</h6>
                                <span>9999</span>
                            </div>
                            <div class="stats">
                                <h6 class="mb-0">Like</h6>
                                <span>9999</span>
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