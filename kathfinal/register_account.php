<?php
// Include database connection file
include('database/connection.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $mpin = $_POST['mpin'];
    $role = $_POST['role'];  // 'client' or 'admin'

    // Hash the password and MPIN
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $hashed_mpin = password_hash($mpin, PASSWORD_DEFAULT);

    // Prepare the SQL insert statement
    $sql = "INSERT INTO users (firstname, lastname, phone_number, email, password, role, balance, mpin, created_at) 
            VALUES ('$firstname', '$lastname', '$phone_number', '$email', '$hashed_password', '$role', 0.00, '$hashed_mpin', NOW())";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect to login page after successful registration
        header("Location: index.php?message=Registration successful! Please log in.");
        exit();
    } else {
        // If query fails, show an error message
        header("Location: register.php?message=Error during registration.");
        exit();
    }
}
?>
