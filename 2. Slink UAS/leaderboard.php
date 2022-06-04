<?php
require "./function.php";

ob_start();

$user_id = $_SESSION['user_id'];


// if (isset($user_id)) {

	
//     $rank = leaderboard($user_id);
// 	$id = $rank[0]['id'];

//     $username = $rank[0]['username'];
//     $foto = $rank[0]['foto'];
//     $count_posts = $rank[0]['count_posts'];
//     $count_likes = $rank[0]['count_likes'];
//     $count_follower = $rank[0]['count_follower'];
//     $count_bookmarks = $rank[0]['count_bookmark'];
// 	$count_comments = $rank[0]['count_comments'];
// 	$rank_likes  = $rank[0]['rank_like'];
// 	$rank_posts  = $rank[0]['rank_posts'];
// 	$rank_follow  = $rank[0]['rank_follow'];
// 	$rank_bm  = $rank[0]['rank_bm'];
// 	$rank_cm  = $rank[0]['rank_cm'];

//     if ($foto == "" || empty($foto) || $foto == null) {
//         $tag = "<img class='circle-img mb-2' width='150px' src='../Foto/user.png'><span class=' font-weight-bold'>$foto</span>";
//     } else {
//         $tag = "<img class='circle-img mb-2' width='auto' height='auto'src='../Foto/$foto'><span class=' font-weight-bold'>$foto</span>";
//     }  
// }
?>
<!DOCTYPE html>
<html lang="en">

<!-- <head>
    <meta charset="UTF-8">
    <title>Leaderboard</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> -->
<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

<!-- </head> -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Leaderboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/style4.css">
</head>

<body>
    <!-- Header Berisi Navbar -->
    <header class="animasi3">
        <?php
    include("./include/navbar.php");
    ?>
    </header>

    <!-- Rank Likes -->
    <section class="main-content">

        <div class="container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8"><span>
                            <h1>Top Likes</h1>
                        </span></div>
                    <div class="col-sm-4">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-expanded="false">
                                Dropdown button
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <br>
            <div class="row">
                <?php
			// ambil nilai rank
			$rankLikes2= queryGetData("Select user_id from rankLikes where rank = 2") ;
			$rankLikes1 = queryGetData("Select user_id from rankLikes where rank = 1") ;
			$rankLikes3 = queryGetData("Select user_id from rankLikes where rank = 3") ;
			// echo $rankLikes[0]["user_id"];
			?>
                <?php 
				$like2 = leaderboard($rankLikes2[0]["user_id"]);
				$like1 = leaderboard($rankLikes1[0]["user_id"]);
				$like3 = leaderboard($rankLikes3[0]["user_id"]);

				$foto2 = $like2[0]['foto'];
				if ($foto2 == "" || empty($foto2) || $foto2 == null) {
					$tag2 = "<img class='circle-img mb-2' width='150px' src='../Foto/user.png'><span class=' font-weight-bold'>$foto2</span>";
				} else {
					$tag2 = "<img class='circle-img mb-2' width='auto' height='auto'src='../Foto/$foto2'>";
				}

				$foto1 = $like1[0]['foto'];
				if ($foto1 == "" || empty($foto2) || $foto2 == null) {
					$tag1 = "<img class='circle-img mb-2' width='150px' src='../Foto/user.png'><span class=' font-weight-bold'>$foto1</span>";
				} else {
					$tag1 = "<img class='circle-img mb-2' width='auto' height='auto'src='../Foto/$foto1'>";
				}

				$foto3 = $like3[0]['foto'];
				if ($foto3 == "" || empty($foto3) || $foto3 == null) {
					$tag3 = "<img class='circle-img mb-2' width='150px' src='../Foto/user.png'><span class=' font-weight-bold'>$foto3</span>";
				} else {
					$tag3 = "<img class='circle-img mb-2' width='auto' height='auto'src='../Foto/$foto3'>";
				}
				?>
                <!-- rank 2 -->

                <div class="col-sm-4">
                    <div class="leaderboard-card">
                        <div class="leaderboard-card__top">
                            <h3 class="text-center"><?php echo $like2[0]['count_likes'];?></h3>
                        </div>
                        <div class="leaderboard-card__body">
                            <div class="text-center">
                                <?php echo $tag2; ?>
                                <h5 class="mb-0"><?php echo $like2[0]['username'];?></h5>
                                <p class="text-muted mb-0">@sandeep</p>
                                <hr>
                                <div class="row">
                                    <div class="col md-1" style="font-size: 12px;">Followers</div>
                                    <div class="col md-1" style="font-size: 12px;">Posts</div>
                                    <div class=" col md-1" style="font-size: 12px;">Bookmarks</div>
                                    <div class="col md-1" style="font-size: 12px;">Comments</div>
                                </div>
                                <div class="row">
                                    <div class="col"><?php echo $like2[0]['count_follower']; ?></div>
                                    <div class="col"><?php echo $like2[0]['count_posts']; ?></div>
                                    <div class="col"><?php echo $like2[0]['count_bookmark']; ?></div>
                                    <div class="col"><?php echo $like2[0]['count_comments']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- rank 1 -->
                <div class="col-sm-4">
                    <div class="leaderboard-card leaderboard-card--first">
                        <div class="leaderboard-card__top">
                            <h3 class="text-center"><?php echo $like1[0]['count_likes'];?></h3>
                        </div>
                        <div class="leaderboard-card__body">
                            <div class="text-center">
                                <?php echo $tag1; ?>
                                <h5 class="mb-0"><?php echo $like1[0]['username'];?></h5>
                                <p class="text-muted mb-0">@kiranacharyaa</p>
                                <hr>
                                <div class="row">
                                    <div class="col md-1" style="font-size: 12px;">Followers</div>
                                    <div class="col md-1" style="font-size: 12px;">Posts</div>
                                    <div class=" col md-1" style="font-size: 12px;">Bookmarks</div>
                                    <div class="col md-1" style="font-size: 12px;">Comments</div>
                                </div>
                                <div class="row">
                                    <div class="col"><?php echo $like1[0]['count_follower']; ?></div>
                                    <div class="col"><?php echo $like1[0]['count_posts']; ?></div>
                                    <div class="col"><?php echo $like1[0]['count_bookmark']; ?></div>
                                    <div class="col"><?php echo $like1[0]['count_comments']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- rank 3 -->
                <div class="col-sm-4">
                    <div class="leaderboard-card">
                        <div class="leaderboard-card__top">
                            <h3 class="text-center"><?php echo $like3[0]['count_likes'];?></h3>
                        </div>
                        <div class="leaderboard-card__body">
                            <div class="text-center">
                                <?php echo $tag3; ?>
                                <h5 class="mb-0"><?php echo $like3[0]['username'];?></h5>
                                <p class="text-muted mb-0">@sandeep</p>
                                <hr>
                                <div class="row">
                                    <div class="col md-1" style="font-size: 12px;">Followers</div>
                                    <div class="col md-1" style="font-size: 12px;">Posts</div>
                                    <div class=" col md-1" style="font-size: 12px;">Bookmarks</div>
                                    <div class="col md-1" style="font-size: 12px;">Comments</div>
                                </div>
                                <div class="row">
                                    <div class="col"><?php echo $like3[0]['count_follower']; ?></div>
                                    <div class="col"><?php echo $like3[0]['count_posts']; ?></div>
                                    <div class="col"><?php echo $like3[0]['count_bookmark']; ?></div>
                                    <div class="col"><?php echo $like3[0]['count_comments']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h4>All Users</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Likes</th>
                            <th>Followers</th>
                            <th>Posts</th>
                            <th>Bookmarks</th>
                            <th>Commants</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
			// $users = queryGetData("Select id from users") ;
			// $getrank = queryGetData("SELECT rank FROM ranklikes WHERE user_id = $users[0]['id']") ;
			$userRankList = queryGetData("select user_id from rankLikes where rank not in(1,2,3)")
