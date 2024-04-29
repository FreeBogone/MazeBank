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
      <li class="nav-item">
        <a class="nav-link" href="/dashboard/HomePage.php">Home </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/dashboard/TransactionPage.php">Make a Transaction </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/dashboard/HistoryPage.php">Transaction History <span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
</nav>

<body>
<?php
  session_start();
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "Banking";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $database);
  // get user_id
  $user_id = $_SESSION['user_id'];
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
}

$rows = $conn->query("SELECT transaction_type, amount FROM History WHERE user_id = $user_id");

?>
<div class="container table-responsive">
  <table class="table table-bordered">
    <thead class="thead-light">
      <tr>
        <th>Transaction Type</th>
        <th>Amount</th>
      </tr>
      <?php 
      while ($row = $rows->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $key => $value) {
          if($value == 'deposit') {
            echo "<td style='color: green'>" . $value . "</td>"; 
          }
          else if($value == 'withdraw') {
            echo "<td style='color: red'>" . $value . "</td>"; 
          }
          else {
            echo "<td>" . $value . "</td>"; 
          }
        }
        echo "</tr>";
      }
      ?>
    </thead>
  </table>
</div>
</body>