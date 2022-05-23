        <!-- Header Berisi Navbar -->
        <header class="animasi3">
            <nav class="navbar navbar-expand-lg bg-white shadow-sm p-3">
                <div class="container-fluid">
                    <a class="navbar-brand ms-5" href="./home.php"><img src="../Foto/logo.png" alt="" width="105" /></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="./home.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./cms.php">Links</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">About us</a>
                            </li>
                        </ul>
                        </ul>
                        <?php
                        $user_id = $_SESSION['user_id'];
                        $query = "SELECT * FROM users WHERE id = $user_id";
                        $select_user = mysqli_query($conn, $query);

                        while($row = mysqli_fetch_assoc($select_user)){
                            $id = $row['id'];
                            $nama = $row['nama'];
                            $foto = $row['foto'];
                            
                            if($foto == "" || empty($foto) || $foto == null){
                                echo "<img src='../Foto/user.png' class='rounded-circle me-3' width='40px'>";                                
                            } else {
                                echo "<img src='../Foto/{$foto}' class='rounded-circle me-3' width='40px'>";
                            }
                        
                        ?>                        

                        <a class="nav-link me-5" href="./profil1.php"><?php echo $nama;?></a>
                        <a class="nav-link me-5" href="./cms.php?logout=<?= true ?>" id="logout">Log Out</a>
                        
                        <?php } ?>
                        <!-- <button class=" btn " type=" button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                    aria-controls="offcanvasRight"></button> -->
                    </div>
                </div>
            </nav>
        </header>