<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="icon" href="images/tsv logo.jpeg" type="image/x-icon">
    <title>TSV</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            justify-content: center;
            align-items: center;
            /* min-height: 100vh; */
            /* overflow-y: auto;
            overflow-x: auto; */
            background: rgb(7, 1, 65);
        }

        .container {
            width: 100%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }
        .container1 {
            width: 100%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: auto;
            overflow-x: auto;
            max-height: 600px;
        }

        h2 {
            color: red;
            padding: 0px;
            margin: 0;
            text-align: center;
        }

        p {
            color: #45a049;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow-x: auto;
            overflow-y: auto;
            max-height: 400px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        form {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-size: 16px;
            /* margin-right: 10px; */
            color: #333;
        }

        input[type="text"] {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            flex-grow: 1;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        button:hover {
            background-color: #45a049;
        }

        @media only screen and (max-width: 768px) {
            body {
                background: rgb(7, 1, 65);
                width: 100%;
            }

            .container {
                width: 100%;
            }

            h2 {
                font-size: 1.5rem;
            }

            p {
                font-size: 1rem;
            }

            form {
                flex-direction: column;
                align-items: stretch;
            }

            label {
                margin-bottom: 5px;
            }

            input[type="text"] {
                margin-bottom: 10px;
            }

            button {
                width: 100%;
            }

            table {
                font-size: 12px;
            }
        }
        
    </style>
    <title>Display The Science Vision Admission Data</title>
    <link rel="icon" href="images/tsv logo.jpeg" type="image/x-icon">
</head>
<body>
    <div id="m">
    <div class="container">
        <h2><img src="images/tsv logo.jpeg" alt="" width="10%"></h2>
        <p>The Science Vision Student Admission Data <br>(College Road Madhupur Opposite Badi Anchi Devi high School) <br>
        P.O.:Madhupur, Dist:Deoghar(J.H.), Ph:03434-34343, Mob:9849633811 <br>E-mail: thesciencevision@gmail.com</p>
        <form method="GET">
            <label for="courseSearch">Search by Course:</label>
            <input type="text" id="courseSearch" name="courseSearch" placeholder="Enter course">
            <label for="boardSearch">Search by Board:</label>
            <input type="text" id="boardSearch" name="boardSearch" placeholder="Enter board">
            <button type="submit">Search</button>
        </form>
    </div>
        <div class="container1">
       

        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "science_vision";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $courseSearch = isset($_GET['courseSearch']) ? $_GET['courseSearch'] : '';
            $boardSearch = isset($_GET['boardSearch']) ? $_GET['boardSearch'] : '';

            if (!empty($courseSearch) && !empty($boardSearch)) {
                $sql = "SELECT * FROM the_science_vision_mdp 
                        WHERE cource LIKE '%$courseSearch%' 
                           AND board LIKE '%$boardSearch%'
                        ORDER BY sno DESC";
            } else {
                $sql = "SELECT * FROM the_science_vision_mdp ORDER BY sno DESC";
            }

            $result = $conn->query($sql);

            if ($result) {
                echo "<table border='1'>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Course</th>
                            <th>Father's Name</th>
                            <th>Address</th>
                            <th>Father's Phone</th>
                            <th>School Name</th>
                            <th>Board</th>
                            <th>DOB</th>
                        </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['phone']}</td>
                            <td>{$row['cource']}</td>
                            <td>{$row['fathers_name']}</td>
                            <td>{$row['address']}</td>
                            <td>{$row['fathers_phone']}</td>
                            <td>{$row['school_name']}</td>
                            <td>{$row['board']}</td>
                            <td>{$row['dob']}</td>
                        </tr>";
                }

                echo "</table>";
            } else {
                echo "Error: " . $conn->error;
            }

            $conn->close();
        ?>
    </div>
</div>
</body>
</html>
