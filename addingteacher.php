<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSV</title>
    <link rel="icon" href="images/tsv logo.jpeg" type="image/x-icon">
    <style>
body {
    font-size: 20px;
    margin: 0;
    padding: 0;
    /* background-image: url("images/stt.jpg"); */
    background: linear-gradient(90deg, #141e30 0%, #243b55 100%);

    background-repeat: no-repeat;
    background-size: cover;
    display: flex; /* Add this line */
    align-items: center; /* Add this line */
    justify-content: center; /* Add this line */
    height: 100vh; /* Add this line */
}

form {
    max-width: 1000px;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    backdrop-filter: blur(18px);
    color: white;
}

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Media query for smaller screens */
        @media only screen and (max-width: 600px) {
            body {
                font-size: 16px;
            }

            form {
                padding: 10px;
            }
        }
        form h1{
            text-align: center;
            color: aquamarine;
        }
    </style>
</head>
<body>
    <form method="POST">
        <h1>Enter Teacher for attendance</h1>
        <input type="text" name="user_id" placeholder="User ID" required autofocus />
        <input type="text" name="student_name" placeholder="Teacher Name" required />
        <input type="password" name="password" placeholder="Password" required />

        <!-- Dropdown menu for selecting class -->
        <label for="class">Select Staff Type:</label>
        <select name="class" required>
            <option value="teaching">teaching Staff</option>
            <option value="Non Teaching">Non Teaching Staff</option>
            <!-- Add more options for different classes as needed -->
        </select>

        <!-- Dropdown menu for selecting board -->
        <label for="board">Select Staff Gender:</label>
        <select name="board" required>
            <option value="MALE">MALE</option>
            <option value="FEMALE">FEMALE</option>
            <!-- Add more options for different boards as needed -->
        </select>

        <input type="submit" value="Add" name="submit">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        require_once("configs.php");

        // Sanitize user input
        $user_id = mysqli_real_escape_string($db, $_POST['user_id']);
        $student_name = mysqli_real_escape_string($db, $_POST['student_name']);
        $password = $_POST['password'];
        $class = mysqli_real_escape_string($db, $_POST['class']);
        $board = mysqli_real_escape_string($db, $_POST['board']); // Add this line

        // Use prepared statements to prevent SQL injection
        $query = "INSERT INTO `webdev` (`id`, `student_name`, `password`, `class`, `board`) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($db, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "issss", $user_id, $student_name, $password, $class, $board);

            if (mysqli_stmt_execute($stmt)) {
                echo '<p style="color: green;">Student has been added successfully!</p>';
            } else {
                echo '<p style="color: red;">Error: Unable to add student. Please try again later.</p>';
            }

            mysqli_stmt_close($stmt);
        } else {
            echo '<p style="color: red;">Error: Unable to process your request. Please try again later.</p>';
        }

        mysqli_close($db);
    }
    ?>
</body>
</html>
