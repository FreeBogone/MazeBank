<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
        }
        h2 {
            margin-top: 0;
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="post" action="LoginPage.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <input type="submit" value="Login">
        </form>
        <?php
        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve username and password from form
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Read users.txt file
            $users = file("users.txt", FILE_IGNORE_NEW_LINES);

            // Check if username and password match
            foreach ($users as $user) {
                list($storedUsername, $storedPassword) = explode(':', $user);
                if ($username == $storedUsername && $password == $storedPassword) {
                    // Redirect to HomePage.php if credentials are correct
                    header("Location: HomePage.php");
                    exit;
                }
            }
            // Display error message if credentials are incorrect
            echo "<p class='error-message'>Invalid username or password. Please try again.</p>";
        }
        ?>
            <div style="text-align: center; margin-top: 10px;">
            <a href="CreateAccount.php" style="text-decoration: none; color: #007bff;">Create Account</a>
        </div>
    </div>
</body>
</html>
