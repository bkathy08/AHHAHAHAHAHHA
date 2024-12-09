<?php
// Include the connection file
include('database/connection.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mobile = $_POST['mobile'] ?? null;  // Get the mobile number from the form input

    // Check if mobile number is provided
    if ($mobile) {
        // Sanitize input to prevent SQL injection
        $mobile = $conn->real_escape_string($mobile);

        // Prepare the SQL statement to prevent SQL injection
        $sql = "SELECT * FROM users WHERE num = ?";  // Query to find the user by mobile number
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $mobile);  // Bind the mobile parameter (s for string)

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();  // Get the result of the query

        // Check if a user with the given mobile number exists
        if ($result->num_rows > 0) {
            // If user exists, redirect to the home page
            header('Location: home.php?mobile=' . urlencode($mobile));  // Redirect to home.php with mobile number as a query parameter
            exit();  // Stop further execution after the redirect
        } else {
            // If no user is found, display an error message
            $error_message = "Mobile number not registered. Please sign up.";
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // If mobile number is not provided, display an error message
        $error_message = "Please enter your mobile number.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCash Login</title>
    <link rel="stylesheet" href="gcash.css">  <!-- Include your stylesheet for styling -->
</head>
<body>
    <div class="container">
        <h1 class="text-3xl font-bold mb-6">Welcome to GCash</h1>

        <!-- Display error message if it exists -->
        <?php if (isset($error_message)): ?>
            <div class="error-message text-red-500">
                <p><?php echo $error_message; ?></p>
            </div>
        <?php endif; ?>

        <!-- Form to input the mobile number -->
        <form action="authenticate.php" method="post">
            <div class="flex items-center justify-center mb-4">
                <span class="text-2xl">+63</span>
                <input name="mobile" id="mobileInput" type="text" 
                       class="bg-transparent border-b-2 border-white text-2xl ml-2 outline-none" 
                       placeholder="Enter your mobile number" required />
            </div>
            
            <!-- Submit button to proceed to the next step -->
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-full hover:bg-blue-600">
                Next
            </button>
        </form>

        <!-- Link to sign up page if the user does not have an account -->
        <div class="back-link mt-4">
            <a href="register.php" class="text-white">Don't have an account? Sign up here</a>
        </div>
    </div>
</body>
</html>
