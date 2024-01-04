<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TSV Result Portal</title>
  <link rel="icon" href="images/tsv logo.jpeg" type="image/x-icon">
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      /* background-image: url("images/2.jpg"); */
      background: linear-gradient(90deg, #141e30 0%, #243b55 100%);

      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: #ffffff;
    }

    .container {
      width: 500px;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(8px);
    }

    form {
      margin-top: 20px;
      display: flex;
      flex-direction: column;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 16px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .password-toggle {
      display: flex;
      align-items: center;
      margin-bottom: 16px;
    }

    .password-toggle label {
      margin-left: 5px;
      color: #ffffff;
      cursor: pointer;
    }

    input[type="checkbox"] {
      margin-right: 5px;
    }

    .button {
      padding: 12px;
      background-color: #3498db;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .button:hover {
      background-color: #2980b9;
    }

    h2 {
      text-align: center;
      color: #ffffff;
    }

    input[type="checkbox"]:checked + label {
      color: #2980b9;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Student's Login</h2>
    <form action="attaa.php" method="post">
      <label for="roll_number">Roll Number:</label>
      <input type="text" id="roll_number" name="roll_number" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <div class="password-toggle">
        <input type="checkbox" id="showPassword">
        <label for="showPassword">Show Password</label>
      </div>

      <input type="submit" class="button" value="Login">
    </form>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var passwordInput = document.getElementById("password");
      var showPasswordCheckbox = document.getElementById("showPassword");

      showPasswordCheckbox.addEventListener("change", function () {
        if (showPasswordCheckbox.checked) {
          passwordInput.type = "text";
        } else {
          passwordInput.type = "password";
        }
      });
    });
  </script>
</body>
</html>
