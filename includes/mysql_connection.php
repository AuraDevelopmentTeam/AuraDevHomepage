<?php

//load sql settings
include_once "settings.php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection, else quit
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
