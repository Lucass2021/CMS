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

                    <div class="col-xs-6">
                        <?php insert_categories(); ?>

                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="cat-title">Nome da Categoria:</label>
                                <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Adicionar Categoria">
                            </div>

                        </form>

                        <?php //UPDATE AND INCLUDE QUERY
                        if (isset($_GET['edit'])) {
                            $cat_id_edit = $_GET['edit'];
                            include("./includes/admin-update-categories.php");
                        }
                        ?>

                    </div>

                    <div class="col-xs-6">


                        <table class="table table-bordered table-hover">

                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome da Categoria</th>
                                </tr>
                            </thead>

                            <tbody>
                                <!-- //Select all categories query -->
                                <?php findAllCategories() ?>


                                <!-- //Delete query, using the href from the link above -->
                                <?php deleteCategories() ?>


                            </tbody>

                        </table>

                    </div>


                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include("./includes/admin-footer.php"); ?>