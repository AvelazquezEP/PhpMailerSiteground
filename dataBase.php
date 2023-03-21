<?php

// MYSQL
$servername = "ericp138.sg-host.com";
$username = "uuylktjrpsdaq";
$password = "dzxuue8lb5ry";
$dbname = "dbsjgfvhymgezw";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
 if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// $conn->close();