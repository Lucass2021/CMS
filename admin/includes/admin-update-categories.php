<!-- //Código diferente do edwin -->
<form action="" method="POST">
    <div class="form-group">
        <label for="cat-title">Editar Categoria:</label>

        <?php

        //Edit query
        if (isset($_GET['edit'])) {
            $cat_id_edit = $_GET['edit'];



            $query = "SELECT * FROM categories WHERE cat_id = $cat_id_edit";
            $editQuery = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($editQuery)) {
                $cat_id = $row["cat_id"];
                $cat_title = $row["cat_title"];
        ?>

                <input value="<?php if (isset($cat_title)) {
                                    echo $cat_title;
                                } ?>" class="form-control" type="text" name="cat_title">

        <?php }
        } ?>

        <?php


        //Update category query
        if (isset($_POST['update'])) {
            $cat_id_edit = $_POST['cat_title'];

            $query = "UPDATE categories SET cat_title = '{$cat_id_edit}' WHERE cat_id = {$cat_id}";
            $updateQuery = mysqli_query($connection, $query);
            if (!$updateQuery) {
                die("Erro na edição" . mysqli_error($connection));
            }
        }


        ?>






    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update" value="Editar Categoria">
    </div>

</form>