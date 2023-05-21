<?php
// Retrieve form data
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$gender = $_POST['gender'];

// Validate form data
$errors = array();

if (empty($fullname)) {
  $errors[] = "Full name is required.";
}

if (empty($email)) {
  $errors[] = "Email address is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors[] = "Invalid email address.";
}

if (empty($gender)) {
  $errors[] = "Gender is required.";
}

// If there are errors, display them and stop further processing
if (!empty($errors)) {
  foreach ($errors as $error) {
    echo $error . "<br>";
  }
  exit();
}

// Connect to the database
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Insert data into the "students" table
$sql = "INSERT INTO students (full_name, email, gender) VALUES ('$fullname', '$email', '$gender')";

if ($conn->query($sql) === TRUE) {
  echo "Registration successful!";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>