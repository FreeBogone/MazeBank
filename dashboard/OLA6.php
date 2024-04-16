
<!DOCTYPE html>
<html>
<head>
    <title>Student Database</title>
    <link rel="stylesheet" type="text/css" href="ola6.css">
</head>
<body>
    <h1 id="PageHeader">Student Database</h1>
    <h4 id="PersonalInfo">Bowen Truelove</h4>
    <h4 id="PersonalInfo">CSCI 4410</h4>
    <h4 id="PersonalInfo">OLA 6</h4>
<?php
// Create a connection to the database
$servername = "localhost"; // Change if your MySQL server is on a different host
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "CSCI4410"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select all records from Students and display as a table
$sql = "SELECT * FROM Students";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<h2>All Students</h2>";
    echo "<table border='1'><tr><th>ID</th><th>Name</th><th>BlueCard</th><th>Major</th><th>Class Level</th><th>Email</th><th>Gender</th><th>Age</th><th>Phone</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["ID"]."</td><td>".$row["Name"]."</td><td>".$row["BlueCard"]."</td><td>".$row["Major"]."</td><td>".$row["ClassLevel"]."</td><td>".$row["Email"]."</td><td>".$row["Gender"]."</td><td>".$row["Age"]."</td><td>".$row["Phone"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Select all male students and display
$sql_male = "SELECT * FROM Students WHERE Gender='Male'";
$result_male = $conn->query($sql_male);
if ($result_male->num_rows > 0) {
    echo "<h2>Male Students</h2>";
    echo "<table border='1'><tr><th>ID</th><th>Name</th><th>BlueCard</th><th>Major</th><th>Class Level</th><th>Email</th><th>Gender</th><th>Age</th><th>Phone</th></tr>";
    while($row = $result_male->fetch_assoc()) {
        echo "<tr><td>".$row["ID"]."</td><td>".$row["Name"]."</td><td>".$row["BlueCard"]."</td><td>".$row["Major"]."</td><td>".$row["ClassLevel"]."</td><td>".$row["Email"]."</td><td>".$row["Gender"]."</td><td>".$row["Age"]."</td><td>".$row["Phone"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Select all female students and display
$sql_female = "SELECT * FROM Students WHERE Gender='Female'";
$result_female = $conn->query($sql_female);
if ($result_female->num_rows > 0) {
    echo "<h2>Female Students</h2>";
    echo "<table border='1'><tr><th>ID</th><th>Name</th><th>BlueCard</th><th>Major</th><th>Class Level</th><th>Email</th><th>Gender</th><th>Age</th><th>Phone</th></tr>";
    while($row = $result_female->fetch_assoc()) {
        echo "<tr><td>".$row["ID"]."</td><td>".$row["Name"]."</td><td>".$row["BlueCard"]."</td><td>".$row["Major"]."</td><td>".$row["ClassLevel"]."</td><td>".$row["Email"]."</td><td>".$row["Gender"]."</td><td>".$row["Age"]."</td><td>".$row["Phone"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Select all students older than 21 and display
$sql_older_than_21 = "SELECT * FROM Students WHERE Age > 21";
$result_older_than_21 = $conn->query($sql_older_than_21);
if ($result_older_than_21->num_rows > 0) {
    echo "<h2>Students Older Than 21</h2>";
    echo "<table border='1'><tr><th>ID</th><th>Name</th><th>BlueCard</th><th>Major</th><th>Class Level</th><th>Email</th><th>Gender</th><th>Age</th><th>Phone</th></tr>";
    while($row = $result_older_than_21->fetch_assoc()) {
        echo "<tr><td>".$row["ID"]."</td><td>".$row["Name"]."</td><td>".$row["BlueCard"]."</td><td>".$row["Major"]."</td><td>".$row["ClassLevel"]."</td><td>".$row["Email"]."</td><td>".$row["Gender"]."</td><td>".$row["Age"]."</td><td>".$row["Phone"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Find out how many different majors and display them
$sql_majors = "SELECT DISTINCT Major FROM Students";
$result_majors = $conn->query($sql_majors);
if ($result_majors->num_rows > 0) {
    echo "<h2>Different Majors</h2>";
    echo "<ul>";
    while($row = $result_majors->fetch_assoc()) {
        echo "<li>".$row["Major"]."</li>";
    }
    echo "</ul>";
} else {
    echo "0 results";
}

// Select all students without phone information and display them
$sql_no_phone = "SELECT * FROM Students WHERE Phone IS NULL OR Phone = ''";
$result_no_phone = $conn->query($sql_no_phone);
if ($result_no_phone->num_rows > 0) {
    echo "<h2>Students Without Phone Information</h2>";
    echo "<table border='1'><tr><th>ID</th><th>Name</th><th>BlueCard</th><th>Major</th><th>Class Level</th><th>Email</th><th>Gender</th><th>Age</th><th>Phone</th></tr>";
    while($row = $result_no_phone->fetch_assoc()) {
        echo "<tr><td>".$row["ID"]."</td><td>".$row["Name"]."</td><td>".$row["BlueCard"]."</td><td>".$row["Major"]."</td><td>".$row["ClassLevel"]."</td><td>".$row["Email"]."</td><td>".$row["Gender"]."</td><td>".$row["Age"]."</td><td>".$row["Phone"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Insert a new row
$sql_insert = "INSERT INTO Students (ID, Name, BlueCard, Major, ClassLevel, Email, Gender, Age, Phone) 
               VALUES (11, 'Emily Smith', '12345678', 'Psychology', 'Junior', 'emilysmith@example.com', 'Female', 21, '615-111-2222')";

if ($conn->query($sql_insert) === TRUE) {
    echo "New record inserted successfully <br>";
} else {
    echo "Error: " . $sql_insert . "<br>" . $conn->error;
}

// Delete the tuple you just inserted
$sql_delete = "DELETE FROM Students WHERE ID = 11";
if ($conn->query($sql_delete) === TRUE) {
    echo "Record deleted successfully <br>";
} else {
    echo "Error: " . $sql_delete . "<br>" . $conn->error;
}

// Update John Doe's phone number
$sql_update = "UPDATE Students SET Phone = '321-654-0987' WHERE Name = 'John Doe'";
if ($conn->query($sql_update) === TRUE) {
    echo "Record updated successfully <br>";
} else {
    echo "Error: " . $sql_update . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>

</body>
</html>
