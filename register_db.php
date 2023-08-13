<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', '4studies');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, user_name, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $user_name, $email, $password);
        $stmt->execute();
        $stmt->close();
        $conn->close();

        // Redirect to index.html with a success message as a query parameter
        header("Location: index.html?message=Registration%20successful!");
        exit(); // Make sure to exit after sending the redirect header
    }
}
?>
