<?php
// Import Function
require "function.php";

// Redirect Ke Halaman Login
if (isset($_SESSION["login"])) {
    header("Location: home.php");
    exit();
}

// Trigger Request OTP
if (isset($_POST['getOtp'])) {
    $otpStatus = sendOTP($_POST['email']);
}

// Trigger Verifikasi
if (isset($_POST['submit_verifikasi'])) {
    $verifikasiStatus = verifikasi($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <title>Slink | Verifikasi</title>
</head>

<body>
    <main class="container shadow p-3 mb-5 bg-body rounded m-auto mt-5 w-75">
        <h4 class="text-center mb-5">Verifikasi</h4>
        <div class="w-50 m-auto">
            <p class="alert alert-warning">Silahkan Masukan <strong>Email</strong> dan Kode <strong>OTP</strong> yang Masuk Ke Email tersebut untuk Melakukan Verifikasi Terhadap Akun Anda...</p>
            <p class="alert alert-info"> Jika Kode <strong>OTP</strong> Tidak Ada Silahkan Masukan <strong>Email</strong> dan Tekan Tombol <strong>"Minta OTP"</strong> </p>
            <!-- Info Hasil Proses -->
            <?php if (isset($otpStatus['error_emailVal'])) echo $otpStatus['error_emailVal'];  ?>
            <?php if (isset($otpStatus['error_user'])) echo $otpStatus['error_user'];  ?>
            <?php if (isset($otpStatus['error_verified'])) echo $otpStatus['error_verified'];  ?>
            <?php if (isset($otpStatus['error_send'])) echo $otpStatus['error_send'];  ?>
            <?php if (isset($verifikasiStatus['error_emailVal'])) echo $verifikasiStatus['error_emailVal'];  ?>
            <?php if (isset($verifikasiStatus['error_user'])) echo $verifikasiStatus['error_user'];  ?>
            <?php if (isset($verifikasiStatus['error_verified'])) echo $verifikasiStatus['error_verified'];  ?>
            <?php if (isset($verifikasiStatus['error_space'])) echo $verifikasiStatus['error_space'];  ?>
            <?php if (isset($verifikasiStatus['error_otp'])) echo $verifikasiStatus['error_otp'];  ?>
            <?php if (isset($verifikasiStatus['success'])) echo $verifikasiStatus['success'];  ?>
            <form action="" method="POST">
                <div class="form-floating mb-1">
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                    <label for="email">Email</label>
                </div>
                <button type="submit" class="btn btn-success mb-3" name="getOtp" id="getOtp">Minta OTP</button>
                <?php if (isset($otpStatus['success'])) echo $otpStatus['success'];  ?>
                <div class="form-floating mt-3">
                    <input type="otp" class="form-control" id="otp" name="otp" placeholder="otp">
                    <label for="otp">OTP</label>
                </div>
                <div class="col-2 m-auto">
                    <button type="submit" id="submit_verifikasi" name="submit_verifikasi" class="btn btn-primary mt-3 m-auto">Verifikasi</button>
                </div>
            </form>
        </div>
        <h6 class="my-4 text-center">Ayo <a href="login.php" class="text-decoration-none">Login!</a></h3>
    </main>
    <footer>
        <div class="row">
            <div class="col-lg-12 text-center mt-5">
                <p><small>Copyright &copy; Slink 2022</small></p>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>