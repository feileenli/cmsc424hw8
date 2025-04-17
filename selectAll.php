<?php
include("Constants.php");
$user = Constants::USER;
$password = Constants::PASSWORD;
$server = "localhost";
$database = "cmsc436s23_424class";

$mysqli = new mysqli($server, $user, $password, $database);

if($mysqli->connect_error)
	echo "Error connecting\n";

$sql = "select * from fli1234_USER";
$sql2 = "select * from fli1234_POST";

//build table
$rowOfUsers = "";
$rowOfPosts = "";

$result = $mysqli->query($sql);

if ($result) {
	while ($row = $result->fetch_assoc()) {
		$email = $row['email'];
		$age = $row['age'];
		$state = $row['state'];
		
		$user = "<tr>";
		$user .= "<td>$email</td>";
		$user .= "<td>$age</td>";
		$user .= "<td>$state</td>";
		$user .= "</tr>";

		$rowOfUsers .= $user;
	}
	
} else {
	echo "No results found or query failed.\n";
}

$result = $mysqli->query($sql2);

if ($result) {
        while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $body = $row['body'];
                $likes = $row['likes'];
		$email = $row['email'];
		$datePosted = $row['datePosted'];
		$parentid = $row['parentId'] ?? "NULL";
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
        echo "No results found or query failed.\n";
}

include("selectAll.html");
?>
