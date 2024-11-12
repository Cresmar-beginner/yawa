<?php
if (isset($_POST['submit'])) {
    $servername = "localhost";
    $username = "root"; // Replace with your DB username
    $password = "";     // Replace with your DB password
    $dbname = "user_data";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, middle_name, age, address) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssds", $first_name, $last_name, $middle_name, $age, $address);

    // Set parameters and execute
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_name = $_POST['middle_name'];
    $age = $_POST['age'];
    $address = $_POST['address'];

    if ($stmt->execute()) {
        echo "<div style='text-align: center; color: green;'>New record created successfully</div>";
    } else {
        echo "<div style='text-align: center; color: red;'>Error: " . $stmt->error . "</div>";
    }

    // Close connections
    $stmt->close();
    $conn->close();
} else {
    header("Location: html.php");
    exit();
}
?>