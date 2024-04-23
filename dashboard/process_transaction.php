<?php
// Establish database connection
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "Banking";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$amount = $_POST['amount'];
$save_option = $_POST['save_option'];

// user authentication and user ID available in session
$user_id = $_SESSION['user_id'];

// Update checking balance
$sql = "UPDATE Accounts SET checking_balance = checking_balance + $amount WHERE user_id = $user_id";
$conn->query($sql);

// If user wants to save to savings
if ($save_option !== 'none') {
    // Calculate amount to save based on percentage or specific amount
    if ($save_option === 'percentage') {
        //  the percentage to save is 20%
        $save_amount = $amount * 0.2; // Adjust percentage as needed
    } else {
        // user inputs a specific amount to save
        $save_amount = $_POST['save_amount']; 
    }

    // Update savings balance
    $sql = "UPDATE Accounts SET savings_balance = savings_balance + $save_amount WHERE user_id = $user_id";
    $conn->query($sql);
}

// Record transaction history
$sql = "INSERT INTO History (transaction_type, amount, user_id) VALUES ('Deposit', $amount, $user_id)";
$conn->query($sql);

$conn->close();

exit();
?>

