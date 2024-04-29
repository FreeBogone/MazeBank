<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Deposit or Withdraw</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/dashboard/HomePage.php">Maze Bank</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/HomePage.php">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/dashboard/TransactionPage.html">Make a Transaction</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/HistoryPage.php">Transaction History <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>

    

    <form id="balanceForm">
        <!-- Input field for user ID -->
        <label for="user_id">Enter PIN:</label><br>
        <input class ="form-control" type="number" id="user_id" name="user_id" min="1" required><br><br>
        <!-- Input fields for transaction type and amount -->
        <label for="transaction_type">Select Transaction Type:</label><br>
        <select  class="form-control" id="transaction_type" name="transaction_type">
            <option value="deposit">Deposit</option>
            <option value="withdraw">Withdraw</option>
            <option value="transfer">Transfer</option>
        </select><br><br>
        <label for="account">Select Account:</label><br>
        <select class="form-control" id="account" name="account">
            <option value="checking">checking</option>
            <option value="savings">savings</option>
        </select><br><br>
        <label for="amount">Enter Amount:</label><br>
        <input class ="form-control" type="number" id="amount" name="amount" min="0" step="0.01" required><br><br>
        <button type="submit" class="btn btn-danger">Submit</button>
    </form>
    </div>

    <script>
        document.getElementById("balanceForm").addEventListener("submit", function(event) {
            
            // Get the transaction type, amount, and user ID entered by the user
            const transactionType = document.getElementById("transaction_type").value;
            const accountType = document.getElementById("account").value;
            const amount = parseFloat(document.getElementById("amount").value);
            const userId = parseInt(document.getElementById("user_id").value); // Parse as integer
            
            // Perform client-side validation
            if (isNaN(amount) || amount <= 0) {
                alert("Please enter a valid positive amount.");
                return;
            }
            
            // Send the transaction data to the server using AJAX
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "TransactionPage.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        alert(xhr.responseText);
                    } else {
                        alert("Error: " + xhr.status);
                    }
                }
            };
            // Send transaction type, amount, user ID,and account type to the server
            xhr.send("transaction_type=" + transactionType + "&amount=" + amount + "&user_id=" + userId + "&account=" + accountType);
        });

        
    </script>

<?php 
    session_start();
    $user_id = $_SESSION['user_id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "Banking";

    $conn = new mysqli($servername, $username, $password, $database);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $transactionType = $_POST['transaction_type'];
        $accountType = $_POST['account'];
        $amount = $_POST['amount'];
        $userId = $_POST['user_id']; // Retrieve user ID from the form
        $accountType = $_POST['account']; // Retrieve account type from the form

        
    
        // Update the balance in the database based on transaction type, account type, and user ID
        if ($transaction_type === 'deposit' && $accountType === 'checking') {
            $sql = "UPDATE Accounts SET checking_balance = checking_balance + ? WHERE user_id = ?";
        } elseif ($transaction_type === 'withdraw' && $accountType === 'checking') {
            $sql = "UPDATE Accounts SET checking_balance = checking_balance - ? WHERE user_id = ?";
        } elseif ($transaction_type === 'deposit' && $accountType === 'savings') {
            $sql = "UPDATE Accounts SET savings_balance = savings_balance + ? WHERE user_id = ?";
        } elseif ($transaction_type === 'withdraw' && $accountType === 'savings') {
            $sql = "UPDATE Accounts SET savings_balance = savings_balance - ? WHERE user_id = ?";
        } else {
            echo "Invalid transaction type or account type.";
            exit;
        }

       
    
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("di", $amount, $userId); // Bind amount and user ID
        $stmt1->execute();
        $stmt1->close();

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("di", $amount, $userId); // Bind amount and user ID
        $stmt->execute();
        $stmt->close();
    
        // Record the transaction in the history table
        $sql = "INSERT INTO History (transaction_type, amount, user_id) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdi", $transaction_type, $amount, $userId);
        $stmt->execute();
        $stmt->close();
    
        $conn->close();
    
        echo "Transaction completed successfully.";
    }
    ?>
    
</body>
</html>

