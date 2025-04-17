<?php

include("Constants.php");
$user  = Constants::USER;
$password = Constants::PASSWORD;
$db = "cmsc436s23_424class";
$server = "localhost";

// connect to the database
$mysqli = new mysqli($server, $user, $password, $db);

// check for connection errors
if ($mysqli->connect_error)
   echo "Error connecting<br/>"; 

$bodyInput = $_POST['body'];
$emailInput = $_POST['email'];
$parentIDInput = $_POST['parentId'];

$body = validateInputString($mysqli, $bodyInput);
$email = validateInputString($mysqli, $emailInput);
$parentId = filter_var($parentIDInput, FILTER_VALIDATE_INT);

function validateInputString($mysqli, $s) {
    return $mysqli->real_escape_string($s);
}

if (!$body || !$email || !$parentId) {
    echo "Invalid input.";
    exit;
}

$checkSqlStatement = $mysqli->prepare("SELECT threadId FROM fli1234_POST WHERE id = ?");
$checkSqlStatement->bind_param("i", $parentId);
$checkSqlStatement->execute();
$checkResult = $checkSqlStatement->get_result();

if ($checkResult->num_rows === 0) {
    echo "INVALID PARENT ID";
    $checkSqlStatement->close();
    $mysqli->close();
    exit;
}

$row = $checkResult->fetch_assoc();
$threadId = $row['threadId'] ?? $parentId;
$checkSqlStatement->close();

$insertSqlStatement = $mysqli->prepare("INSERT INTO fli1234_POST (body, email, parentId, threadId) VALUES (?, ?, ?, ?)");
$insertSqlStatement->bind_param("ssii", $body, $email, $parentId, $threadId);

if ($insertSqlStatement->execute()) {
    echo "Successfull";
} else {
    echo "Error";
}

$insertSqlStatement->close();
$mysqli->close();

?>
