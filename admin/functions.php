<?php

function confirmQuery($result)
{
    global $connection;
    if (!$result) {
        die("Query falhou " . mysqli_error($connection));
    };
}



function insert_categories()
{

    if (isset($_POST['submit'])) {
        global $connection;
        $cat_title = $_POST['cat_title'];


        if ($cat_title == "" || empty($cat_title)) {
            echo "Preencha um valor válido";
        } else {
            $query = "INSERT INTO categories (cat_title) VALUES ('{$cat_title}')";
            $createCategoryQuery = mysqli_query($connection, $query);
            echo "Categoria adicionada";


            if (!$createCategoryQuery) {
                die("Ocorreu um erro" . mysqli_error($connection));
            }
        }
    }
}

function findAllCategories()
{

    global $connection;
    $query = "SELECT * FROM categories";
    $selectCategories = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($selectCategories)) {
        $cat_id = $row["cat_id"];
        $cat_title = $row["cat_title"];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Editar</a></td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Excluir</a></td>";
        echo "</tr>";
    }
}


function deleteCategories()
{
    global $connection;
    if (isset($_GET['delete'])) {
        $cat_id_delete = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = {$cat_id_delete}";
        $deleteQuery = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}

function users_online()
{
    if (isset($_GET['onlineusers'])) {

        global $connection;

        if (!$connection) {
            session_start();
            include("../includes/db.php");


            $session = session_id();
            $time = time();
            $time_out_in_seconds = 05;
            $time_out = $time - $time_out_in_seconds;

            $query = "SELECT * FROM users_online WHERE session = '$session'";
            $send_query = mysqli_query($connection, $query);
            $count = mysqli_num_rows($send_query);

            if ($count == NULL) {
                mysqli_query($connection, "INSERT INTO users_online(session,time) VALUES ('$session', '$time')");
            } else {
                mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
            }

            $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
            echo $count_user = mysqli_num_rows($users_online_query);
        }
    } //get request onlineusers
}
users_online();
