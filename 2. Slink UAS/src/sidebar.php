<?php
//mengambil judul category
$query = "SELECT DISTINCT * FROM posts";
$cats = queryGetData($query);

?>

<div class="col-md-4">

<!-- Blog Categories Well -->
<div class="well-lg mt-5 border p-5 shadow p-3 mb-5 bg-white rounded">
    <h4>Categories</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
                <?php 

                //link judul category
                foreach($cats as $cat){
                    echo "<li><a href='category.php?cat_title={$cat['post_cat']}'>#{$cat['post_cat']}</a></li>";
                }

                
                
                
                
                ?>
            </ul>
        </div>

    </div>
    <!-- /.row -->
</div>

</div>