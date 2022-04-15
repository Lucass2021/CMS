<!-- Database -->
<?php include("./includes/db.php"); ?>

<!-- Header -->
<?php include("./includes/header.php"); ?>

<!-- Navegation -->
<?php include("./includes/navegation.php"); ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php


            // Search bar
            if (isset($_REQUEST["submit"])) {
                $search =  $_REQUEST["search"];


                $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
                $searchTagQuery = mysqli_query($connection, $query);

                if (!$searchTagQuery) {
                    die("Query falhou" . mysqli_error($connection));
                }

                $count = mysqli_num_rows($searchTagQuery);

                if ($count == 0) {
                    echo "<h1>SEM RESULTADO</h1>";
                    // Search bar end
                } else {
                    //Create post internal loop

                    while ($row = mysqli_fetch_assoc($searchTagQuery)) {
                        $post_title = $row["post_title"];
                        $post_author = $row["post_author"];
                        $post_date = $row["post_date"];
                        $post_image = $row["post_image"];
                        $post_content = $row["post_content"];

            ?>
                        <!-- Terminando o PHP para adicionar as tags acima no conteúdo abaixo -->

                        <h1 class="page-header">
                            Page Heading
                            <small>Secondary Text</small>
                        </h1>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo " $post_date"; ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                        <hr>
                        <p><?php echo $post_content; ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>


            <?php }
                }
            } ?>






        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include("./includes/sidebar.php"); ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include("./includes/footer.php"); ?>