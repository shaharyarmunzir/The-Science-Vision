<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSV</title>
    <link rel="icon" href="images/tsv logo.jpeg" type="image/x-icon">
    <style>
*{
   
    font-family: 'Jost', sans-serif;
}

.header{
    position: relative;
    top: 0;
    margin-bottom: 20%;
    height: 28vh;
    width:100%;
    background-image: linear-gradient(rgb(7, 1, 65), #060277);
}



.header h1,h3{
    justify-content: center;
    color: white;
    display: flex;
    top: 10px;
    position: relative;
}


.header .logo img{
    height: 100px;
    width:100px;
    display: flex;
    position: absolute;
    margin: 25px 40px;
}
.address p{
    color: white;
    top: 10px;
    position: relative;
    text-align: center;
    width:40%;
    margin: auto;
}



















    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #007BFF; /* Change the title color */
    }

    form {
        text-align: center;
    }

    input[type="text"],
    input[type="file"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    input[type="submit"] {
        background-color: #007BFF;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 3px;
        cursor: pointer;
    }

    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    table th,
    table td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: center; /* Center-align text in table cells */
    }

    table th {
        background-color: #f2f2f2;
    }

    img {
        max-width: 100px;
        max-height: 100px;
        display: block; /* Add spacing around images */
        margin: 0 auto;
    }

    /* Style the edit form inputs */
    input[type="text"]:not([name="new_username"]),
    input[type="file"]:not([name="new_image"]) {
        background-color: #f2f2f2;
    }

    /* Style the edit form submit button */
    input[name="edit_submit"] {
        background-color: #28a745; /* Change button color for editing */
    }
</style>
<style>
    @media (max-width: 480px) {
        .header {
            height: 15vh;
        }

        .header h1, .header h3 {
            font-size: 24px;
        }

        .container {
            padding: 10px;
        }

        h1 {
            font-size: 24px;
        }

        form {
            text-align: left;
        }

        input[type="text"],
        input[type="file"] {
            width: 90%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            padding: 6px 14px;
        }

        table th, table td {
            padding: 6px;
        }

        img {
            max-width: 60px;
            max-height: 60px;
        }
    }
</style>

</head>

<body>
    <header class="header">
    <div class="container">
        
        <table>
            <thead>
                <th>ID</th>
                <th>User Name</th>
                <th>Percentage %</th>
                <th>Profile Pic</th>
                <th>Option</th>
            </thead>
            <tbody>
                <?php
                $con = mysqli_connect('localhost', 'root', '', 'displayupload');
                if (!$con) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                if (isset($_POST['submit'])) {
                    $username = $_POST['username'];
                    $files = $_FILES['file'];

                    $filename = $files['name'];
                    $fileerror = $files['error'];
                    $filetmp = $files['tmp_name'];

                    $fileext = explode('.', $filename);
                    $filecheck = strtolower(end($fileext));

                    $fileextstored = array('png', 'jpg', 'jpeg');

                    if (in_array($filecheck, $fileextstored)) {
                        $destinationfile = 'upload/' . $filename;
                        move_uploaded_file($filetmp, $destinationfile);

                        $sql = "INSERT INTO `imgupload`(`username`, `image`) VALUES ('$username', '$destinationfile')";
                        $result = mysqli_query($con, $sql);
                    }
                }

                if (isset($_POST['edit_submit'])) {
                    $edited_id = $_POST['edited_id'];
                    $new_username = $_POST['new_username'];
                    $new_percentage = $_POST['new_percentage'];
                    $new_image = $_FILES['new_image'];

                    $filename = $new_image['name'];
                    $filetmp = $new_image['tmp_name'];
                    $fileext = explode('.', $filename);
                    $filecheck = strtolower(end($fileext));
                    $fileextstored = array('png', 'jpg', 'jpeg');

                    if (in_array($filecheck, $fileextstored)) {
                        $destinationfile = 'upload/' . $filename;
                        move_uploaded_file($filetmp, $destinationfile);

                        // Update the user's information in the database
                        $sql = "UPDATE `imgupload` SET `username`='$new_username', `percantage`='$new_percentage', `image`='$destinationfile' WHERE `id`='$edited_id'";
                        $result = mysqli_query($con, $sql);
                    }
                }

                $displayquery = "SELECT * FROM imgupload";
                $querydisplay = mysqli_query($con, $displayquery);

                while ($row = mysqli_fetch_assoc($querydisplay)) {
                ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['percantage']; ?></td>
                        <td><img src="<?php echo $row['image']; ?>" width="100" height="100"></td>
                        <td>
                            <form method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="edited_id" value="<?php echo $row['id']; ?>">
                                <input type="text" name="new_username" placeholder="New Username">
                                <input type="text" name="new_percentage" placeholder="New Percentage">
                                <input type="file" name="new_image">
                                <!-- <input type="submit" name="edit_submit" value="Edit"> -->
                                <input type="submit" name="edit_submit" value="Edit" onclick="return confirmAction('edit');">

                            </form>
                        </td>
                    </tr>
                <?php
                
                }
                ?>
             
                
                
           
            </tbody>
        </table>
    </div>



    
</body>

</html>
<script>
    function confirmAction(actionType) {
        var message = "";
        if (actionType === 'edit') {
            message = "Are you sure you want to edit this user?";
        } else if (actionType === 'delete') {
            message = "Are you sure you want to delete this user?";
        }
        return confirm(message);
    }
</script>
