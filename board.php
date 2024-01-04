<?php
error_reporting(0);
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "mia";

	$conn = mysqli_connect($servername,$username,$password,$dbname);

	if($conn)
	{
		// echo "ok";
	}
	else
	{
		echo "connection failed";
	}
?>
<?php
    $query = "SELECT * FROM `notice`";
	$data = mysqli_query($conn, $query);

	$total = mysqli_num_rows($data);
    $result = mysqli_fetch_assoc($data);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=.board, initial-scale=1.0">
    <link rel="icon" href="images/tsv logo.jpeg" type="image/x-icon">
    <title>TSV</title>
    <style>
        body{
            background-color: rgb(3, 3, 89);
        }
        .board{
            background: rgb(5, 59, 5);
            width: 80%;
            height: 75vh;
            margin-top: 50px;
            border: 8px solid rgb(99, 98, 98);
            margin-inline: 8%;
            box-shadow: 0px 2px 6px 2px;
        }
        h1{
            text-align: center;
            text-decoration: underline;
            color: white;
        }
        h2{
            text-decoration: underline;
            color: white;
        }
    body {
        font-family: 'Dancing Script', cursive;
        line-height: 1.4; 
    }

    #handwritten-text {
        font-weight: normal; 
        font-style: italic; 
        letter-spacing: 1px; 
    }
    @media (max-width:799px) {
        .board{
            width: 100%;
            height: 150vh;
            margin-inline: 0%;
            font-size: 0.9rem;
            border: 4px solid rgb(99, 98, 98);
        }
        
    }
    .logo img {
        width: 10%;
        height: auto;
        border-radius: 50%; /* Optional: Add rounded corners to the logo */
    }

    .stitle {
        text-align: center;
        margin-bottom: 20px;
    }

    .stitle h2 {
        color: white;
        font-size: 1.5em;
        margin-bottom: 5px;
    }

    .stitle h3 {
        color: white;
        font-size: 1.2em;
        margin-top: 0;
    }
    .logo {
        text-align: center;
    }

    .logo img {
        max-width: 100%;
        height: auto;
        border-radius: 50%; /* Optional: Add rounded corners to the logo */
        display: inline-block;
    }

    @media (max-width: 799px) {
        .logo {
            text-align: center;
        }

        .logo img {
            max-width: 20%; /* Adjust the width as needed for smaller screens */
        }
    }

    .stitle {
        text-align: center;
        margin-bottom: 20px;
    }

    .stitle h2 {
        color: white;
        font-size: 1.5em;
        margin-bottom: 5px;
    }

    .stitle h3 {
        color: white;
        font-size: 1.2em;
        margin-top: 0;
    }
    .stitle p {
        color: white;
        font-size: 1.0em;
        margin-top: 0;
    }

    </style>
</head>
<body>
<header class="header">
        <div class="logo">
            <img src="images/tsv logo.jpeg" alt="">
        </div>
        <div class="stitle">
            <h2>The Science Vision</h2>
            <h3>(College Road Madhupur Opposite Badi Anchi Devi high School)</h3>
            <div class="address">

                <p>P.O.:Madhupur, Dist:Deoghar(J.H.), Ph:03434-34343, Mob:9849633811 <br>E-mail: thesciencevision@gmail.com</p>
            </div>
        <div class="board" id="handwritten-text">
            <h1>NOTICE</h1>
            <h2 style="padding-left: 20px;">DATE: <?php echo date('d/m/Y', strtotime($result["date"])); ?></h2>
             
            <h1 style="font-family: cursive;"><?php echo $result["noticetop"];?></h1>
           <h2 style="text-decoration: none; padding-left: 20px; padding-right: 20px;font-family: cursive;"><?php echo $result["notice"];?></h2> 
            
        </div>
</body>
</html>