<?php
$servername = "localhost";
$username = "root";
$password = "toor1";
$dbname = "task";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$userId = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$country = $_POST['country'];
$gender = $_POST['gender'];
$languages = implode(', ', $_POST['languages']);


// Update data in the database
if (!empty($password)) {
    // Hash the new password if provided
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET name = ?, email = ?, password = ?, country = ?, gender = ?, languages = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $name, $email, $hashedPassword, $country, $gender, $languages, $userId);
} else {
    // Update without changing the password
    $sql = "UPDATE users SET name = ?, email = ?, country = ?, gender = ?, languages = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $name, $email, $country, $gender, $languages, $userId);
}

if ($stmt->execute()) {
    echo "User updated successfully!";
} else {
    echo "Error updating user: " . $conn->error;
}

$stmt->close();
$conn->close();

header("Location: user_list.php");
exit;
?>
