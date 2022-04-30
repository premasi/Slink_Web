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

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style2.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet">
  <title>Slink | Registration</title>
</head>

<body>

  <div class="animasi">
    <section class="container-fluid">
      <!-- justify-content-center untuk mengatur posisi form agar berada di tengah-tengah -->

      <section class="row justify-content-center">
        <section class="col-12 col-sm-6 col-md-4 m-5">
          <form class="form-container border" action="" method="POST">
            <h4 class="text-center font-weight-bold"> Sign Up </h4>
            <br><br>
            <div class="form-group">
              <label for="fname">First Name<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="fname" id="fname" placeholder="Masukkan Nama Depan" required>
            </div>
            <div class="form-group">
              <label for="lname">Last Name<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="lname" id="lname" placeholder="Masukkan Nama Belakang" required>
            </div>
            <div class="form-group">
              <label for="gender">Jenis Kelamin</label><br><br>
              <input class="form-check-input" type="radio" name="gender" value="laki">
              <label class="form-check-label" for="laki">Laki - laki</label>
              <input class="form-check-input" type="radio" name="gender" value="perempuan">
              <label class="form-check-label" for="perempuan">Perempuan</label>
              <input class="d-none" type="radio" name="gender" value="Rahasia" checked>
            </div>
            <div class="form-group">
              <label for="noTelp">No-Telp<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="noTelp" id="noTelp" placeholder="Masukan No-Telephone" required>
              <h6 class="mt-1" id="telp-text"></h6>
            </div>
        </section>

        <section class="col-12 col-sm-6 col-md-4 m-5 form-container border">

          <div class="form-group ">
            <label for="profesi">Profesi</label>
            <input type="text" class="form-control" name="profesi" id="profesi" placeholder="Masukan Profesi">
          </div>
          <div class="form-group">
            <label for="username">Username<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Masukan Password(Min 5 Karakter)" required>
            <h6 class="mt-1" id="user-text"></h6>
          </div>
          <div class="form-group">
            <label for="password">Password<span class="text-danger">*</span></label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Masukan Password" required>
          </div>
          <div class="form-group">
            <label for="passwordCon">Konfirmasi Password<span class="text-danger">*</span></label>
            <input type="password" class="form-control" name="passwordCon" id="passwordCon" placeholder="Masukan Ulang Password" required>
          </div>
          <div class="form-group">
            <label for="linkedin">Link LinkedIn</label>
            <input type="text" class="form-control" id="linkedin" name="linkedin" placeholder="Masukan Link linkedin">
          </div>
          <br><br>
          <center><button class="btn-lg" name="register" type="submit">Sign Up</button>
            <div class="form-footer mt-2">
              <br>
              <p> Sudah Punya Akun? <a href="./login.php">Login</a></p>
            </div>
        </section>

        </form>
      </section>
    </section>
    </section>
    <br><br><br>
  </div>
  <footer>
    <div class="row">
      <div class="col-lg-12 text-center mt-5">
        <p><small>Copyright &copy; Slink 2022</small></p>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
  </footer>
</body>

</html>