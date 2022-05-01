<?php
include "./db.php";
global $connection;

//default condition
$info_name = "";
$info_email = "";
$info_pass = "";
$info_pass2 = "";

if (isset($_POST['submit'])) {
    $username = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    //validation account -- step 1 (Untuk menghindari kerusakan query)
    $username = mysqli_real_escape_string($connection, $username);
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);
    $password2 = mysqli_real_escape_string($connection, $password2);


    // validation account -- step 2
    if (empty($username)) {
        $info_name = "<small style='color: red;'><br>Nama wajib diisi!</small>";
    } 
    else if (empty($email)){
        $info_email = "<small style='color: red;'><br>Email wajib diisi!</small>";
    } 
    else if (empty($password)){
        $info_pass = "<small style='color: red;'><br>Password wajib diisi!</small>";
    }
    else if (strlen($password) < 8){
        $info_pass = "<small style='color: red;'><br>Password harus lebih panjang dari 8 karakter!</small>";
    }    
    else if (empty($password2)){
        $info_pass2 = "<small style='color: red;'><br>Password wajib diisi!</small>";
    }
    else if ($password2 !== $password){
        $info_pass2 = "<small style='color: red;'><br>Password tidak sesuai!</small>";
    }
    else {
    //untuk menencrypt password pengguna
    $hashformat = "2y$10$"; 
    $salt = "willyoumarrymeyeahjust";
    $hash_and_salt = $hashformat . $salt;
    $password = crypt($password, $hash_and_salt);
    
    //query create account
    $query = "INSERT INTO users (user_name, user_email, user_password, tanggal) ";
    $query .= "VALUES ('{$username}', '{$email}', '{$password}', now()) ";
    
    //send query
    $create_user = mysqli_query($connection, $query);
    
    //check query
    if(!$create_user){
        die("Query Failed ".mysqli_error($connection));
    }

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
        <title>Slink-Register</title>
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

                                        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                                        <form class="mx-1 mx-md-4" action="" method="post">

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <input type="text" name="full_name" id="form3Example1c" class="form-control" placeholder="Masukan nama" require />
                                                    <label class="form-label" for="form3Example1c">Your Name</label>
                                                    <?php echo $info_name;?>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <input type="email" name="email" id="form3Example3c" class="form-control" require />
                                                    <label class="form-label" for="form3Example3c">Your Email</label>
                                                    <?php echo $info_email;?>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <input type="password" name="password" id="form3Example4c" class="form-control" require />
                                                    <label class="form-label" for="form3Example4c">Password</label>
                                                    <?php echo $info_pass;?>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <input type="password" name="password2" id="form3Example4cd" class="form-control" require />
                                                    <label class="form-label" for="form3Example4cd">Repeat your password</label>
                                                    <?php echo $info_pass2;?>
                                                </div>
                                            </div>

                                            <div class="form-check d-flex justify-content-center mb-5">
                                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                                                <label class="form-check-label" for="form2Example3">
                                                    I agree all statements in <a href="#!">Terms of service</a>
                                                </label>
                                            </div>

                                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                                <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Register">
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