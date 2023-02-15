<?php
// Create a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "directlending";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Build the SQL query to retrieve the data
$sql = "SELECT Customer.name, Customer.dob, Postcode.postcode, Postcode.state FROM Customer JOIN Postcode ON Customer.postcode_id = Postcode.id";

// Execute the query
$result = $conn->query($sql);

// Build an array to hold the results
$data = array();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
}

// Close the database connection
$conn->close();

// Convert the data to JSON and return it
echo json_encode($data);
?>
