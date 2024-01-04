<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSV</title>
    <link rel="icon" href="images/tsv logo.jpeg" type="image/x-icon">
    <style>
        /* Reset some default styles */
        body, h1, h2, h3, p, label {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            /* background-image: url("images/2.jpg"); */
            background: linear-gradient(90deg, #141e30 0%, #243b55 100%);

            color: white;
        }

        h1 {
            text-align: center;
            margin-top: 30px; /* Add margin for better spacing */
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 20px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(18px);
            border: 1px solid white;
            text-align: center;
            border-radius: 10px; /* Rounded corners for the form */
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: white;
        }

        input {
            width: 100%;
            padding: 10px; /* Adjusted padding for better input appearance */
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc; /* Add a border for input fields */
            border-radius: 5px; /* Rounded corners for input fields */
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease; /* Smooth transition on hover */
        }

        input[type="submit"]:hover {
            background-color: #45a049; /* Darken the background on hover */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th {
            background-color: black;
        }

        table, th, td {
            border: 1px solid #ddd;
            text-align: left;
            color: white;
            font-weight: bold;
        }

        th, td {
            padding: 10px;
        }

        /* Header styles */
        .header {
            background-color: #0c0850;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 6px 2px rgb(0, 0, 0);
        }

        .logo img {
            max-width: 100px;
            border-radius: 50%;
        }

        .stitle {
            margin-top: 0px;
        }

        .address {
            margin-top: 0px;
        }

        .address p {
            font-size: 14px;
            color: #ffffff;
        }

        /* Media query for smaller screens */
        @media screen and (max-width: 600px) {
            form {
                max-width: none;
            }
        }
    </style>
</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "science_vision";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $loggedIn = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM `webdev` WHERE `id` = ? AND `password` = ?");
        $stmt->bind_param("ss", $id, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $loggedIn = true;

            $attendanceQuery = "SELECT * FROM `attendance` WHERE `student_id` = '$id' ORDER BY `curr_date` DESC";
            $attendanceResult = $conn->query($attendanceQuery);
            ?>
            <style>
                .header {
                    background-color: #0c0850;
                    padding: 20px;
                    text-align: center;
                    box-shadow: 0 2px 6px 2px rgb(0, 0, 0);
                }

                .logo img {
                    max-width: 100px;
                    border-radius: 50%;
                }

                .stitle {
                    margin-top: 0px;
                }

                .address {
                    margin-top: 0px;
                }

                .address p {
                    font-size: 14px;
                    color: #ffffff;
                }
                #mor{
                    float: right;
                    text-decoration: none;
                    color: white;
                    font-weight: bold;
                    background-color: transparent;
                }
                #mor:hover{
                    color: red;
                    cursor: pointer;
                    box-shadow: -2px -6px 10px gray,2px 4px 5px rgba(128, 128, 128, 0.427);
                }
            </style>
            <header class="header">
                <div class="logo">
                    <img src="images/tsv logo.jpeg" alt="Logo"><br><br>
                </div>
                <div class="stitle">
                    <h2>The Science Vision</h2>
                    <h3>(College Road Madhupur Opposite Badi Anchi Devi high School)</h3>
                    <div class="address">
                        <p>P.O.:Madhupur, Dist:Deoghar(J.H.), Ph:03434-34343, Mob:9849633811 <br>E-mail:
                            thesciencevision@gmail.com</p>
                        <?php
                        echo "<h2>TEACHER-ID: $id</h2>";
                        ?>
                    </div>
                    <a href="test.html" id="mor">More...</a>
                </div>
            </header>
            <?php
            echo "<table border='1'>";
            echo "<tr><th>Date</th><th>Month</th><th>Year</th><th>Attendance</th></tr>";

            while ($row = $attendanceResult->fetch_assoc()) {
                $rowColor = '';
                if ($row['attendance'] == 'P') {
                    $rowColor = 'rgb(25, 185, 25)';
                } elseif ($row['attendance'] == 'H') {
                    $rowColor = 'blue';
                } elseif ($row['attendance'] == 'A') {
                    $rowColor = 'red';
                }

                echo "<tr style='background-color: $rowColor;'>";
                echo "<td>{$row['curr_date']}</td>";
                echo "<td>{$row['attendance_month']}</td>";
                echo "<td>{$row['attendance_year']}</td>";
                echo "<td>{$row['attendance']}</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Invalid ID or password. Please try again.";
        }

        $stmt->close();
    }

    $conn->close();
    ?>

    <?php if (!$loggedIn): ?>
    <h1>Login</h1>
    <form method="post" action="" style="text-align: center;">
        <label for="id">Roll No:</label>
        <input type="text" name="id" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <label for="showPassword">Show Password:</label>
        <input type="checkbox" id="showPassword" onclick="togglePassword()">

        <input type="submit" value="Login">
    </form>
    <?php endif; ?>

    <script>
        function togglePassword() {
            var passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>
</body>

</html>
