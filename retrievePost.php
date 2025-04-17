<?php
include("Constants.php");

$user = Constants::USER;
$password = Constants::PASSWORD;
$server = "localhost";
$database = "cmsc436s23_424class";

// Connect to MySQL
$mysqli = new mysqli($server, $user, $password, $database);
if ($mysqli->connect_error) {
    die("Error connecting: " . $mysqli->connect_error);
}

if (!isset($_POST['postId']) || !is_numeric($_POST['postId'])) {
    echo "INVALID POST ID";
    exit;
}

$post_id = intval($_POST['postId']);

$query = $mysqli->prepare("SELECT threadId FROM fli1234_POST WHERE id = ?");
$query->bind_param("i", $post_id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows === 0) {
    echo "INVALID POST ID";
    exit;
}

$row = $result->fetch_assoc();
$thread_id = $row['threadId'];
$query->close();

$sql = "SELECT * FROM fli1234_POST WHERE threadId = ? ORDER BY datePosted ASC, id ASC";
$query2 = $mysqli->prepare($sql);
$query2->bind_param("i", $thread_id);
$query2->execute();
$res = $query2->get_result();

$rowOfPosts = "";

if ($res) {
    while ($row = $res->fetch_assoc()) {
        $id = $row['id'];
        $body = $row['body'];
        $likes = $row['likes'];
        $email = $row['email'];
        $parentid = $row['parentId'] ?? "NULL";
        $datePosted = $row['datePosted'];
        $threadid = $row['threadId'] ?? "NULL";

        $post = "<tr>";
        $post .= "<td>$id</td>";
        $post .= "<td>$body</td>";
        $post .= "<td>$likes</td>";
        $post .= "<td>$email</td>";
        $post .= "<td>$parentid</td>";
        $post .= "<td>$datePosted</td>";
        $post .= "<td>$threadid</td>";
        $post .= "</tr>";

        $rowOfPosts .= $post;
    }
} else {
    echo "No results found or query failed.";
    exit;
}

$query2->close();

include("showRetrievedThread.html");
?>

