<?php
// Nyalakan Session
session_start();

// Koneksi ke DB
$conn = mysqli_connect("localhost", "root", "", "slink");

// Fungsi Read/Get Data
function queryGetData($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);

  $rows = [];
  while ($tmp = mysqli_fetch_assoc($result)) {
    $rows[] = $tmp;
  }
  return $rows;
}

// Fungsi Tambah/Buat Data Post
function createPost($data)
{
  global $conn;

  // Pass Data ke Var untuk Diproses 
  $judul = htmlspecialchars($data["judul"]);
  $deskripsi = htmlspecialchars($data["deskripsi"]);
  $link = htmlspecialchars($data["link"]);
  $user_id = (int)htmlspecialchars($data["user_id"]);

  // Cek Field Diisi atau Tidak... Menghindari Inputan Berupa Whitespace(' ')
  if (ctype_space($judul) || ctype_space($deskripsi) || ctype_space($link)) {
    return ["error_space" => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Isi Field Dengan Benar!</strong> Jangan Isi Field dengan whitespace/spasi Saja
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>"];
    exit;
  }

  // Cek Link
  if (filter_var($link, FILTER_VALIDATE_URL) === false) {
    return ["error_link" => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Isi Field Dengan Benar!</strong> Jangan Isi Field dengan whitespace/spasi Saja
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>"];
    exit;
  }

  // Query Insert Data ke DB
  $query = "INSERT INTO posts VALUES (NULL,'$judul','$deskripsi', '$link', NOW(), '$user_id')";

  // Eksekusi Query
  mysqli_query($conn, $query) or die(mysqli_error($conn));

  // Jika Berhasil
  return ["success" => "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Post Berhasil Dibuat!</strong> Ayo Buat Lebih Banyak Post
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>"];
}

// Fungsi Update Data Post
function updatePost($data)
{
  global $conn;

  // Pass Data ke Var untuk Diproses 
  $id = (int)htmlspecialchars($data["id"]);
  $judul = htmlspecialchars($data["judul"]);
  $deskripsi = htmlspecialchars($data["deskripsi"]);
  $link = htmlspecialchars($data["link"]);

  // Cek Field Diisi atau Tidak... Menghindari Inputan Berupa Whitespace(' ')
  if (ctype_space($judul) || ctype_space($deskripsi) || ctype_space($link)) {
    return ["error_space" => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
          <strong>Isi Field Dengan Benar!</strong> Jangan Isi Field dengan whitespace/spasi Saja
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>"];
    exit;
  }

  // Cek Link
  if (filter_var($link, FILTER_VALIDATE_URL) === false) {
    return ["error_link" => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Isi Field Dengan Benar!</strong> Jangan Isi Field dengan whitespace/spasi Saja
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>"];
    exit;
  }

  // Query Update
  $query = "UPDATE posts SET judul = '$judul', deskripsi = '$deskripsi', link = '$link', waktu_aksi = NOW() WHERE id = $id";

  // Eksekusi Query
  mysqli_query($conn, $query) or die(mysqli_error($conn));

  // Jika Berhasil
  return ["success" => "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Post Berhasil Diupdate!</strong> Ayo Buat Post Sesempurna Mungkin
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>"];
}


// Fungsi Hapus Data Post
function deletePost($id)
{
  global $conn;

  // Eksekusi Query
  mysqli_query($conn, "DELETE FROM posts WHERE id = $id") or die(mysqli_error($conn));

  // Jika Berhasil
  return ["success" => "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Post Berhasil Dihapus!</strong> Tetap Semangat Bikin Post Ya
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>"];
}

// Fungsi Cari Data Post berdasarkan Keyword
function searchPosts($keyword, $user_id)
{
  // Query Cari Data

  $query = "SELECT * FROM posts INNER JOIN users ON posts.user_id = users.id WHERE users.id = $user_id AND (posts.judul LIKE '%$keyword%' OR posts.deskripsi LIKE '%$keyword%')";

  // Eksekusi Query untuk Menggunakan Fungsi Get Data
  return queryGetData($query);
}

// Fungsi Registrasi
function register($data)
{

  global $conn;


  $nama = htmlspecialchars(stripslashes($data["nama"]));
  $email = htmlspecialchars(stripslashes($data["email"]));
  $username = htmlspecialchars(stripslashes($data["username"]));
  $password = htmlspecialchars(mysqli_real_escape_string($conn, $data["password"]));
  $passwordCon = htmlspecialchars(mysqli_real_escape_string($conn, $data["passwordCon"]));

  // Cek Field Diisi atau Tidak... Menghindari Inputan Berupa Whitespace(' ')
  if (ctype_space($nama) || ctype_space($email) || ctype_space($username) || ctype_space($password) || ctype_space($passwordCon)) {
    return ["error_space" => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Isi Field Dengan Benar!</strong> Jangan Isi Field dengan whitespace/spasi Saja
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>"];
    exit;
  }


  // Cek Username Digunakan atau Belum
  if (queryGetData("SELECT * FROM users WHERE username = '$username'")) {
    return ["error_username" => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Username Sudah Digunakan!</strong> Silahkan Gunakan Username Lain
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>"];
    exit;
  }

  // Cek Email Valid atau Tidak
  if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    return ["error_emailVal" => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Email Tidak Valid!</strong> Silahkan Gunakan Email yang Benar
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>"];
    exit;
  }

  // Cek Email Digunakan atau Belum
  if (queryGetData("SELECT * FROM users WHERE email = '$email'")) {
    return ["error_emailUni" => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Email Sudah Digunakan!</strong> Silahkan Gunakan Email Lain
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>"];
    exit;
  }

  // Cek Apakah Password Kurang dari 8 Karakter atau Tidak
  if (strlen($password) < 8) {
    return ["error_password" => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Password Tidak Boleh Kurang Dari 8 Karakter!</strong> Silahkan Tambah Karakter untuk Password
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>"];
    exit;
  }

  // Cek Apakah Konfirmasi Password Benar
  if ($password !== $passwordCon) {
    return ["error_passwordCon" => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Konfirmasi Password Salah!</strong> Silahkan Masukan Password yang Sudah diisi Di Field Sebelumnya
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>"];
    exit;
    echo "<script>
        alert('Konfirmasi Password Salah!');
        </script>
        ";
    return false;
  }

  //Menencrypt password pengguna
  $hashformat = "2y$10$";
  $salt = "willyoumarrymeyeahjust";
  $hash_and_salt = $hashformat . $salt;
  $password = crypt($password, $hash_and_salt);

  // // Enkripsi Password Standar
  // $password = password_hash($password, PASSWORD_DEFAULT);

  // Query Insert Data
  $query = "INSERT INTO users VALUES(NULL, '$nama', '$email', '$username', '$password', NOW(), NULL, '0')";

  // Eksekusi Query
  mysqli_query($conn, $query) or die(mysqli_error($conn));

  // Cek Berhasil atau Tidak
  return ["success" => "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Registrasi Berhasil!</strong> Silahkan verifikasi Akun Menggunakan Email dan Kode OTP yang Sudah Dikirim ke Email
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>"];
}

// Fungsi Login
function login($data)
{
  $username = $data["username"];
  $password = $data["password"];

  // Cek Username
  if ($cek = queryGetData("SELECT * FROM users WHERE username = '$username'")) {

    // Cek Password
    if (password_verify($password, $cek[0]["password"])) {

      // Set Session
      $_SESSION["login"] = true;
      $_SESSION["user_id"] = $cek[0]["id"];

      if (isset($data['remember'])) {
        setcookie('user_id', $cek['id'], time() + 250);
        setcookie('key', hash('sha256', $cek['username']), time() + 250);
      }

      header("Location: home.php");
      exit();
    }
    return ["error" => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Username atau Password Salah!</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>"];
    exit;
  }
}

// Fungsi Logout
function logout()
{

  // Hapus Session
  $_SESSION['login'] = '';
  session_unset();
  session_destroy();


  // Hapus Cookie
  setcookie('user_id', '', time() - 3600);
  setcookie('key', '', time() - 3600);

  header('location: ../index.php');
}

// Fungsi Menghitung Jumlah Like di Post
function getPostLikes($post_id)
{
  global $conn;

  // Query Hitung Like
  $query = "SELECT getPostLikes($post_id)";

  // Eksekusi Query
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  $rows = mysqli_fetch_array($result);
  return $rows[0];
}

// Fungsi Cek Post di Like atau Belum
function checkPostLiked($user_id, $post_id)
{
  global $conn;

  // Query Hitung Like
  $query = "SELECT checkPostLiked($user_id, $post_id)";

  // Eksekusi Query
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  $rows = mysqli_fetch_array($result);
  if ($rows[0] > 0) {
    return true;
  } else {
    return false;
  }
}

function checkPostBookmarked($user_id, $post_id)
{
  global $conn;

  // Query Hitung Like
  $query = "SELECT checkPostBookmarked($user_id, $post_id)";

  // Eksekusi Query
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  $rows = mysqli_fetch_array($result);
  if ($rows[0] > 0) {
    return true;
  } else {
    return false;
  }
}

function showComments($post_id)
{
  global $conn;

  $query = "SELECT comments.id, users.id AS user_id, users.username, comments.komentar, comments.waktu_komentar FROM comments INNER JOIN users ON comments.user_id = users.id WHERE comments.post_id = $post_id AND comments.parent_comment_id = 0 ORDER BY comments.waktu_komentar ASC";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  $comments = '';
  while ($comment = mysqli_fetch_assoc($result)) {
    $comments .= '
    <div class="card w-50 mb-4 border-primary">
      <div class="card-body">
          <div class="row justify-content-between">
            <h5 class="col-4">' . $comment['username'] . '</h5>
            <h5 class="col-4">' . $comment['waktu_komentar'] . '</h5>
          </div>
          <div class="mt-4">
            <p>' . $comment['komentar'] . '</p>
          </div>
          <div class="d-flex justify-content-end">
            <button type="button" name="reply" class="btn btn-primary text-white reply" id="' . $comment['id'] . '">Reply</button>
          </div>
        </div>
	  </div>';
    $comments .= getCommentReply($conn, $post_id, $comment["id"]);
  }
  echo $comments;
}

function getCommentReply($conn, $post_id, $parent_comment_id = 0, $bd = 'border-primary', $marginLeft = 0)
{
  $comments = '';
  $query = "SELECT comments.id, users.id AS user_id, users.username, comments.komentar, comments.waktu_komentar FROM comments INNER JOIN users ON comments.user_id = users.id WHERE comments.post_id = $post_id AND parent_comment_id = '" . $parent_comment_id . "' ";
  $result = mysqli_query($conn, $query);
  $count = mysqli_num_rows($result);

  if ($parent_comment_id == 0) {
    $marginLeft = 0;
  } else {
    $marginLeft = $marginLeft + 80;
    $bdarr = ['border-secondary', 'border-success', 'border-danger', 'border-dark', 'border-warning', 'border-info'];
    $bdkey = array_rand($bdarr, 1);
    $bd = $bdarr[$bdkey];
  }
  if ($count > 0) {
    while ($comment = mysqli_fetch_assoc($result)) {
      $comments .= '
      <div class="card w-50 mb-4  ' . $bd . '" style="margin-left: ' . $marginLeft . 'px">
        <div class="card-body">
          <div class="row justify-content-between">
            <h5 class="col-4">' . $comment['username'] . '</h5>
            <h5 class="col-4">' . $comment['waktu_komentar'] . '</h5>
          </div>
          <div class="mt-4">
            <p>' . $comment['komentar'] . '</p>
          </div>
          <div class="d-flex justify-content-end">
            <button type="button" name="reply" class="btn btn-primary text-white reply" id="' . $comment['id'] . '">Reply</button>
          </div>
        </div>
      </div>';
      $comments .= getCommentReply($conn, $post_id, $comment["id"], $bd, $marginLeft);
    }
  }
  return $comments;
}

function createComment($data)
{
  global $conn;

  // Pass Data ke Var untuk Diproses 
  $post_id = (int)htmlspecialchars($data["post_id"]);
  $user_id = (int)htmlspecialchars($data["user_id"]);
  $parent_comment_id = (int)htmlspecialchars($data["parent_comment_id"]);
  $comment = htmlspecialchars($data["comment"]);

  // Cek Field Diisi atau Tidak... Menghindari Inputan Berupa Whitespace(' ')
  if (ctype_space($comment)) {
    return ["error_space" => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Isi Field Dengan Benar!</strong> Jangan Isi Field dengan whitespace/spasi Saja
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>"];
    exit;
  }

  $query = "INSERT INTO comments VALUES(NULL, '$comment', '$post_id', '$user_id', '$parent_comment_id', NOW())";

  mysqli_query($conn, $query) or die(mysqli_error($conn));

  return mysqli_affected_rows($conn);

  // // Cek Berhasil atau Tidak
  // return ["success" => "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  //       <strong>comment Berhasil Dibuat!</strong>
  //       <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  //     </div>"];
}
