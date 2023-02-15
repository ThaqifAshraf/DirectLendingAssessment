<?php

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "directlending";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the values from the form
$name = $_POST["name"];
$dob = $_POST["dob"];
$address = $_POST["address"];
$postcode = $_POST["postcode"];

// Determine the state based on the postcode
if ($postcode == "35000") {
  $state = "Perak";
} else if ($postcode == "50000") {
  $state = "Kuala Lumpur";
} else if ($postcode == "80000") {
  $state = "Johor";
} else {
  $state = "";
}

// Insert the postcode into the Postcode table if it doesn't already exist
$sql = "SELECT id FROM postcode WHERE postcode = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $postcode);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $postcode_id = $row["id"];
} else {
  $sql = "INSERT INTO postcode (state, postcode) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $state, $postcode);
  $stmt->execute();
  $postcode_id = $stmt->insert_id;
  $stmt->close();
}

// Insert the new record into the Customer table
$sql = "INSERT INTO customer (name, dob, address, postcode_id) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $name, $dob, $address, $postcode_id);
$stmt->execute();
$stmt->close();

// Close the database connection
$conn->close();

// Redirect the user back to main.html
header('Location: /DirectLending/main.html');
exit();

?>
