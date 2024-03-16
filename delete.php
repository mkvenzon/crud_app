<?php


if (isset($_GET["id"])) {
    $id = $_GET["id"];


    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "crud_app";

    $connection = new mysqli($servername, $username, $password, $database);


    $sql = "DELETE FROM songs WHERE id=$id";
    $connection->query($sql);
}

header("location: /crud_app/index.php");
exit;
