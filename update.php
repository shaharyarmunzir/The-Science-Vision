<link rel="icon" href="images/tsv logo.jpeg" type="image/x-icon">
<title>TSV</title>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "science_vision";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<html>";
echo "<head>";
echo "<style>";
echo "body { font-family: Arial, sans-serif; }";
echo "form { width: 90%; margin: 20px auto; }";
echo "input[type='text'] { width: 100%; padding: 8px; margin-bottom: 10px; font-size: 16px; }";
echo "label { display: block; margin-bottom: 5px; font-size: 18px; }";
echo "input[type='submit'] { width: 100%; padding: 10px; background-color: #4CAF50; color: white; border: none; }";

echo "@media only screen and (max-width: 600px) {";
echo "  form { width: 100%; }";
echo "  input[type='text'] { width: 100%; font-size: 14px; }";
echo "  label { font-size: 16px; }";
echo "}";
echo "</style>";
echo "</head>";
echo "<body>";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "SELECT * FROM `result` WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Display the update form with pre-filled values
        echo "<form method='post' action='update.php'>";
        echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";

        foreach ($row as $column => $value) {
            if (!in_array($column, ["id", "rollno", "password"])) {
                echo "<label>" . ucfirst($column) . ":</label>";
                echo "<input type='text' name='$column' value='$value'><br>";
            }
        }

        echo "<input type='submit' value='Update'>";
        echo "</form>";
    } else {
        echo "Record not found";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    // Handle the update process when the form is submitted
    $id = $_POST["id"];

    $updateSql = "UPDATE `result` SET ";
    foreach ($_POST as $column => $value) {
        if (!in_array($column, ["id", "rollno", "password"])) {
            $updateSql .= "`$column` = '$value', ";
        }
    }
    $updateSql = rtrim($updateSql, ", ");
    $updateSql .= " WHERE id = $id";

    if ($conn->query($updateSql) === TRUE) {
        // Redirect to fetchingresult.php after successful update
        header("Location: fetchingresult.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

echo "</body>";
echo "</html>";

$conn->close();
?>
