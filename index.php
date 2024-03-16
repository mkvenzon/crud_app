<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD APPLICATIOn</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container my-5">
        <h2>List of Data</h2>
        <a class="btn btn-primary" href="/crud_app/create.php" role="button">New Song</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>TITLE</th>
                    <th>ARTIST</th>
                    <th>LYRICS</th>
                    <th>DATE CREATED</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "crud_app";

                $connection = new mysqli($servername, $username, $password, $database);

                if ($connection->connect_error) {
                    die("Connection Failed: " . $connection->connect_error);
                }

                $sql = "SELECT * FROM songs";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query: " . $connection->connect_error);
                }

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>$row[id]</td>
                    <td>$row[title]</td>
                    <td>$row[artist]</td>
                    <td>$row[song_lyrics]</td>
                    <td>$row[date_created]</td>
                    <td>
                    <a class='btn btn-primary btn-sm' href='/crud_app/update.php?id=$row[id]'>UPDATE</a>
                    <a class='btn btn-danger btn-sm' href='/crud_app/delete.php?id=$row[id]'>DELETE</a>
                    </td>
                </tr>
                ";
                }
                ?>

            </tbody>
        </table>

    </div>
</body>

</html>