<?php
$insert = false;
if (isset($_POST['name'])) {
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "trip";

    // Create a DB connection
    $con = new mysqli($server, $username, $password, $database);

    // Check for connection success
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Prepare and bind the insert statement
    $stmt = $con->prepare("INSERT INTO `trip` (`name`, `age`, `gender`, `email`, `phone`, `other`, `dt`) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $age, $gender, $email, $phone, $desc, $timestamp);

    // Collect post variables
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $desc = $_POST['desc'];
    $timestamp = date('Y-m-d H:i:s'); // Get the current timestamp

    // Execute the query
    if ($stmt->execute()) {
        $insert = true;
    } else {
        echo "ERROR: " . $stmt->error;
    }

    // Close the prepared statement and DB connection
    $stmt->close();
    $con->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:ital,wght@1,1&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <img src="ac.jpg" alt="Anant Classes" class="bg">
    <div class="container">
        <h1>
            Welcome to Anant Classes
        </h1>
        <p>
            Enter your details and submit this form.
        </p>
        <?php
        if ($insert == true){
         echo "<p class='submitMsg'>
            Thanks for submitting your form. We are happy to see you joining us.
        </p>";
        }

        ?>
        <form action="index.php" method="post">
            
            <input  type="text" name="name" id="name" placeholder="Enter your name">
            
            <input  type="text" name="age" id="age" placeholder="Enter your Age">
            
            <input type="text" name="gender" id="gender" placeholder="Enter your gender">
       
            <input  type="email" name="email" id="email" placeholder="Enter your email">

            <input  type="phone" name="phone" id="phone" placeholder="Enter your Phone no.">
    
            <textarea name="desc" id="desc" cols="20" rows="10" placeholder="Enter any other information here"></textarea>
            <button class="btn">Submit</button>
        </form>
    </div>
    <script src="index.js"></script>
</body>
</html>
