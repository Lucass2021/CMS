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

                        <small>Author</small>
                    </h1>

                    <?php

                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    } else {
                        $source = '';
                    }

                    switch ($source) {
                        case 'add-post';
                            include("./includes/add-post.php");
                            break;

                        case 'edit_post';
                            include("./includes/edit_post.php");
                            break;

                        default:
                            include("./includes/view-all-comments.php");
                            break;
                    };


                    ?>:


                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include("./includes/admin-footer.php"); ?>