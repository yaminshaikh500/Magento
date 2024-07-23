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

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Fetch user data from the database
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found";
        exit;
    }

    $stmt->close();
} else {
    echo "Invalid user ID";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="style.css">
    <script src="validate.js"></script>
</head>
<body>
    <h1>Edit User</h1>
    <form id="editForm" action="update_user.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>">
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </div>
        <div>
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password">
        </div>
        <div>
            <label for="country">Country</label>
            <select id="country" name="country">
                <option value="">Select Country</option>
                <option value="USA" <?php if ($user['country'] === 'USA') echo 'selected'; ?>>USA</option>
                <option value="UK" <?php if ($user['country'] === 'UK') echo 'selected'; ?>>UK</option>
                <option value="Canada" <?php if ($user['country'] === 'Canada') echo 'selected'; ?>>Canada</option>
                <option value="Australia" <?php if ($user['country'] === 'Australia') echo 'selected'; ?>>Australia</option>
            </select>
        </div>
        <div>
            <label>Gender</label>
            <input type="radio" id="male" name="gender" value="male" <?php if ($user['gender'] === 'male') echo 'checked'; ?>>
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female" <?php if ($user['gender'] === 'female') echo 'checked'; ?>>
            <label for="female">Female</label>
        </div>
        <div>
            <label>Languages</label>
            <input type="checkbox" id="english" name="languages[]" value="English" <?php if (strpos($user['languages'], 'English') !== false) echo 'checked'; ?>>
            <label for="english">English</label>
            <input type="checkbox" id="spanish" name="languages[]" value="Spanish" <?php if (strpos($user['languages'], 'Spanish') !== false) echo 'checked'; ?>>
            <label for="spanish">Spanish</label>
            <input type="checkbox" id="french" name="languages[]" value="French" <?php if (strpos($user['languages'], 'French') !== false) echo 'checked'; ?>>
            <label for="french">French</label>
        </div>
        <div>
            <button type="submit">Update</button>
        </div>
    </form>
</body>
</html>
