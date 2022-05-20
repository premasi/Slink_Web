<?php
// Import Function
require "function.php";

if (isset($_POST['getOtp'])) {
    $otpStatus = sendOTP($_POST['email']);
}

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
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <title>Slink | Verifikasi</title>
</head>

<body>
    <section class="container shadow p-3 mb-5 bg-body rounded m-auto mt-5 w-75">
        <h4 class="text-center mb-5">Verifikasi</h4>
        <div class="w-50 m-auto">
            <p class="alert alert-warning">Silahkan Masukan <strong>Email</strong> dan Kode <strong>OTP</strong> yang Masuk Ke Email tersebut untuk Melakukan Verifikasi Terhadap Akun Anda...</p>
            <p class="alert alert-info"> Jika Kode <strong>OTP</strong> Tidak Ada Silahkan Masukan <strong>Email</strong> dan Tekan Tombol <strong>"Minta OTP"</strong> </p>
            <!-- Info Hasil Proses -->
            <?php if (isset($otpStatus['error_emailVal'])) echo $otpStatus['error_emailVal'];  ?>
            <?php if (isset($otpStatus['error_user'])) echo $otpStatus['error_user'];  ?>
            <?php if (isset($otpStatus['error_verified'])) echo $otpStatus['error_verified'];  ?>
            <?php if (isset($verifikasiStatus['error_emailVal'])) echo $verifikasiStatus['error_emailVal'];  ?>
            <?php if (isset($verifikasiStatus['error_user'])) echo $verifikasiStatus['error_user'];  ?>
            <?php if (isset($verifikasiStatus['error_verified'])) echo $verifikasiStatus['error_verified'];  ?>
            <?php if (isset($verifikasiStatus['error_space'])) echo $verifikasiStatus['error_space'];  ?>
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
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="./js/verifikasi.js"></script>
</body>

</html>