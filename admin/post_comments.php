


<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Autor</th>
            <th>Comentários</th>
            <th>Email</th>
            <th>Status</th>
            <th>Em resposta a</th>
            <th>Data</th>
            <th>Aprovado</th>
            <th>Rejeitado</th>
            <th>Excluir</th>
        </tr>
    </thead>
    <tbody>
        <?php

        $query = "SELECT * FROM comments WHERE comment_post_id = " . mysqli_real_escape_string($_GET['id']) . " ";
        $select_comments = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_comments)) {
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_content = $row['comment_content'];
            $comment_email = $row['comment_email'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];


            echo "<tr>";
            echo "<td>$comment_id</td>";
            echo "<td>$comment_author</td>";
            echo "<td>$comment_content</td>";


            // $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
            // $editQuery = mysqli_query($connection, $query);

            // while ($row = mysqli_fetch_assoc($editQuery)) {
            //     $cat_id = $row["cat_id"];
            //     $cat_title = $row["cat_title"];

            //     echo "<td>{$cat_title}</td>";
            // }

            echo "<td>$comment_email</td>";
            echo "<td>$comment_status</td>";

            $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
            $select_post_id_query = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_post_id_query)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
            }


            echo "<td>$comment_date</td>";
            echo "<td><a href='comments.php?approve=$comment_id'>Aprovar</a></td>";
            echo "<td><a href='comments.php?unapprove=$comment_id'>Rejeitar</a></td>";
            echo "<td><a onClick=\"javascript: return confirm('Você tem certeza que quer apagar?'); \" href='comments.php?delete=$comment_id'>Excluir</a></td>";
            echo "</tr>";
        }

        ?>
    </tbody>

</table>

<?php

if (isset($_GET['approve'])) {
    $the_comment_id = $_GET['approve'];

    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id";

    $approve_comment_query = mysqli_query($connection, $query);
    header("Location:comments.php");
}

if (isset($_GET['unapprove'])) {
    $the_comment_id = $_GET['unapprove'];

    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id";

    $unapprove_comment_query = mysqli_query($connection, $query);
    header("Location:comments.php");
}



if (isset($_GET['delete'])) {
    $the_comment_id = $_GET['delete'];

    $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";

    $deleteQuery = mysqli_query($connection, $query);
    header("Location:comments.php");
}

?>