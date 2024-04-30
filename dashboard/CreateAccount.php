<!DOCTYPE html>
<html>
<head>
    <title>Create Account</title>
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
    <div class="login-container">
        <h2>Create Account</h2>
        <form method="post" action="CreateAccount.php">
            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname" required>
            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" required>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
            <label for="new_password">Password:</label>
            <input type="password" id="new_password" name="new_password" required>
            <input type="submit" value="Create Account" class="button">
        <a href="LoginPage.php" class="button2">Return to Login Page</a>
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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $password = $_POST['new_password'];
        
            $sql = "INSERT INTO Users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $firstname, $lastname, $email, $password);
            if ($stmt->execute()) {
                echo "<p style='color:green'>Account created successfully!</p>";
            } else {
                echo "<p class='error-message'>Error creating account: " . $conn->error . "</p>";
            }
            $stmt->close();
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
