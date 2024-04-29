<header>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</header>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/dashboard/HomePage.php">Maze Bank</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/dashboard/HomePage.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/dashboard/TransactionPage.php">Make a Transaction</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/dashboard/HistoryPage.php">Transaction History</a>
      </li>
    </ul>
  </div>
</nav>

<h1 style="text-align:center">Home Page</h1>
<div class="container mt-4" style="text-align:center;" id="checking">
  
  <?php
  session_start();
  $userId = $_SESSION["user_id"];
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "banking";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql ="SELECT * FROM accounts WHERE user_id = $userId";
  $result = mysqli_query($conn, $sql);

  $sql2 = "SELECT * FROM users WHERE id = $userId";
  $result2 = mysqli_query($conn, $sql2);

  if (mysqli_num_rows($result2) > 0) {
    while($row = mysqli_fetch_assoc($result2)) {
      echo "<h2>Welcome " . $row["firstname"]. " " . $row["lastname"]. "</h2>";
    }
  }

  $currentUser = $_SESSION["user_id"];
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      echo "<h3><strong>Checking:</strong> $" . $row["checking_balance"]. " <br> <strong>Savings:</strong>  $" . $row["savings_balance"]. "<h3><br>";
    }
  }
?>


</div>
<br>
<br>
<br>
<div id="transaction" >
<h1>Transfer Money</h1>
<button onclick="window.location.href='/dashboard/TransactionPage.php'" type="submit" class="btn btn-danger" color="red">Transfer Money</button>
</div>

<style>
  #checking {
    display: block;
    margin: 5 auto;
    border: 1px solid black;
    border-radius: 10px;
    padding: 10px;
    margin: auto;
    width: 500px;
    text-align: center;
    position : relative;
    background-color: #dc3545;
    color : white;
  }

  #transaction {
    display: block;
    margin: 5 auto;
    padding: 10px;
    margin: auto;
    width: 500px;
    text-align: center;
    position : relative;
  }
</style>  