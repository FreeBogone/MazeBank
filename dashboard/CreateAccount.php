<!DOCTYPE html>
<html>
<head>
    <title>Create Account</title>
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
        .return-button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #ccc;
            border: none;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            margin-top: 15px;
        }
        .return-button:hover {
            background-color: #999;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Create Account</h2>
        <form method="post" action="CreateAccount.php">
            <label for="new_username">New Username:</label>
            <input type="text" id="new_username" name="new_username">
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password">
            <input type="submit" value="Create Account">
        </form>
        <?php
        // PHP code here
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $newUsername = $_POST['new_username'];
            $newPassword = $_POST['new_password'];
            
            // Check if username already exists
            $users = file("users.txt", FILE_IGNORE_NEW_LINES);
            foreach ($users as $user) {
                list($storedUsername, $storedPassword) = explode(':', $user);
                if ($newUsername == $storedUsername) {
                    echo "<p class='error-message'>Username already exists. Please choose a different one.</p>";
                    exit;
                }
            }
            
            // Add new username and password to users.txt
            $file = fopen("users.txt", "a");
            fwrite($file, $newUsername . ":" . $newPassword . PHP_EOL);
            fclose($file);
            
            echo "<p style='color:green'>Account created successfully!</p>";
        }
        ?>
        <a href="LoginPage.php" class="return-button">Return to Login Page</a>
    </div>
</body>
</html>
