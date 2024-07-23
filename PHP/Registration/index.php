<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
    <script src="validate.js" defer></script>
</head>
<body>
    <h1>User Registration</h1>
    <form id="registrationForm" action="save_user.php" method="POST">
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name">
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
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
                <option value="USA">USA</option>
                <option value="UK">UK</option>
                <option value="Canada">Canada</option>
                <option value="Australia">Australia</option>
            </select>
        </div>
        <div>
            <label>Gender</label>
            <input type="radio" id="male" name="gender" value="male">
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female">
            <label for="female">Female</label>
        </div>
        <div>
            <label>Languages</label>
            <input type="checkbox" id="english" name="languages[]" value="English">
            <label for="english">English</label>
            <input type="checkbox" id="spanish" name="languages[]" value="Spanish">
            <label for="spanish">Spanish</label>
            <input type="checkbox" id="french" name="languages[]" value="French">
            <label for="french">French</label>
        </div>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
</body>
</html>
