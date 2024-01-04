<?php
require_once("configs.php");

$firstDayOfMonth = date("1-m-Y");
$totalDaysInMonth = date("t", strtotime($firstDayOfMonth));

$fetchingStudents = mysqli_query($db, "SELECT id, student_name, class, board FROM webdev") OR die(mysqli_error($db));

$totalNumberOfStudents = mysqli_num_rows($fetchingStudents);

$StudentsNamesArray = array();
$StudentsIDsArray = array();
$counter = 0;

while ($Students = mysqli_fetch_assoc($fetchingStudents)) {
    $StudentsIDsArray[] = $Students['id'];
    $StudentsNamesArray[] = $Students['student_name'];
    
    
}
?>
<link rel="icon" href="images/tsv logo.jpeg" type="image/x-icon">
<title>TSV</title>
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
</style>


<div class="center-headings">
    <h1>SMART ATTENDANCE MANAGEMENT SYSTEM!</h1>
    <h2>TEACHER ATTENDANCE OF MONTH: <u><font color="red"><?php echo strtoupper(date("F", strtotime($firstDayOfMonth))); ?></font></u></h2>
</div>

<table border="1" cellspacing="0">
    <?php
    for ($i = 1; $i <= $totalNumberOfStudents + 2; $i++) {
        if ($i == 1) {
            echo "<tr>";
            echo "<td rowspan='2'>Teacher ID</td>";
            echo "<td rowspan='2'>Teacher Names</td>";
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
