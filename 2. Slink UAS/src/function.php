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
        echo "<script>
        alert('Link/URL Tidak Valid!');
        </script>
        ";
        return false;
    }


    // Query Insert Data ke DB
    $query = "INSERT INTO posts VALUES (NULL,'$judul','$deskripsi', '$link', NOW(), '$user_id')";

    // Eksekusi Query
    mysqli_query($conn, $query) or die(mysqli_error($conn));

    // Cek Berhasil atau Tidak
    return mysqli_affected_rows($conn);
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



    // Query Update
    $query = "UPDATE posts SET judul = '$judul', deskripsi = '$deskripsi', link = '$link', waktu_aksi = NOW() WHERE id = $id";

    // Eksekusi Query
    mysqli_query($conn, $query) or die(mysqli_error($conn));

    // Cek Berhasil atau Tidak
    return mysqli_affected_rows($conn);
}


// Fungsi Hapus Data Post
function deletePost($id)
{
    global $conn;

    // Eksekusi Query
    mysqli_query($conn, "DELETE FROM posts WHERE id = $id") or die(mysqli_error($conn));

    // Cek Berhasil atau Tidak
    return mysqli_affected_rows($conn);
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

    //default condition
    $info_name = "";
    $info_email = "";
    $info_pass = "";
    $info_pass2 = "";

    $nama = htmlspecialchars(stripslashes($data["nama"]));
    $email = htmlspecialchars(stripslashes($data["email"]));
    $username = htmlspecialchars(stripslashes($data["username"]));
    $password = htmlspecialchars(mysqli_real_escape_string($conn, $data["password"]));
    $passwordCon = htmlspecialchars(mysqli_real_escape_string($conn, $data["passwordCon"]));

    // Cek Field Diisi atau Tidak... Menghindari Inputan Berupa Whitespace(' ')
    if (ctype_space($nama) || ctype_space($email) || ctype_space($username) || ctype_space($password) || ctype_space($passwordCon)) {
        echo "<script>
        alert('Isi Field Dengan Benar!');
        </script>
        ";
        return false;
    }


    // Cek Username Digunakan atau Belum
    if (queryGetData("SELECT * FROM users WHERE username = '$username'")) {
        echo "<script>
        alert('Username Sudah Digunakan!');
        </script>
        ";
        return false;
    }

    // Cek Username Digunakan atau Belum
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo "<script>
        alert('Email Tidak Valid!');
        </script>
        ";
        return false;
    }


    // Cek Apakah Password Kurang dari 8 Karakter atau Tidak
    if (strlen($password) < 8) {
        echo "<script>
            alert('Password Tidak Boleh Kurang dari 8 Karakter!');
            </script>
            ";
        return false;
    }

    // Cek Apakah Konfirmasi Password Benar
    if ($password !== $passwordCon) {
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
    return mysqli_affected_rows($conn);
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
        return false;
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
