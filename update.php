<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "crud_app";

$connection = new mysqli($servername, $username, $password, $database);

$title = "";
$artist = "";
$song_lyrics = "";


$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location:/crud_app/index.php");
        exit;
    };
    $id = $_GET["id"];

    $sql = "SELECT * FROM songs WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location:/crud_app/index.php");
        exit;
    }

    $title = $row["title"];
    $artist = $row["artist"];
    $song_lyrics = $row["song_lyrics"];
} else {
    $id = $_POST["id"];
    $title = $_POST["title"];
    $artist = $_POST["artist"];
    $song_lyrics = $_POST["song_lyrics"];


    do {
        if (empty($title) ||  empty($artist) ||  empty($song_lyrics)) {
            $errorMessage = "All the fields are Required";
            break;
        }

        $sql = "UPDATE songs" .
            "SET title = '$title', artist = '$artist', song_lyrics = '$song_lyrics'" .
            "WHERE id = $id";

        $result = $connection->query($sql);


        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Song updated succesfuly!";

        header("location: /crud_app/index.php");
    } while (false);
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container my-5">
        <h2>New Song</h2>

        <?php

        if (!empty($errorMessage)) {
            echo "
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
    <strong>$errorMessage</strong>
    <button type='button 'class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
    ";
        }
        ?>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $title ?>">
            <div class=" row mb-3">
                <label class="col-sm-3 col-form-label">Title</label>
                <div class="col-sm-6">
                    <input type="text" class="form=control" name="title" value="<?php echo $title ?>">
                </div>
            </div>
            <div class=" row mb-3">
                <label class="col-sm-3 col-form-label">Artist</label>
                <div class="col-sm-6">
                    <input type="text" class="form=control" name="artist" value="<?php echo $artist ?>">
                </div>
                <div class=" row mb-3">
                    <label class="col-sm-3 col-form-label">Song Lyrics</label>
                    <div class="col-sm-6">
                        <input type="text" class="form=control" name="song_lyrics" value="<?php echo $song_lyrics ?>">
                    </div>

                </div>

                <?php
                if (!empty($successMessage)) {
                    echo "
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
    <strong>$successMessage</strong>
    <button type='button 'class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
    ";
                }
                ?>

                <div class="row mb=3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="col-sm-3 d-grid">
                        <a class="btn btn-outline-primary" href="/crud_app/index.php" role="button">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>