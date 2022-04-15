<?php

if (isset($_POST['checkBoxArray'])) {

    foreach ($_POST['checkBoxArray'] as $postValueId) {
        $bulk_options = $_POST['bulk_options'];


        switch ($bulk_options) {
            case "published":
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
                $update_to_published_status = mysqli_query($connection, $query);
                confirmQuery($update_to_published_status);
                break;
            case "draft":
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
                $update_to_draft_status = mysqli_query($connection, $query);
                confirmQuery($update_to_draft_status);
                break;
            case "delete":
                $query = "DELETE FROM posts WHERE post_id = {$postValueId} ";
                $delete_status = mysqli_query($connection, $query);
                confirmQuery($delete_status);
                break;
            case "clone":
                $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' ";
                $select_post_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_array($select_post_query)) {
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_date = $row['post_date'];
                    $post_author = $row['post_author'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_content = $row['post_content'];
                }

                $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
                $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";
                $copy_query = mysqli_query($connection, $query);

                if (!$copy_query) {
                    die("Query falhou" . mysqli_error($connection));
                }


                break;
        }
    }
}

?>
<form action="" method="POST">
    <table class="table table-bordered table-hover">


        <div id="bulkOptionsContainer" class="col-xs-4">
            <select class="form-control" name="bulk_options" id="">
                <option value="draft">Opções</option>
                <option value="published">Publicar</option>
                <option value="draft">Rascunho</option>
                <option value="delete">Excluir</option>
                <option value="clone">Duplicar</option>
            </select>
        </div>

        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Aplicar">
            <a href="posts.php?source=add-post" class="btn btn-primary">Adicionar novo</a>
        </div>

        <thead>
            <tr>
                <th><input type="checkbox" name="" id="selectAllBoxes"></th>
                <th>Id</th>
                <th>Autor</th>
                <th>Título</th>
                <th>Categoria</th>
                <th>Status</th>
                <th>Imagem</th>
                <th>Tags</th>
                <th>Comentários</th>
                <th>Data</th>
                <th>Visualizar</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $query = "SELECT * FROM posts ORDER BY post_id DESC";
            $selectPosts = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($selectPosts)) {
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_date = $row['post_date'];
                $post_views_count = $row['post_views_count'];

                echo "<tr>";
            ?>
                <td><input type='checkbox' name='checkBoxArray[]' class='checkBoxes' value='<?php echo $post_id; ?>'></td>;
            <?php

                echo "<td>$post_id</td>";
                echo "<td>$post_author</td>";
                echo "<td>$post_title</td>";


                $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                $editQuery = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($editQuery)) {
                    $cat_id = $row["cat_id"];
                    $cat_title = $row["cat_title"];

                    echo "<td>{$cat_title}</td>";
                }

                echo "<td>$post_status</td>";
                echo "<td><img width='100' src='../images/$post_image' alt='$post_image'></td>";
                echo "<td>$post_tags</td>";


                $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                $send_comment_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_array($send_comment_query)) {

                    $comment_id = $row['comment_id'];
                }
                global $comment_id;
                $count_comments = mysqli_num_rows($send_comment_query);

                echo "<td><a href='post_comment.php?id=$post_id'>$count_comments</a></td>";

                echo "<td>$post_date</td>";
                echo "<td><a href='../post.php?p_id={$post_id}'>Ver publicação</a></td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Editar</a></td>";
                echo "<td><a onClick=\"javascript: return confirm('Você tem certeza que quer apagar?'); \" href='posts.php?delete={$post_id}'>Excluir</a></td>";
                echo "<td> <a href='posts.php?reset={$post_id}'>$post_views_count</a></td>";
                echo "</tr>";
            }

            ?>


        </tbody>

    </table>
</form>

<?php

if (isset($_GET['delete'])) {
    $the_post_id = $_GET['delete'];

    $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";

    $deleteQuery = mysqli_query($connection, $query);
    header("Location:posts.php");
}

if (isset($_GET['reset'])) {
    $the_post_id = $_GET['reset'];

    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($connection, $_GET['reset']) . " ";

    $resetQuery = mysqli_query($connection, $query);
    header("Location:posts.php");
}

?>