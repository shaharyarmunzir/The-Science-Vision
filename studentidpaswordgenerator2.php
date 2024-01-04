<?php
// Database connection parameters
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "science_vision";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $roll_number = $_POST["roll_number"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $class = $_POST["class"];
    $board = $_POST["board"];
    // ... (repeat for other form fields)

    // Build and execute the SQL query
    $sql = "INSERT INTO `result` 
            (`roll_number`, `password`, `name`, `class`, `board`) VALUES ('$roll_number', '$password', '$name', '$class', '$board')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
