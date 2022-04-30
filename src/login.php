<?php
// Import Function
require "function.php";

// Penggunaan Cookie
if (isset($_COOKIE["user_id"]) && isset($_COOKIE['key'])) {
  $id = $_COOKIE['user_id'];
  $key = $_COOKIE['key'];

  $cek = queryGetData("SELECT * FROM users WHERE id = $id");

  if ($key = hash('sha256', $cek['username'])) {
    $_SESSION['login'] = true;
  }
}

// Redirect Ke Halaman Home Ketika Sudah Login
if (isset($_SESSION["login"])) {
  header("Location: home.php");
  exit();
}

// Trigger Login
if (isset($_POST["login"])) {
  if (login($_POST) === (0 || false)) {
    echo
    "
        <script>
        alert('Username atau Password salah!');
        </script>
        ";
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link rel="stylesheet" href="../css/style2.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet">
  <title>Slink | Login</title>
</head>

<body <div class="container">
  <!--awal login-->
  <div class="animasi">
    <div class="login border">
      <center><img src="../Foto/logo.png" alt="Logo_slink" class="logo1"></center>
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
      <form action="" method="POST">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="username" name="username" placeholder="Username" required />
          <label for="username">Username</label>
        </div>
        <div class="form-floating mb-2">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required />
          <label for="password">Password</label>
        </div>
        <div class="form-check">
          <input type="checkbox" name="remember" class="form-check-input" id="remember">
          <label for="remember" class="form-check-label">Remember Me</label>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto">
          <br />
          <button class="btn " id="login" name="login" type="submit">Login</button>
        </div>
      </form>
    </div>
    <center>
      <hr class="my-4">Belum Punya Akun? <a href="register.html">Daftar</a> Sekarang</h3>
    </center>
  </div>
  <!--akhir login-->
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>