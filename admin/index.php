<?php include("./includes/admin-header.php"); ?>

<div id="wrapper">


    <!-- Navigation -->
    <?php include("./includes/admin-navigation.php"); ?>

    <div id="page-wrapper">

        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->


            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <?php
                                    $query = "SELECT * FROM posts";
                                    $select_all_posts = mysqli_query($connection, $query);
                                    $post_counts = mysqli_num_rows($select_all_posts);
                                    ?>
                                    <div class='huge'><?php echo $post_counts; ?></div>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">Ver mais</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM comments";
                                    $select_all_comments = mysqli_query($connection, $query);
                                    $comments_counts = mysqli_num_rows($select_all_comments);
                                    ?>
                                    <div class='huge'><?php echo $comments_counts; ?></div>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">Ver mais</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM users";
                                    $select_all_users = mysqli_query($connection, $query);
                                    $users_counts = mysqli_num_rows($select_all_users);
                                    ?>
                                    <div class='huge'><?php echo $users_counts; ?></div>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">Ver mais</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM categories";
                                    $select_all_categories = mysqli_query($connection, $query);
                                    $categories_counts = mysqli_num_rows($select_all_categories);
                                    ?>
                                    <div class='huge'><?php echo $categories_counts; ?></div>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">Ver mais</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <?php
            $query = "SELECT * FROM posts WHERE post_status = 'draft'";
            $select_all_draft_posts = mysqli_query($connection, $query);
            $post_draft_counts = mysqli_num_rows($select_all_draft_posts);


            $query = "SELECT * FROM posts WHERE post_status = 'published'";
            $select_all_published_posts = mysqli_query($connection, $query);
            $post_published_counts = mysqli_num_rows($select_all_published_posts);


            $query = "SELECT * FROM posts WHERE post_status = 'draft'";
            $select_all_draft_posts = mysqli_query($connection, $query);
            $post_draft_counts = mysqli_num_rows($select_all_draft_posts);



            $query = "SELECT * FROM comments WHERE comment_status = 'unapprove'";
            $unapproved_comments_query = mysqli_query($connection, $query);
            $unapproved_comment_counts = mysqli_num_rows($unapproved_comments_query);




            $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
            $select_all_subscribers = mysqli_query($connection, $query);
            $subscriber_count = mysqli_num_rows($select_all_subscribers);

            ?>


            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Dados', 'Quantidade', ],
                            <?php

                            $element_text = ['Todas publica????es', 'Publica????es Aprovadas', "Publica????es Rascunho", 'Coment??rios', 'Coment??rios pendentes', 'Usu??rios', 'Usu??rios Subscribers', 'Categorias'];
                            $element_count = [$post_counts, $post_published_counts, $post_draft_counts, $comments_counts, $subscriber_count, $users_counts, $subscriber_count, $categories_counts];

                            for ($i = 0; $i < 8; $i++) {
                                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                            }
                            ?>

                            // ['Posts', 1000, ],
                        ]);

                        var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>

                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>


            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include("./includes/admin-footer.php"); ?>