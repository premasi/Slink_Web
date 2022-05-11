<?php
// Import Function
require "function.php";

// Mengajukan Registrasi
if (isset($_POST["register"])) {

    // Cek Berhasil Registrasi atau Tidak
    if (register($_POST) > 0) {
        echo
        "
        <script>
        alert('User Berhasil Dibuat!');
        </script>
        ";
    } else {
        echo
        "
        <script>
        alert('User Gagal Dibuat!');
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Slink | Register</title>
</head>

<body>

    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Register</p>

                                    <form class="mx-1 mx-md-4" action="" method="post">

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0 form-group">
                                                <input type="text" name="nama" id="nama" class="form-control" required />
                                                <label for="nama">Nama Lengkap</label>
                                                <?php if (isset($info_nama)) echo $info_nama ?>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0 form-group">
                                                <input type="text" name="username" id="username" class="form-control" required />
                                                <label for="username">Username</label>
                                                <?php if (isset($info_username)) echo $info_username; ?>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="email" name="email" id="email" class="form-control" require />
                                                <label class="form-label" for="email">Email</label>
                                                <?php if (isset($info_email)) echo $info_email; ?>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" name="password" id="password" class="form-control" require />
                                                <label class="form-label" for="password">Password(Min 8 Karakter)</label>
                                                <?php if (isset($info_pass)) echo $info_pass; ?>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" name="passwordCon" id="passwordCon" class="form-control" require />
                                                <label class="form-label" for="passwordCon">Konfirmasi Password</label>
                                                <?php if (isset($info_passCon)) echo $info_passCon; ?>
                                            </div>
                                        </div>

                                        <div class="form-check d-flex justify-content-center mb-3">
                                            <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                                            <label class="form-check-label" for="form2Example3">
                                                I agree all statements in <a href="#!">Terms of service</a>
                                            </label>
                                        </div>


                                        <div class="d-flex justify-content-center mt-2 mb-3">
                                            <p>Sudah Punya Akun? <a href="./login.php" class="text-decoration-none">Login</a></p>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" name="register" class="btn btn-primary btn-lg">Register</button>
                                        </div>

                                    </form>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                    <img src="../Foto/register.png" class="img-fluid" alt="https://pngtree.com/so/Cartoon">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>