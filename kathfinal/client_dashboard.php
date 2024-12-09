<?php
    // Start Session
    session_start();

    if(!isset($_SESSION['username']) || $_SESSION['role'] != 'client') {
        header("Location: index.php");
        exit();
    }

    // Include connection string
    include('db/connection.php');

    // Fetch user's balance from the database
    $username = $_SESSION['username'];
    $sql = "SELECT balance FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    $balance = 0.00; 
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $balance = $row['balance'];
    }

    // Logout
    if (isset($_GET['logout'])) {
        session_destroy();
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
    <style>
  body { 
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #FFC0CB, #9B59B6);
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 50px auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #9B59B6;
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 20px;
}

.client-name {
    text-align: center;
    font-size: 24px;
    color: #FF69B4; 
    font-weight: bold;
    margin-top: 20px;
}

.balance-header {
    font-size: 20px;
    color: #9B59B6;
    margin-bottom: 10px;
    font-weight: bold;
}

.balance {
    text-align: center;
    font-size: 36px;
    color: #FF69B4; 
    font-weight: bold;
    margin-top: 10px;
}

.logout {
    display: block;
    text-align: right;
    font-size: 14px;
    margin-top: 30px;
}

.logout a {
    color: #9B59B6;
    text-decoration: none;
    font-weight: bold;
    padding: 5px 10px;
    border: 2px solid #9B59B6;
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
}

.logout a:hover {
    color: white;
    background-color: #9B59B6;
    border-color: #9B59B6;
}
    </style>
</head>
<body>

    <div class="container">
        <h2>Welcome to your Dashboard, <?php echo $_SESSION['phone_number']; ?></h2>

        <div class="balance">
            <h3>Your Current Balance: </h3>
            <p>₱ <?php echo number_format($balance, 2); ?></p>
        </div>

        <div class="logout">
            <a href="?logout=true">Logout</a>
        </div>
    </div>

</body>
</html>
