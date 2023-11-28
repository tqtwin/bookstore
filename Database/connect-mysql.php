<?php
$servername = "localhost";
$username = "root";
$password = "";
$databasename ="Webbookstore";
// create connection
$conn = new mysqli($servername, $username, $password, $databasename);
// check dbection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$conn ->set_charset("utf8");
?>