<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "science_vision";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$roll_number = $_POST['roll_number'];
$password = $_POST['password'];

$roll_number = mysqli_real_escape_string($conn, $roll_number);
$password = mysqli_real_escape_string($conn, $password);

$query = "SELECT * FROM `result` WHERE `roll_number` = ? AND `password` = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $roll_number, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Invalid login credentials. Please try again.";
    $conn->close();
    exit; // Exit the script if login is invalid
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

    <title>TSV Result</title>
    <link rel="icon" href="images/tsv logo.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="Result.css">
    <style>
        /* Add your additional styles here if needed */
        body {
            font-family: 'Gabarito', sans-serif;
        }
        @media only screen and (max-width: 600px) {
            table {
                width: 100%;
                overflow-x: auto;
                display: block;
            }

            th, td {
                width: 150px; /* Set a minimum width for cells */
            }

            .result-container {
                width: 100%;
                overflow-x: auto;
                display: block;
            }
            .header{
    position: relative;
    top: 0;
    height: 38vh;
    width:100%;
    background-image: linear-gradient(rgb(7, 1, 65), #060277);
}
.header h3{
    font-size: 0.73rem;
}
.header .logo img{
    height: 50px;
    width:50px;
    display: flex;

    position: absolute;
    margin: 25px 40px;

    
}
           
        }
        
    </style>
</head>

<body>
    <div class="download">
    <!-- Your HTML content for displaying the table -->
    <header class="header">
        <div class="logo">
            <img src="images/tsv logo.jpeg" alt="Logo" ><br><br>
        </div>
        <div class="stitle">
            <h2>The Science Vision</h2>
            <h3>(College Road Madhupur Opposite Badi Anchi Devi high School)</h3>
            <div class="address">
                <p>P.O.:Madhupur, Dist:Deoghar(J.H.), Ph:03434-34343, Mob:9849633811 <br>E-mail:
                    thesciencevision@gmail.com</p>
            </div>
            <div class="terms">
                <p class="pterm">
                    <a href="#" class="anchor">Term 1 /</a> 
                    <a href="#" class="anchor">Term 2 /</a> 
                    <a href="#" class="anchor">Term 3 </a> 
                    <a href="#" class="anchor">            <button id="downloadButton" style="margin-top: 20px; padding: 10px 10px; font-size: 16px; background-color: transparent; color: #ffffff; border: none; border-radius: 5px; cursor: pointer;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform:msFilter;"><path d="M19 9h-4V3H9v6H5l7 8zM4 19h16v2H4z"></path></svg></button>
                    </a> 
                </p>

            </div>
        </div>
    </header>

    <?php if ($result->num_rows > 0): ?>
        <section class="section">
        <div class="term1-table">
            <a name="termNo1">
                <div id="termNo1">
        <div class="result-container">
            <p><b>Name: <?php echo htmlspecialchars($row["name"]); ?></b></p>
            <p><b>Roll: <?php echo htmlspecialchars($row["roll_number"]); ?></b></p>
            <p><b>Class: <?php echo htmlspecialchars($row["class"]); ?></b></p>
            <table>
            <!-- <button id="downloadButton">Download Image</button> -->

                <tr>
                    <th>Term</th>
                    <th>Physics</th>
                    <th>Chemistry</th>
                    <th>Maths</th>
                    <th>Bio</th>
                </tr>
                <tr>
                    <td>Term1</td>
                    <td><?php echo htmlspecialchars($row["physicsa"]); ?></td>
                    <td><?php echo htmlspecialchars($row["chemistrya"]); ?></td>
                    <td><?php echo htmlspecialchars($row["mathsa"]); ?></td>
                    <td><?php echo htmlspecialchars($row["bioa"]); ?></td>
                </tr>
                <tr>
                    <td>Term2</td>
                    <td><?php echo htmlspecialchars($row["physicsb"]); ?></td>
                    <td><?php echo htmlspecialchars($row["chemistryb"]); ?></td>
                    <td><?php echo htmlspecialchars($row["mathsb"]); ?></td>
                    <td><?php echo htmlspecialchars($row["biob"]); ?></td>
                </tr>
                <tr>
                    <td>Term3</td>
                    <td><?php echo htmlspecialchars($row["physicsc"]); ?></td>
                    <td><?php echo htmlspecialchars($row["chemistryc"]); ?></td>
                    <td><?php echo htmlspecialchars($row["mathsc"]); ?></td>
                    <td><?php echo htmlspecialchars($row["bioc"]); ?></td>
                </tr>
            </table>
            <br><br><p style="float: right;">Parent's Signature :......................................</p><br><br><br>
        </div>
        </div>
    <?php endif; ?>
</body>
</html>

<?php
$conn->close();
?>
<script>
        document.getElementById('downloadButton').addEventListener('click', function() {
            // Capture the content of the result-container div
            html2canvas(document.querySelector('.download')).then(canvas => {
                // Convert the canvas to PNG data URL
                var imgData = canvas.toDataURL('image/png');
                
                // Create a temporary link and trigger a download
                var a = document.createElement('a');
                a.href = imgData;
                a.download = 'result_image.png';
                a.click();
            });
        });
    </script>