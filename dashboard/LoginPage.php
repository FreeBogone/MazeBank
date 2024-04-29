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
            <label for="email">Email:</label>
            <input type="text" id="email" name="email">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <input type="submit" value="Login">
        </form>

        <?php
              // Establish database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "Banking";
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            session_start();

            if(isset($_SESSION['user_id'])) {
                header("Location: HomePage.php");
                exit;
            }
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = $_POST['email'];
                $password = $_POST['password'];
            
                $sql = "SELECT id, email, password FROM Users WHERE email='$email'";
                $result = $conn->query($sql);
                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    if ($password === $row['password']) { // Direct comparison
                        $_SESSION['user_id'] = $row['id'];
                        echo $_SESSION['user_id'];
                        header("Location: HomePage.php");
                        exit;
                    }
                }
                
                echo "<p class='error-message'>Invalid email or password. Please try again.</p>";
            }
        ?>
        <div style="text-align: center; margin-top: 10px;">
            <a href="CreateAccount.php" style="text-decoration: none; color: #007bff;">Create Account</a>
        </div>
    </div>
</body>
</html>