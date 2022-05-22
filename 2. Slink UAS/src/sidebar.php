<?php
//mengambil judul category
$query = "SELECT * FROM category";
$category = queryGetData($query);

?>

<div class="col-md-4">

    <!-- Blog Categories Well -->
    <div class="well-lg mt-5 border p-5 shadow p-3 mb-5 bg-white rounded w-75">
        <h4>Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php foreach ($category as $cat) : ?>
                        <form action="home.php" method="POST">
                            <input type="hidden" name="cat_id" value="<?= $cat['id'] ?>">
                            <button type="submit" name="submit_category" class="btn btn-outline-primary mb-2"><?= $cat['nama']; ?></button>
                        </form>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>
        <!-- /.row -->
    </div>

</div>