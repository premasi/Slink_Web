<?php 
require "function.php";

ob_start();

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style2.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet">
    <title>Slink | Delete Account</title>
</head>

<?php 
$validation_text = "Saya Menyetujui";

if(isset($_POST['delete_user'])){
    $text = $_POST['text'];

    if($text === $validation_text){
        $query = "DELETE FROM users WHERE id = $user_id";
        $delete_account = mysqli_query($conn, $query);

        if(!$delete_account){
            die(mysqli_error($conn));
        }  

        echo "<script type ='text/JavaScript'>alert('Akun dihapus')</script>";
        
        header("location: ../index.php");
    } else {
        echo "<script type ='text/JavaScript'>alert('Kalimat tidak sesuai')</script>";
    }

}

?>

<body>
    <main class="animasi">
        <div class="login border shadow p-3 mb-1 bg-body rounded-5 position-relative">
            <center><img src="../Foto/logo.png" alt="Logo_slink" class="logo1"></center>
            <h1 class="h3 mb-3 fw-normal">Delete Account</h1>
            <form action="" method="POST">
                <h3 class="mb-3 font-weight-bold"">Ketikan "<?php echo $validation_text;?>"</h3>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="text" required />
                    <label class="fw-normal" for="username">Masukan kalimat</label>
                </div>
                <div class="row d-grid gap-2 col-6 mx-auto">
                    <br />
                    <button class="btn btn-outline-danger" id="login" name="delete_user" type="submit">Delete Account</button>
                    <h6 class="text-center"><a href="home.php" class="text-decoration-none"><small>Kembali</small></a></h3>
                </div>
            </form>
        </div>
    </main>
    <!--akhir login-->

</body>

</html>