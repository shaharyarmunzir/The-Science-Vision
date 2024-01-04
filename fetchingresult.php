<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSV</title>
    <link rel="icon" href="images/tsv logo.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 100%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-x: auto; /* Enable horizontal scrolling for the container */
        }

        h2 {
            color: #333;
        }

        .scrollable-table {
            width: 100%;
            max-height: 100%; /* Set the desired height */
            overflow: auto; /* Enable vertical scrolling for the table */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        @media only screen and (max-width: 600px) {
            .container {
                width: 100%;
            }
        }

        /* Add this CSS to your existing styles or update the existing styles.css file */

        /* Style for the update button */
        a.update-btn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #4CAF50; /* Green color */
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        /* Hover effect for the update button */
        a.update-btn:hover {
            background-color: #45a049; /* Darker green color on hover */
        }

        .button-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50; /* Green background color */
            color: white; /* White text color */
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #4CAF50; /* Green border */
            cursor: pointer;
        }

        /* Hover effect */
        .button-link:hover {
            background-color: white;
            color: #4CAF50;
        }
        /* Updated styles for the search form */

form {
    margin-top: 20px;
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

label {
    font-weight: bold;
    margin-right: 5px;
}

input[type="text"],
select {
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-bottom: 10px;
    width: 200px; /* Adjust the width as needed */
}

select {
    width: 210px; /* Adjust the width as needed to align with the text input */
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

    </style>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center;">Student Result Data</h1>
        
        <!-- Add the search form above the scrollable-table div -->
        <form method="get" action="">
            <label for="rollPrefix">Roll Number (Starting 4 digits):</label>
            <input type="text" name="rollPrefix" id="rollPrefix">

            <label for="class">Class:</label>
            <select name="class" id="class">
                <option value="">Select Class</option>
                <option value="8">Class 8</option>
                <option value="9">Class 9</option>
                <option value="10">Class 10</option>
                <option value="11">Class 11</option>
                <option value="12">Class 12</option>
                <!-- Add more options as needed -->
            </select>

            <label for="board">Board:</label>
            <select name="board" id="board">
                <option value="">Select Board</option>
                <option value="CBSE">CBSE BOARD</option>
                <option value="ICSE">ICSE BOARD</option>
                <option value="JAC">JAC BOARD</option>
                <!-- Add more options as needed -->
            </select>

            <input type="submit" value="Search">
        </form>

        <div class="scrollable-table">
            <!-- Display the fetched data here -->
            <?php
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

                // Modify the SQL query based on search parameters
                $searchRoll = isset($_GET['rollPrefix']) ? $_GET['rollPrefix'] : '';
                $searchClass = isset($_GET['class']) ? $_GET['class'] : '';
                $searchBoard = isset($_GET['board']) ? $_GET['board'] : '';

                $sql = "SELECT * FROM `result` WHERE 1";

                // Add conditions based on search parameters
                if (!empty($searchRoll)) {
                    $sql .= " AND SUBSTRING(roll_number, 1, 4) = '$searchRoll'";
                }

                if (!empty($searchClass)) {
                    $sql .= " AND class = '$searchClass'";
                }

                if (!empty($searchBoard)) {
                    // Depending on the structure of your database, you may need to adjust this condition
                    $sql .= " AND board = '$searchBoard'";
                }

                $result = $conn->query($sql);

                // Check for query execution error
                if (!$result) {
                    die("Query failed: " . $conn->error);
                }

                // Display the fetched data
                if ($result->num_rows > 0) {
                    echo "<table border='1'>";
                    echo "<tr><th>Class</th><th>Roll Number</th><th>Name</th> <th>Physics T1</th><th>Physics T2</th><th>Physics T3</th><th>Chemistry T1</th><th>Chemistry T2</th><th>Chemistry T3</th><th>Maths T1</th><th>Maths T2</th><th>Maths T3</th><th>Bio T1</th><th>Bio T2</th><th>Bio T3</th><th>Board</th><th>Option</th></tr>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["class"] . "</td><td>" . $row["roll_number"] . "</td><td>" . $row["name"] . "</td> <td>" . $row["physicsa"] . "</td><td>" . $row["physicsb"] . "</td><td>" . $row["physicsc"] . "</td><td>" . $row["chemistrya"] . "</td><td>" . $row["chemistryb"] . "</td><td>" . $row["chemistryc"] . "</td><td>" . $row["mathsa"] . "</td><td>" . $row["mathsb"] . "</td><td>" . $row["mathsc"] . "</td><td>" . $row["bioa"] . "</td><td>" . $row["biob"] . "</td><td>" . $row["bioc"] . "</td><td>" . $row["board"] . "</td><td><a href='update.php?id=" . $row["id"] . "' class='update-btn'>Update</a></td></tr>";
                    }
                    
                    echo "</table>";
                } else {
                    echo "No data found";
                }

                // Close connection
                $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
