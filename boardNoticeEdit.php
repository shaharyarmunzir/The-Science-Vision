<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mia";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

if (!empty($id)) {
    $query = "SELECT * FROM `notice` WHERE id = '$id'";
    $data = mysqli_query($conn, $query);

    if ($data) {
        $result = mysqli_fetch_assoc($data);
    } else {
        die("Error fetching data: " . mysqli_error($conn));
    }
}

if (isset($_POST['update'])) {
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $noticetop = mysqli_real_escape_string($conn, $_POST['noticetop']);
    $notice = mysqli_real_escape_string($conn, $_POST['notice']);

    $query = "UPDATE `notice` SET 
    `date`='$date',
    `noticetop`='$noticetop',
    `notice`='$notice'
    WHERE id='$id'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $message = "Update Successfully";
        header("Location: http://localhost/moon/boardnotice.php");
        exit();
    } else {
        $message = "Update failed: " . mysqli_error($conn);
    }
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
            background-color: #190251;
            font-family: Arial, sans-serif;
        }

        .inputbox1 {
            position: absolute;
            float: right;
            width: 100%;
            text-align: center;
            box-shadow: 0 2px 6px 2px;
            background-color: rgb(26, 243, 15);
        }

        .inputbox1 input {
            width: 90%;
            margin: 1%;
            height: 5vh;
            text-align: center;
            cursor: pointer;
        }

        .inputbox1 label {
            font-size: 1.5rem;
            cursor: pointer;
        }

        .inputbox1 .button {
            font-size: 1.5rem;
            background-color: rgb(18, 2, 249);
            border: 2px solid black;
            color: white;
            width: 90%;
            height: 8vh;
            margin-bottom: 50px;
            margin-top: 25px;
            border-radius: 20px;
            cursor: pointer;
        }

        .inputbox1 .button:hover {
            background: transparent;
            border: none;
            box-shadow: 0 2px 6px 2px;
            color: black;
        }

        @media (max-width: 768px) {
            .inputbox1 {
                width: 95%;
            }
        }
    </style>
</head>
<body>
    <form action="" method='post'>
        <div class="inputbox1">
            <h1>EDIT NOTICE</h1><hr>
            <?php
            if (!empty($message)) {
                echo '<div class="' . (strpos($message, 'successful') !== false ? 'success-message' : 'error-message') . '">' . $message . '</div>';
            }
            ?>
            <label for="date">Date</label><br>
            <input type="date" placeholder="date" value="<?php echo htmlspecialchars($result['date'] ?? ''); ?>" id="date" name="date"> <br>

            <label for="noticetop">Notice Title</label><br>
            <input type="text" placeholder="noticetop" value="<?php echo htmlspecialchars($result['noticetop'] ?? ''); ?>" id="noticetop" name="noticetop"> <br>

            <label for="notice">Notice Body</label><br>
            <input type="text" placeholder="notice" value="<?php echo htmlspecialchars($result['notice'] ?? ''); ?>" id="notice" name="notice"> <br>

            <div class="input_field">
                <input type="submit" value="Update Notice" class="button" name="update">
            </div>
        </div>
    </form>
</body>
</html>
