<?php

include("Constants.php");

$user = Constants::USER;
$password = Constants::PASSWORD;

$db = "cmsc436s23_424class";
$server = "localhost";

// connect to the database
$mysqli = new mysqli($server, $user, $password, $db);

// check for connection errors
if ($mysqli->connect_error)
   echo "Error connecting<br/>"; 

if ($mysqli->query("UPDATE fli1234_POST SET threadId = NULL")) {
    echo "Successful";
} else {
    echo "Error";
}

$result = $mysqli->query("SELECT * FROM fli1234_POST");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Updated POST Table with Null Values</title>
    <style>
        th, td {
            border: 1px solid #333;
        }
    </style>
</head>
<body>

<h2>POST Table with Null Values</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Body</th>
        <th>Likes</th>
        <th>Email</th>
        <th>Parent ID</th>
        <th>Date Posted</th>
        <th>Thread ID</th>
    </tr>

    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['body']}</td>
                    <td>{$row['likes']}</td>
                    <td>{$row['email']}</td>
                    <td>" . ($row['parentId'] ?? 'NULL') . "</td>
                    <td>{$row['datePosted']}</td>
                    <td>" . ($row['threadId'] ?? 'NULL') . "</td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>Data not found</td></tr>";
    }

    $mysqli->close();
    ?>
</table>

</body>
</html>
