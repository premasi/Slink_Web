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

    // Cek Username Digunakan atau Belum
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        return ["error_email" => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Email Tidak Valid!</strong> Silahkan Gunakan Email yang Benar
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
