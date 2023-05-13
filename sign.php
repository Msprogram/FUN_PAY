<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ponzi_site"; // replace with your database name
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Get the form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username is already taken
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Display an error message
        echo "Username is already taken. Please choose a different username.";
    } else {
        // Insert the new user into the database
        $sql = "INSERT INTO users (first_name, last_name,phone_number,username, password)
                VALUES ('$first_name', '$last_name','$phone_number','$username', '$password')";

        if (mysqli_query($conn, $sql)) {
            // Display a success message
            echo "User registered successfully. Proceed to Login";
        } else {
            // Display an error message
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>
