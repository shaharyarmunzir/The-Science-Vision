<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="images/tsv logo.jpeg" type="image/x-icon">
  <title>TSV</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }

    .container {
      width: 300px;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    label {
      display: block;
      margin-bottom: 8px;
    }

    input {
      width: 100%;
      padding: 8px;
      margin-bottom: 16px;
    }

    button {
      background-color: #4caf50;
      color: white;
      padding: 10px 15px;
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
    }
  </style>
  <title>Login Page</title>
</head>
<body>
  <div class="container">
    <h2>Login</h2>
    <form method="post">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
      <button type="submit">Login</button>
      <p id="errorMessage">
       
      </p>
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
          $username = $_POST['username'];
          $password = $_POST['password'];
      
          // Hash the password for security (use a better hashing method in production)
          $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      
          // Prepare and execute a SQL query to insert user credentials
          $stmt = $conn->prepare("INSERT INTO login (username, password) VALUES (?, ?)");
          $stmt->bind_param("ss", $username, $hashedPassword);
      
          if ($stmt->execute()) {
              // Registration successful
              echo "User registered successfully.";
          } else {
              // Registration failed
              echo "Error: " . $stmt->error;
          }
      
          $stmt->close();
      }
      
      $conn->close();
      ?>
      
    </form>
  </div>
</body>
</html>
