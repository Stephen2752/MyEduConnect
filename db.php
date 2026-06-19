<?php

$conn = new mysqli(
    "localhost",
    "root",
    "",
    "myeduconnect"
);

if ($conn->connect_error) {
    die("Connection failed");
}
?>