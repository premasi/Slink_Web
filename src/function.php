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
    $query = "UPDATE posts SET judul = '$judul', deskripsi = '$deskripsi', link = '$link', waktu_upload = NOW() WHERE id = $id";

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

    $fname = htmlspecialchars(stripslashes($data["fname"]));
    $lname = htmlspecialchars(stripslashes($data["lname"]));
    $gender = htmlspecialchars(strtolower(stripslashes($data["gender"])));
    $noTelp = htmlspecialchars(strtolower(stripslashes($data["noTelp"])));
    $profesi = htmlspecialchars(stripslashes($data["profesi"]));
    $username = htmlspecialchars(stripslashes($data["username"]));
    $password = htmlspecialchars(mysqli_real_escape_string($conn, $data["password"]));
    $passwordCon = htmlspecialchars(mysqli_real_escape_string($conn, $data["passwordCon"]));
    $linkedin = htmlspecialchars(stripslashes($data["linkedin"]));

    // Cek Field '*' Diisi atau Tidak
    if ((empty($fname)) || (empty($lname)) || (empty($noTelp)) ||  (empty($username)) || (empty($password)) || (empty($passwordCon))) {
        echo
        "
        <script>
        alert('Field '*' Tidak Boleh Kosong!');
        </script>
        ";
        return false;
    }


    // Cek Format Nomor Telepon
    foreach (str_split($noTelp) as $el) {
        if (($el !== '0') && ($el !== '1') && ($el !== '2') && ($el !== '3') && ($el !== '4') && ($el !== '5') && ($el !== '6') && ($el !== '7') && ($el !== '8') && ($el !== '9') && ($el !== '+')) {
            echo "<script>
            alert('Gunakan Format Nomor Telepon yang Benar(0-9, +)!');
            </script>
            ";
            return false;
        }
    }

    // Cek Nomor Telepon Digunakan atau Belum
    if (queryGetData("SELECT * FROM users WHERE no_telp = '$noTelp'")) {
        echo "<script>
        alert('Nomor Telepon Sudah Digunakan!');
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


    // Cek Apakah Password Kurang dari 5 Karakter atau Tidak
    if (strlen($password) < 5) {
        echo "<script>
            alert('Password Tidak Boleh Kurang dari 5 Karakter!');
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


    // Enkripsi Password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Query Insert Data
    $query = "INSERT INTO users VALUES(NULL, '$fname', '$lname', '$gender', '$noTelp', '$profesi', '$username', '$password', '$linkedin', NOW(), NULL, NULL)";

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

    header('location: ../index.php');
}
