<?php
// Start the session
session_start();

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
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username and password are valid
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    // If the query returns a row, the login is successful
    if (mysqli_num_rows($result) == 1) {
        // Set session variables and redirect to the dashboard page
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
    } else {
        // Display an error message
        echo "Invalid username or password";
    }
}

// Close the database connection
mysqli_close($conn);
?>
