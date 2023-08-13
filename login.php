<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = $_POST['name'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', '4studies');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_name = ? AND password = ?");
        $stmt->bind_param("ss", $user_name, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // Successful login
            $_SESSION['user_name'] = $user_name;
            header("Location: dept.html"); // Redirect to the department page
            exit();
        } else {
            // Invalid login credentials
            echo "Invalid username or password";
        }

        $stmt->close();
        $conn->close();
    }
}
?>
