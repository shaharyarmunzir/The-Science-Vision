<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSV</title>
    <link rel="icon" href="images/tsv logo.jpeg" type="image/x-icon">
    <style>
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
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 50px; 
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(18px);
            border: 1px solid white;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th {
            background-color: black;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            text-align: left;
            color: white;
            font-weight: bold;
        }

        th,
        td {
            padding: 10px;
        }

        .password-toggle {
            display: flex;
            align-items: center;
        }

        .password-toggle input {
            margin-right: 5px;
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
    $database = "mobile";

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
                            echo "<h2>Roll No: $id</h2>";
                            ?>
                    </div>
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
    <form method="post" action="">
        <label for="id" style="color: rgb(255, 255, 255);">ROLL NO:</label>
        <input type="text" name="id" required><br>

        <label for="password" style="color: rgb(250, 250, 250);">PASSWORD:</label>
        <div class="password-toggle">
            <input type="password" name="password" id="passwordInput" required>
            <input type="checkbox" id="passwordToggle">Show Password
        </div><br>

        <input type="submit" value="Login">
    </form>

    <script>
        const passwordInput = document.getElementById("passwordInput");
        const passwordToggle = document.getElementById("passwordToggle");

        passwordToggle.addEventListener("change", function () {
            passwordInput.type = this.checked ? "text" : "password";
        });
    </script>
    <?php endif; ?>
</body>

</html>
