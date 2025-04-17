<?php

include("Constants.php");
$user = Constants::USER;
$password = Constants::PASSWORD;
$server = "localhost";
$database = "cmsc436s23_424class";

$mysqli = new mysqli($server, $user, $password, $database);

if($mysqli->connect_error)
	echo "Error connecting\n";

$updates = [
    "UPDATE fli1234_POST SET threadId = 1 WHERE id = 1", 
    "UPDATE fli1234_POST SET threadId = 2 WHERE id = 2",
    "UPDATE fli1234_POST SET threadId = 3 WHERE id = 3",
    "UPDATE fli1234_POST SET threadId = 4 WHERE id = 4",

    "UPDATE fli1234_POST SET threadId = 4 WHERE id = 5",

    "UPDATE fli1234_POST SET threadId = 6 WHERE id = 6",
    "UPDATE fli1234_POST SET threadId = 6 WHERE id = 7",
    "UPDATE fli1234_POST SET threadId = 6 WHERE id = 8",
    "UPDATE fli1234_POST SET threadId = 6 WHERE id = 9",
    "UPDATE fli1234_POST SET threadId = 6 WHERE id = 10",
    "UPDATE fli1234_POST SET threadId = 6 WHERE id = 11"
];

echo "Feileen Li and Dinelka Jagoda<br/>";

foreach($updates as $update) {
	if($mysqli->query($update)) {
		echo "success: $update<br/>";
	} else {
		echo "error: $update<br/>";
	}
}


echo "done\n";

?>
