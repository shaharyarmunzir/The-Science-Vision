<?php
require_once("config.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the search queries from the form
    $searchClass = mysqli_real_escape_string($db, $_POST["searchClass"]);
    $searchBoard = mysqli_real_escape_string($db, $_POST["searchBoard"]);
    $searchRollNo = mysqli_real_escape_string($db, $_POST["searchRollNo"]);

    // Modify the SQL query to include the class, board, and roll no filters
    $sqlConditions = array();

    if (!empty($searchClass)) {
        $sqlConditions[] = "class = '$searchClass'";
    }

    if (!empty($searchBoard)) {
        $sqlConditions[] = "board = '$searchBoard'";
    }

    if (!empty($searchRollNo)) {
        $sqlConditions[] = "id LIKE '$searchRollNo%'";
    }

    $sqlQuery = "SELECT id, student_name, class, board FROM webdev";

    if (!empty($sqlConditions)) {
        $sqlQuery .= " WHERE " . implode(" AND ", $sqlConditions);
    }

    $fetchingStudents = mysqli_query($db, $sqlQuery) OR die(mysqli_error($db));

    // Recalculate the total number of students after filtering
    $totalNumberOfStudents = mysqli_num_rows($fetchingStudents);
} else {
    // If the form is not submitted, fetch all students
    $fetchingStudents = mysqli_query($db, "SELECT id, student_name, class, board FROM webdev") OR die(mysqli_error($db));
    $totalNumberOfStudents = mysqli_num_rows($fetchingStudents);
}

// Calculate the total days in the month
$firstDayOfMonth = date("1-m-Y");
$totalDaysInMonth = date("t", strtotime($firstDayOfMonth));

$StudentsNamesArray = array();
$StudentsIDsArray = array();
$StudentsClassArray = array();
$StudentsBoardArray = array();
$counter = 0;

while ($Students = mysqli_fetch_assoc($fetchingStudents)) {
    $StudentsIDsArray[] = $Students['id'];
    $StudentsNamesArray[] = $Students['student_name'];
    $StudentsClassArray[] = $Students['class'];
    $StudentsBoardArray[] = $Students['board'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSV</title>
    <link rel="icon" href="images/tsv logo.jpeg" type="image/x-icon">

    <style>
        body {
            background-color: #030247;
        }

        /* Style for the table container */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 50px;
            font-family: Arial, sans-serif;
        }

        /* Style for table headers */
        th {
            background-color: #3498db;
            color: #fff;
            font-weight: bold;
            padding: 10px;
            text-align: left;
        }

        /* Style for table header cells */
        th, td {
            border: 1px solid #ccc;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        /* Style for even rows */
        tr:nth-child(even) {
            background-color: #fff;
        }

        /* Style for odd rows */
        tr:nth-child(odd) {
            background-color: #13f73c;
        }

        /* Hover effect on rows */
        tr:hover {
            background-color: #e0e0e0;
        }

        .center-headings {
            text-align: center;
            color: #13f73c;
        }

        u {
            text-decoration: none;
        }

        /* Style for the loader */
        .loader {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
            margin: 50px auto;
            display: none; /* Initially hidden */
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

<div class="center-headings">
    <h1>SMART ATTENDANCE MANAGEMENT SYSTEM!</h1>
    <h2>STUDENTS ATTENDANCE OF MONTH: <u><font color="red"><?php echo strtoupper(date("F", strtotime($firstDayOfMonth))); ?></font></u></h2>

    <!-- Add the search form -->
    <form method="post" action="" id="searchForm">
        <label for="searchClass">Search by Class:</label>
        <select name="searchClass" id="searchClass">
            <option value="">All Classes</option>
            <?php
            // Fetch distinct classes from the database
            $classQuery = mysqli_query($db, "SELECT DISTINCT class FROM webdev") OR die(mysqli_error($db));

            while ($class = mysqli_fetch_assoc($classQuery)) {
                echo "<option value='" . $class['class'] . "'>" . $class['class'] . "</option>";
            }
            ?>
        </select>

        <label for="searchBoard">Search by Board:</label>
        <select name="searchBoard" id="searchBoard">
            <option value="">All Boards</option>
            <?php
            // Fetch distinct boards from the database
            $boardQuery = mysqli_query($db, "SELECT DISTINCT board FROM webdev") OR die(mysqli_error($db));

            while ($board = mysqli_fetch_assoc($boardQuery)) {
                echo "<option value='" . $board['board'] . "'>" . $board['board'] . "</option>";
            }
            ?>
        </select>

        <label for="searchRollNo">Search by Roll No (Starting 4 digits):</label>
        <input type="text" name="searchRollNo" id="searchRollNo">

        <input type="submit" value="Search">
    </form>

    <!-- Loader -->
    <div class="loader" id="loader"></div>
</div>

<table border="1" cellspacing="0">
    <?php
    for ($i = 1; $i <= $totalNumberOfStudents + 2; $i++) {
        if ($i == 1) {
            echo "<tr>";
            echo "<td rowspan='2'>Roll No</td>";
            echo "<td rowspan='2'>Names</td>";
            echo "<td rowspan='2'>Class</td>"; // Added column for class/board
            echo "<td rowspan='2'>Board</td>"; // Added column for class/board
            for ($j = 1; $j <= $totalDaysInMonth; $j++) {
                echo "<td>$j</td>";
            }
            echo "</tr>";
        } else if ($i == 2) {
            echo "<tr>";
            for ($j = 0; $j < $totalDaysInMonth; $j++) {
                echo "<td>" . date('D', strtotime("+$j days", strtotime($firstDayOfMonth))) . "</td>";
            }
            echo "</tr>";
        } else {
            echo "<tr>";
            echo "<td>" . $StudentsIDsArray[$counter] . "</td>";
            echo "<td>" . $StudentsNamesArray[$counter] . "</td>";
            echo "<td>" . $StudentsClassArray[$counter] . "</td>"; // Display class/board
            echo "<td>" . $StudentsBoardArray[$counter] . "</td>"; // Display class/board
            for ($j = 1; $j <= $totalDaysInMonth; $j++) {
                $dateOfAttendance = date("Y-m-$j");

                $fetchingStudentsAttendance = mysqli_query($db, "SELECT attendance FROM attendance WHERE student_id = '" . $StudentsIDsArray[$counter] . "' AND curr_date = '" . $dateOfAttendance . "'") OR die(mysqli_error($db));

                $isAttendanceAdded = mysqli_num_rows($fetchingStudentsAttendance);
                if ($isAttendanceAdded > 0) {
                    $studentAttendance = mysqli_fetch_assoc($fetchingStudentsAttendance);
                    echo "<td>" . $studentAttendance['attendance'] . "</td>";
                } else {
                    echo "<td></td>";
                }
            }
            echo "</tr>";
            $counter++;
        }
    }
    ?>
</table>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Add an event listener to the search form
        document.getElementById('searchForm').addEventListener('submit', function (event) {
            // Prevent the default form submission
            event.preventDefault();

            // Show the loader
            document.getElementById('loader').style.display = 'block';

            // Set a timeout to fetch data after 5 seconds
            setTimeout(function () {
                // Hide the loader after 5 seconds
                document.getElementById('loader').style.display = 'none';

                // Submit the form to fetch data
                event.target.submit();
            }, 1000);
        });
    });
</script>

</body>
</html>
