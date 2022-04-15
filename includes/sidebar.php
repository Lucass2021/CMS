<div class="col-md-4">



    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="../search.php" method="POST">
            <div class="input-group">
                <input type="text" name="search" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div> <!-- /.input-group -->
        </form>
    </div>

    <!-- Login-->
    <div class="well">
        <h4>Login</h4>
        <form action="includes/login.php" method="POST">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Nome do usuário">
            </div> <!-- /.input-group -->
            <div class="input-group">
                <input type="password" name="password" class="form-control" placeholder="Senha do usuário">
                <span class="input-group-btn">
                    <button class="btn btn-primary" name="login" type="submit">
                        Enviar
                    </button>
                </span>


            </div> <!-- /.input-group -->
        </form>
    </div>

    <!-- Blog Categories Well -->
    <div class="well">

        <?php

        $query = "SELECT * FROM categories";
        $selectCategoriesSidebarQuery = mysqli_query($connection, $query);
        ?>

        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">

                    <?php
                    while ($row = mysqli_fetch_assoc($selectCategoriesSidebarQuery)) {
                        $cat_title = $row["cat_title"];
                        $cat_id = $row["cat_id"];

                        echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                    }
                    ?>

                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include("./includes/widget.php"); ?>

</div>