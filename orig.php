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
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
      /* background-image: url("images/4.jpg");  */
      background: linear-gradient(90deg, #141e30 0%, #243b55 100%);
      color: white;
      font-weight: bold;
    }

    .container {
      width: 500px;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      /* background-color: #fff; Set a background color for the container */
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow for depth */
      backdrop-filter: blur(8px);
    }

    h2 {
      text-align: center; /* Center the heading */
    }

    label {
      display: block;
      margin-bottom: 8px;
    }

    input {
      width: 100%;
      padding: 8px;
      margin-bottom: 16px;
      box-sizing: border-box; /* Include padding and border in the width */
    }

    button {
      background-color: #4caf50;
      color: white;
      width: 100%;
      padding: 10px 0;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    button:hover {
      background-color: #45a049;
    }

    #errorMessage {
      color: red;
      margin-top: 10px;
      text-align: center; /* Center the error message */
    }
  </style>
  <title>Login Page</title>
</head>
<body>
  <div class="container">
    <h2>Administrator's Login</h2>
    <form method="post">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
      <button type="submit">Login</button>
      <p id="errorMessage">
    
      <?php
// Establish a connection to the MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "science_vision";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username and password from the form
    $enteredUsername = $_POST['username'];
    $enteredPassword = $_POST['password'];

    // Prepare and execute a SQL query to retrieve user credentials
    $stmt = $conn->prepare("SELECT password FROM login WHERE username = ?");
    $stmt->bind_param("s", $enteredUsername);
    $stmt->execute();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();
    $stmt->close();

    // Check if the entered password matches the hashed password in the database
    if (password_verify($enteredPassword, $hashedPassword)) {
        // Passwords match, redirect to the success page
        header("Location: add.html");
        exit();
    } 
    else {
        // Display an error message if invalid credentials
        echo 'Invalid username or password';
    }
}

$conn->close();
?>

      
    </form>
  </div>
</body>
</html>
