<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Submission</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Submission</h2>

    <?php
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'formsub');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM users WHERE id='$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "No record found";
        }
    }

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $country = $_POST['country'];
        $gender = $_POST['gender'];
        $languages = implode(',', $_POST['languages']);

        $sql = "UPDATE users SET name='$name', email='$email', password='$password', country='$country', gender='$gender', languages='$languages' WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }

        header("Location: submit.php");
    }

    $conn->close();
    ?>

    <form action="edit.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" value="<?php echo $row['password']; ?>" required>
        </div>
        <div class="form-group">
            <label for="confirm-password">Confirm Password:</label>
            <input type="password" class="form-control" id="confirm-password" name="confirm-password" value="<?php echo $row['password']; ?>" required>
        </div>
        <div class="form-group">
            <label for="country">Country:</label>
            <select class="form-control" id="country" name="country" required>
                <option value="" disabled>Select your country</option>
                <option value="India" <?php echo ($row['country'] == 'India') ? 'selected' : ''; ?>>India</option>
                <option value="USA" <?php echo ($row['country'] == 'USA') ? 'selected' : ''; ?>>USA</option>
                <option value="UK" <?php echo ($row['country'] == 'UK') ? 'selected' : ''; ?>>UK</option>
            </select>
        </div>
        <div class="form-group">
            <label>Gender:</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php echo ($row['gender'] == 'male') ? 'checked' : ''; ?> required>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php echo ($row['gender'] == 'female') ? 'checked' : ''; ?> required>
                    <label class="form-check-label" for="female">Female</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Language:</label>
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="hindi" name="languages[]" value="Hindi" <?php echo (strpos($row['languages'], 'Hindi') !== false) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="hindi">Hindi</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gujarati" name="languages[]" value="Gujarati" <?php echo (strpos($row['languages'], 'Gujarati') !== false) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="gujarati">Gujarati</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="english" name="languages[]" value="English" <?php echo (strpos($row['languages'], 'English') !== false) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="english">English</label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" name="update">Update</button>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
