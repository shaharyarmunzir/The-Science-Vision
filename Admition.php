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
      background-color: #f4f4f4;
      margin-top: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .container {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      opacity: 0;
      animation: fadeIn 1s ease-in-out forwards;
      width: 80%;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }

    form {
      width: 100%;
      margin: 0 auto;
    }

    h2 {
      text-align: center;
      color: rgb(25, 185, 25);
      text-decoration: underline;
    }

    label {
      display: block;
      margin-bottom: 8px;
      color: #333;
    }

    input,
    select,
    button {
      width: 100%;
      padding: 10px;
      margin-bottom: 16px;
      box-sizing: border-box;
      border: 1px solid #ddd;
      border-radius: 4px;
      transition: border-color 0.3s ease;
    }

    input:focus,
    select:focus {
      border-color: #007bff;
    }

    select,
    button {
      background-color: #007bff;
      color: #fff;
      cursor: pointer;
    }

    select:hover,
    button:hover {
      background-color: #0056b3;
    }

    button {
      border: none;
      transition: background-color 0.3s ease;
    }

    button:disabled,
    button[disabled] {
      background-color: #ccc;
      cursor: not-allowed;
    }

    button:disabled:hover,
    button[disabled]:hover {
      background-color: #ccc;
    }

    @media screen and (max-width: 600px) {
      form {
        width: 100%;
      }
    }
  </style>

  <script>
    function validateForm() {
      var name = document.forms["admissionForm"]["name"].value;
      var email = document.forms["admissionForm"]["email"].value;
      var phone = document.forms["admissionForm"]["phone"].value;
      var course = document.forms["admissionForm"]["course"].value;
      var fathersName = document.forms["admissionForm"]["fathers_name"].value;
      var address = document.forms["admissionForm"]["address"].value;
      var fathersPhone = document.forms["admissionForm"]["fathers_phone"].value;
      var schoolName = document.forms["admissionForm"]["school_name"].value;
      var board = document.forms["admissionForm"]["board"].value;
      var dob = document.forms["admissionForm"]["dob"].value;

      // Basic validation, you can enhance this as needed
      if (
        name === "" ||
        name.length < 4 || // Check if name has less than 4 characters
        !isNaN(name) ||
        email === "" ||
        phone === "" ||
        isNaN(phone) ||
        phone.length !== 10 || // Check if phone is not 10 digits
        course === "" ||
        fathersName === "" ||
        address === "" ||
        fathersPhone === "" ||
        isNaN(fathersPhone) ||
        fathersPhone.length !== 10 || // Check if fathersPhone is not 10 digits
        schoolName === "" ||
        board === "" ||
        dob === ""
      ) {
        // Displaying error messages on the form
        var errorMessage = "Please correct the following errors:\n";
        if (name === "" || name.length < 4) {
          errorMessage += "- Name must be at least 4 characters.\n";
        }
        if (isNaN(name)) {
          errorMessage += "- Name should not contain numbers.\n";
        }
        if (phone === "" || isNaN(phone) || phone.length !== 10) {
          errorMessage += "- Phone must be a 10-digit number.\n";
        }
        if (isNaN(fathersPhone) || fathersPhone.length !== 10) {
          errorMessage += "- Father's Phone must be a 10-digit number.\n";
        }

        alert(errorMessage);
        return false;
      }

      // Add more specific validation rules if needed (e.g., regex for email)

      return true;
    }
  </script>

  <title>Tuition Admission Form</title>
</head>
<body>
  <div class="container">
    <form name="admissionForm" action="" method="post" onsubmit="return validateForm()">
      <h2>Tuition Admission Form</h2>

      <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "science_vision";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $name = mysqli_real_escape_string($conn, $_POST['name']);
          $email = mysqli_real_escape_string($conn, $_POST['email']);
          $phone = mysqli_real_escape_string($conn, $_POST['phone']);
          $course = mysqli_real_escape_string($conn, $_POST['course']);
          $fathers_name = mysqli_real_escape_string($conn, $_POST['fathers_name']);
          $address = mysqli_real_escape_string($conn, $_POST['address']);
          $fathers_phone = mysqli_real_escape_string($conn, $_POST['fathers_phone']);
          $school_name = mysqli_real_escape_string($conn, $_POST['school_name']);
          $board = mysqli_real_escape_string($conn, $_POST['board']);
          $dob = mysqli_real_escape_string($conn, $_POST['dob']);

          $sql = "INSERT INTO the_science_vision_mdp (`name`, `email`, `phone`, `cource`, `fathers_name`, `address`, `fathers_phone`, `school_name`, `board`, `dob`)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

          $stmt = $conn->prepare($sql);
          $stmt->bind_param("ssisssssss", $name, $email, $phone, $course, $fathers_name, $address, $fathers_phone, $school_name, $board, $dob);

          if ($stmt->execute()) {
            echo "Form submitted successfully!";
          } else {
            echo "Error: " . $stmt->error;
          }

          $stmt->close();
        }

        $conn->close();
      ?>

      <label for="name">Name:</label>
      <input type="text" name="name" required>

      <label for="email">Email:</label>
      <input type="email" name="email" required>

      <label for="phone">Phone:</label>
      <input type="tel" name="phone" required>

      <label for="course">Course:</label>
      <select name="course" required>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
      </select>

      <label for="fathers_name">Father's Name:</label>
      <input type="text" name="fathers_name" required>

      <label for="address">Address:</label>
      <input type="text" name="address" required>

      <label for="fathers_phone">Father's Phone:</label>
      <input type="tel" name="fathers_phone" required>

      <label for="school_name">School Name:</label>
      <input type="text" name="school_name" required>

      <label for="board">Board:</label>
      <select name="board" required>
        <option value="CBSE">CBSE</option>
        <option value="ICSE">ICSE</option>
        <option value="State Board">State Board</option>
      </select>

      <label for="dob">Date of Birth:</label>
      <input type="date" name="dob" required>

      <button type="submit" style="background-color: rgb(25, 185, 25);">Submit</button>
    </form>
  </div>
</body>
</html>
