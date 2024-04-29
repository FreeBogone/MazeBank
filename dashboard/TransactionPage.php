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

    

    <h1 style="text-align:center">Deposit or Withdraw From Your Accounts</h1>
    <div style="text-align:center" class="container mt-4">
        <form method="post" id="balanceForm" action="TransactionPage.php">
            <!-- Input fields for transaction type and amount -->
            <label for="transaction_type">Select Transaction Type:</label><br>
            <select class="form-control" id="transaction_type" name="transaction_type">
                <option value="deposit">Deposit</option>
                <option value="withdraw">Withdraw</option>
                <option value="transfer">Transfer</option>
            </select><br><br>
            <label for="account">Select Account Type:</label><br>
            <select class="form-control" id="account" name="account">
                <option value="checking">checking</option>
                <option value="savings">savings</option>
            </select><br><br>
            <label for="amount">Enter Amount:</label><br>
            <input class="form-control" type="number" id="amount" name="amount" min="0" step="0.01" required><br><br>
            <button type="submit" class="btn btn-danger">Submit</button>
        </form>
    </div>
</body>

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

        if($transactionType == 'deposit') {
            if($accountType == 'checking') {
                $sql = "UPDATE Accounts SET checking_balance = checking_balance + $amount WHERE user_id = $user_id";
            }
            if($accountType == 'savings') {
                $sql = "UPDATE Accounts SET savings_balance = savings_balance + $amount WHERE user_id = $user_id";
            }    
        }
        else if($transactionType == 'withdraw') {

            if($accountType == 'checking') {
                $sql = "UPDATE Accounts SET checking_balance = checking_balance - $amount WHERE user_id = $user_id";
            }
            if($accountType == 'savings') {
                $sql = "UPDATE Accounts SET savings_balance = savings_balance - $amount WHERE user_id = $user_id";
            }
        }
        else if($transactionType == 'transfer') {
            if($accountType == 'checking') {
                $sql = "UPDATE Accounts SET checking_balance = checking_balance - $amount, savings_balance = savings_balance + $amount WHERE user_id = $user_id";
            }
            if($accountType == 'savings') {
                $sql = "UPDATE Accounts SET checking_balance = checking_balance + $amount, savings_balance = savings_balance - $amount WHERE user_id = $user_id";
            }
        }

        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        }
        else {
            echo "Error: " . $sql. " " . $conn->error . " ";
        }
    }
?>
