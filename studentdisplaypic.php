<?php
$con = mysqli_connect('localhost', 'root', '', 'displayupload');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$displayquery = "SELECT `image` FROM imgupload ORDER BY id DESC";
$querydisplay = mysqli_query($con, $displayquery);

if (!$querydisplay) {
    die("Query failed: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Science Vision, Madhupur</title>
    <link rel="icon" href="images/tsv logo.jpeg" type="image/x-icon">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* background: linear-gradient(90deg, #141e30 0%, #243b55 100%); */
            background-color: #fff;
            margin: 0;
            padding: 0;
            text-align: center;
            color: #fff;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .slideshow-container {
            margin: 20px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .mySlides {
            width: calc(20% - 10px);
            margin: 10px;
            overflow: hidden;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            opacity: 0;
            animation: fadeIn 0.5s forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .mySlides:hover {
            transform: scale(1.05);
        }

        .mySlides img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 10px;
        }

        @media screen and (max-width: 768px) {
            .mySlides {
                width: calc(50% - 20px);
            }

            .mySlides:nth-child(2n) {
                clear: both;
            }
        }

        .mySlides:nth-child(5n) {
            clear: both;
        }

        .enlarged {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1000;
            background-color: rgba(0, 0, 0, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column; 
        }

        .enlarged img {
            max-width: 90%;
            max-height: 80%;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
        }

        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #fff;
            font-size: 24px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="slideshow-container">
        <?php
        $index = 1;
        while ($row = mysqli_fetch_assoc($querydisplay)) {
        ?>
            <div class="mySlides" onclick="toggleImageSize(this)">
                <img src="<?php echo $row['image']; ?>" alt="Image <?php echo $index; ?>" class="slide-image">
            </div>
        <?php
            $index++;
        }
        ?>
    </div>

    <script>
        function toggleImageSize(element) {
            element.classList.toggle("enlarged");
        }

        function closeImage(element) {
            element.parentElement.classList.remove("enlarged");
        }
    </script>
</body>

</html>
