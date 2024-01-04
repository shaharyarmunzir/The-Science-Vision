<!DOCTYPE html>
<html lang="en">

<head>
    <title>TSV</title>
    <link rel="icon" href="images/tsv logo.jpeg" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: rgb(16, 2, 55);
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px auto;
            font-size: 16px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            font-size: 16px;
        }

        th {
            background-color: rgb(24, 245, 24);
            color: #fff;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            font-size: 18px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:nth-child(odd) {
            background-color: rgb(100, 243, 100);
        }

        th input[type="checkbox"] {
            display: block;
            margin: 0 auto;
        }

        input[type="date"] {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 10px 0;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #2904fa;
            color: #fff;
            padding: 10px 20px;
            border: 4px solid #2904fa;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
        }

        input[type="submit"]:hover {
            background-color: transparent;
            border: 4px solid #2904fa;
            color: #2904fa;
        }

        td {
            border: 1px solid black;
            font-size: 20px;
            padding: 10px;
        }

        h1 {
            text-align: center;
            color: rgb(24, 245, 24);
        }

        .d {
            text-align: center;
        }

        button[type="button"] {
            background-color: #ff7800;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }

        button[type="button"]:hover {
            background-color: #ff964b;
        }
        @media screen and (max-width: 600px) {
            table {
                font-size: 14px; /* Adjust font size for smaller screens */
                width: 100%;
                overflow-x: auto; /* Add horizontal scrollbar for smaller screens */
            }

            th, td {
                padding: 8px; /* Adjust padding for smaller screens */
            }

            input[type="submit"], button {
                font-size: 14px; /* Adjust button font size for smaller screens */
                padding: 8px 12px; /* Adjust button padding for smaller screens */
            }
        }

    </style>
</head>

<body>
    <div class="d">
        <h1>ATTENDANCE</h1>
        <a href="form_of_atten.php" style="text-align: center; border: 2px solid black; background: #fe0101; color: white; text-decoration: none; padding: 10px;">View Attendance</a>
    </div>
    <table border="1" cellspacing="0">
        <form method="POST">
            <tr>
                <td>Search by Board:</td>
                <td>
                    <select name="search_board">
                        <option value="">All</option>
                        <option value="CBSE">CBSE Board</option>
                        <option value="ICSE">ICSE Board</option>
                        <option value="JAC">JAC Board</option>
                        <!-- Add more options as needed -->
                    </select>
                </td>
                <td>Search by Class:</td>
                <td>
                    <select name="search_class">
                        <option value="">All</option>
                        <option value="8">Class 8</option>
                        <option value="9">Class 9</option>
                        <option value="10">Class 10</option>
                        <option value="11">Class 11</option>
                        <option value="12">Class 12</option>
                        <!-- Add more options as needed -->
                    </select>
                </td>
                <td>Search by Roll Prefix:</td>
                <td><input type="text" name="search_roll_prefix" placeholder="Enter first 4 digits"></td>
                <td colspan="3"><input type="submit" name="searchAttendanceBTN" value="Search" /></td>
            </tr>
            <tr>
                <td>Select Date (Optional)</td>
                <td colspan="7"><input type="date" name="selected_date" /></td>
            </tr>
            <tr>
                <th>Roll No</th>
                <th>Student Name</th>
                <th>Class</th>
                <th>Board</th>
                <th> P </th>
                <th> A </th>
                <th> H </th>
            </tr>
            <?php
            require_once("config.php");

            if (isset($_POST['searchAttendanceBTN'])) {
                // Handle search functionality here
                $search_class = isset($_POST['search_class']) ? $_POST['search_class'] : '';
                $search_board = isset($_POST['search_board']) ? $_POST['search_board'] : '';
                $search_roll_prefix = isset($_POST['search_roll_prefix']) ? $_POST['search_roll_prefix'] : '';

                $query = "SELECT * FROM webdev WHERE 
                    (class LIKE '%$search_class%' OR '$search_class' = '') AND 
                    (board = '$search_board' OR '$search_board' = '')";

                if (!empty($search_roll_prefix)) {
                    $query .= " AND (SUBSTRING(id, 1, 4) = '$search_roll_prefix')";
                }

                $fetchingStudents = mysqli_query($db, $query) or die(mysqli_error($db));

                $totalRecords = mysqli_num_rows($fetchingStudents);

                while ($data = mysqli_fetch_assoc($fetchingStudents)) {
                    $student_name = $data['student_name'];
                    $student_id = $data['id'];
                    $class = $data['class'];
                    $board = $data['board'];
            ?>
                    <tr>
                        <td><?php echo $student_id; ?></td>
                        <td><?php echo $student_name; ?></td>
                        <td><?php echo $class; ?></td>
                        <td><?php echo $board; ?></td>
                        <td><input type="checkbox" name="studentPresent[]" value="<?php echo $student_id; ?>"></td>
                        <td><input type="checkbox" name="studentAbsent[]" value="<?php echo $student_id; ?>"></td>
                        <td><input type="checkbox" name="studentHoliday[]" value="<?php echo $student_id; ?>"></td>
                    </tr>
            <?php
                }
            }
            ?>
            <tr>
                <th colspan="7">
                    Total Student In This Class: <?php echo $totalRecords; ?>
                    <input type="submit" name="addAttendanceBTN" />
                    <button type="button" onclick="selectAllHoliday()">Select All H</button>
                    <button type="button" onclick="markAbsentForUnselected()">Mark Absent for Unselected</button>
                    <button type="button" onclick="deleteAllData()">Delete All Data</button>
                </th>
            </tr>
        </form>
    </table>
    
    <?php
    if (isset($_POST['addAttendanceBTN'])) {
        $selected_date = ($_POST['selected_date'] == null) ? date("Y-m-d") : $_POST['selected_date'];

        $attendance_month = date("M", strtotime($selected_date));
        $attendance_year = date("Y", strtotime($selected_date));

        $attendance_categories = ['studentPresent', 'studentAbsent', 'studentLeave', 'studentHoliday'];

        foreach ($attendance_categories as $category) {
            if (isset($_POST[$category])) {
                $attendance = substr($category, 7, 1);
                $students = $_POST[$category];

                foreach ($students as $student_id) {
                    mysqli_query($db, "INSERT INTO attendance(student_id, curr_date, attendance_month, attendance_year, attendance) VALUES ('$student_id', '$selected_date', '$attendance_month', '$attendance_year', '$attendance')") or die(mysqli_error($db));
                }
            }
        }
    }
    ?>
    <script>
        function selectAllHoliday() {
            var checkboxes = document.querySelectorAll('input[name="studentHoliday[]"]');
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = true;
            });
        }

        function markAbsentForUnselected() {
            var checkboxes = document.querySelectorAll('input[name="studentPresent[]"]');
            checkboxes.forEach(function (checkbox) {
                if (!checkbox.checked) {
                    checkbox.closest('tr').querySelector('input[name="studentAbsent[]"]').checked = true;
                }
            });
        }

        function deleteAllData() {
            var confirmDelete = confirm("Are you sure you want to delete all data?");
            if (confirmDelete) {
                window.location.href = "delete_all_data.php";
            }
        }
    </script>
</body>

</html>
