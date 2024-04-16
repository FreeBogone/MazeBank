<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Connect To DB</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="" />
  <link rel="icon" href="favicon.png">
</head>
<body>
  <h1>Welcome, We Are Connecting to the Database</h1>

<?php
  $servername = "localhost";
  $username = "root";
  $password = "";

  // Connect to MySQL Database Server Using mysqli
        // Object Oriented way
  $conn = new mysqli($servername, $username, $password);

  // Check connection
  if ($conn->connect_error) {
            //Print a message and terminate the current script
      die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully";

  // write the SQL query
  $sql = "SELECT * FROM Persons where TABLE_SCHEMA = 'myTest'"; //select all the columns from database table Persons
                          //Perform query on a database
  $result = mysqli_query($conn, $sql); //fetch the resulting rows as an associated array

  echo "Check 1 <br>";

  $sql2 = "SELECT COLUMN_NAME
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA ='CSCI4410' AND TABLE_NAME = 'Persons'"; // select all column names from table Persons
  $columns = mysqli_query($conn,$sql2); 
  
  echo "Check 2 <br>";
  //Use table to display the database table


  $conn->close(); //disconnect from the MySQL database

?>

</body>
</html>