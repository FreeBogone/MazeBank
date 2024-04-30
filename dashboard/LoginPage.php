<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            background-color: gray;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        .login-container {
            background-color: #fff;
            border-radius: 8px;
            border: solid;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            margin-top: 20px;
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
            font-family: 'Courier New', monospace;
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .button {
            font-family: 'Courier New', monospace;
            font-size: 16px; 
            display: inline-block;
            width: 300px;
            padding: 10px;
            background-color: #dc3545;
            border: solid;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            text-align: center; 
            transition: background-color 0.3s; 
        }
        .button:hover {
            background-color: darkred;
        }
        .button2 {
            font-family: 'Courier New', monospace;
            font-size: 16px; 
            display: inline-block;
            width: 275px;
            padding: 10px;
            background-color: #dc3545;
            border: solid;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            text-align: center; 
            transition: background-color 0.3s; 
        }
        .button2:hover {
            background-color: darkred;
        }
        .error-message {
            font-family: 'Courier New', monospace;
            color: red;
            text-align: center;
            margin-top: 10px;
        }
        .title-container {
            background-color: white; 
            padding: 20px; 
            border: solid;
            border-radius: 80px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
            margin-bottom: 20px; 
        }
        .title {
            font-family: 'Courier New', monospace;
            font-size: 32px; 
            color: black; 
            text-align: center; 
            margin: 0; 
        }

    </style>
</head>
<body>

<div class="title-container">
    <div class="title">
        <b>Welcome to Maze Bank!</b>
    </div>
</div>

<div class="login-container">
    <h2>Login</h2>
    <form method="post" action="LoginPage.php">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <input type="submit" value="Login" class="button">
        <a href="CreateAccount.php" class="button2">Create Account</a>
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
</div>
</body>
</html>
