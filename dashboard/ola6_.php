<!DOCTYPE html>
    <head>
        <title>OLA 6</title>
        <link rel="stylesheet" type="text/css" href="ola6.css">
    </head>
    <body>
        <h1 id="header">Student Database</h1>

        <?php
            $servername = "localhost";
                        $username = "root";
                        $password = "";
            $database = "CSCI4410";
                        
                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $database);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }




            $rows = $conn->query("SELECT * FROM Students");
            $headers = $conn->query("SHOW COLUMNS FROM Students");
            echo "<table>";
            echo "<tr>";
            while ($header = $headers->fetch_assoc()) {
                echo "<th>" . $header['Field'] . "</th>";
            }
            echo "</tr>";
            while ($row = $rows->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $key => $value) {
                    echo "<td>" . $value . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";




            $rows = $conn->query("SELECT Name FROM Students WHERE Gender = 'Male'");
            echo "<table>";
            echo "<tr>";
            echo "<th>Men</th>";
            echo "</tr>";
            while ($row = $rows->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Name'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";




            $rows = $conn->query("SELECT Name FROM Students WHERE Gender = 'Female'");
            echo "<table>";
            echo "<tr>";
            echo "<th>Women</th>";
            echo "</tr>";
            while ($row = $rows->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Name'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";




            $rows = $conn->query("SELECT Name FROM Students WHERE Age > 21");
            echo "<table>";
            echo "<tr>";
            echo "<th>Students Over 21</th>";
            echo "</tr>";
            while ($row = $rows->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Name'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";




            $rows = $conn->query("SELECT DISTINCT Major FROM Students");
            echo "<table>";
            echo "<tr>";
            echo "<th>Distinct Majors</th>";
            echo "</tr>";
            while ($row = $rows->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Major'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";




            $rows = $conn->query("SELECT Name FROM Students WHERE Phone IS NULL");
            echo "<table>";
            echo "<tr>";
            echo "<th>Students Without Phone Numbers</th>";
            echo "</tr>";
            while ($row = $rows->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Name'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";




            $sql = "INSERT INTO Students VALUES
            (11, 'Whit Barrett', 123456789, 'Computer Science', 'Junior', 'wab5a@mtsu.edu', 'Male', 21, '123-456-1234')";
            if ($conn->query($sql) === TRUE) {
                echo "New record inserted successfully<br>";
            }
            else {
            echo "Error: " . $sql. " " . $conn->error . " ";
            }




            $sql = "DELETE FROM Students WHERE StudentID = 11";
            if ($conn->query($sql) === TRUE) {
                echo "Record deleted successfully<br>";
            }
            else {
                echo "Error: " . $sql. " " . $conn->error . " ";
            }




            $sql = "UPDATE Students SET Phone = '321-654-0987' WHERE Name = 'John Doe'";
            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
            }
            else {
                echo "Error: " . $sql. " " . $conn->error . " ";
            }




            $conn->close();
        ?>
    </body>
</html>```