?>
                        <?php foreach($userRankList as $user ) : ?>
                        <?php 
                        
                        
    $rank = leaderboard($user["user_id"]);
	$id = $rank[0]['id'];
    $username = $rank[0]['username'];
    $foto = $rank[0]['foto'];
    $count_posts = $rank[0]['count_posts'];
    $count_likes = $rank[0]['count_likes'];
    $count_follower = $rank[0]['count_follower'];
    $count_bookmarks = $rank[0]['count_bookmark'];
	$count_comments = $rank[0]['count_comments'];
	$rank_likes = $rank[0]['rank_like'];
	$rank_posts  = $rank[0]['rank_posts'];
	$rank_follow  = $rank[0]['rank_follow'];
	$rank_bm  = $rank[0]['rank_bm'];
	$rank_cm  = $rank[0]['rank_cm'];
	if ($foto == "" || empty($foto) || $foto == null) {
        $tag = "<img class='circle-img circle-img--small mr-2' width='auto' src='../Foto/user.png'><span class=' font-weight-bold'>$foto</span>";
    } else {
        $tag = "<img class='circle-img circle-img--small mr-2' width='auto' height='auto'src='../Foto/$foto'>";
    }
	// 	test
	//echo $username, $foto, $count_posts, $count_likes, $count_follower, $count_comments, $count_bookmarks,$rank_likes,$rank_posts,$rank_follow,$rank_bm,$rank_cm; ;	
?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <?php echo $tag; ?>
                                    <div class="user-info__basic">
                                        <h5 class="mb-0"><?php echo $username; ?></h5>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-baseline">
                                    <h4 class="mr-5"><?php echo $count_likes; ?></h4>
                            <td>
                                <h4 class="mr-1"><?php echo $count_follower; ?></h4>
                            </td>
                            <td>
                                <h4 class="mr-5"><?php echo $count_posts; ?></h4>
                            </td>
                            <td>
                                <h4 class="mr-1"><?php echo $count_bookmarks; ?></h4>
                            </td>
                            <td>
                                <h4 class="mr-1"><?php echo $count_comments; ?></h4>
                            </td>
                            <td>
                                <button class="btn btn-success btn-sm">Follow</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php
?>
                    </tbody>
                </table>
            </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
    </script>

</body>

</html>