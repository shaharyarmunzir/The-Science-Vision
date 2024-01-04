<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSV</title>
    <link rel="icon" href="images/tsv logo.jpeg" type="image/x-icon">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            /* background-image: url("images/4.jpg"); */
            background: linear-gradient(90deg, #141e30 0%, #243b55 100%);

            /* background-color: #f4f4f4; */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #resultForm {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            box-shadow: 0 2px 6px 2px grey;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="button"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="button"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<form id="resultForm">
    <label for="roll_number">Roll Number:</label>
    <input type="text" name="roll_number" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <label for="name">Name:</label>
    <input type="text" name="name" required><br>

    <label for="class">Class:</label>
    <select name="class" required>
        <option value="8">Class 8</option>
        <option value="9">Class 9</option>
        <option value="10">Class 10</option>
        <option value="11">Class 11</option>
        <option value="12">Class 12</option>
        <!-- Add more options as needed -->
    </select><br>

    <label for="board">BOARD:</label>
    <select name="board" required>
        <option value="CBSE">CBSE Board</option>
        <option value="ICSE">ICSE Board</option>
        <option value="JAC">JAC Board</option>
        <!-- Add more options as needed -->
    </select><br>

    <!-- Repeat similar input fields for other columns -->

    <input type="button" value="Submit" onclick="submitForm()">
</form>

<script>
    function submitForm() {
        // Get form data
        var formData = new FormData(document.getElementById("resultForm"));

        // Send form data using Fetch API
        fetch('studentidpaswordgenerator2.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            // Handle the response if needed
            console.log(response);
        })
        .catch(error => {
            // Handle errors
            console.error('Error:', error);
        });
    }
</script>

</body>
</html>
