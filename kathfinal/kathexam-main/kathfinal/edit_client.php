<?php
    // Start session
    session_start();

    // Redirect if not logged in as admin
    if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
        header("Location: index.php");
        exit();
    }

    // Include database connection
    include('db/connection.php');

    // Get the client ID from the URL
    if (isset($_GET['ID'])) {
        $client_id = $_GET['ID'];

        // Fetch the client's current information from the database
        $sql = "SELECT * FROM users WHERE ID = '$client_id' AND role = 'client'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $client = $result->fetch_assoc();
        } else {
            die("Client not found!");
        }
    } else {
        die("Client ID not specified!");
    }

    // Handle form submission to update the balance
    if (isset($_POST['update_balance'])) {
        $new_balance = $_POST['balance'];

        // Update the client's balance in the database
        $update_sql = "UPDATE users SET balance = '$new_balance' WHERE ID = '$client_id'";
        
        if ($conn->query($update_sql) === TRUE) {
            $message = "Balance updated successfully!";
        } else {
            $message = "Error updating balance: " . $conn->error;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Client Balance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .message {
            text-align: center;
            font-size: 16px;
            color: green;
            margin: 15px 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            text-decoration: none;
            color: #007bff;
        }

        .back-link a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Edit Balance for Client: <?php echo $client['firstname'] . " " . $client['lastname']; ?></h2>

        <!-- Display success or error message -->
        <?php if (isset($message)) { ?>
            <div class="message"><?php echo $message; ?></div>
        <?php } ?>

        <form action="" method="post">
            <div class="form-group">
                <label for="balance">Current Balance: ₱<?php echo number_format($client['balance'], 2); ?></label>
            </div>

            <div class="form-group">
                <input type="number" name="balance" id="balance" value="<?php echo $client['balance']; ?>" required step="0.01" min="0">
            </div>

            <input type="submit" name="update_balance" value="Update Balance">
        </form>

        <div class="back-link">
            <a href="admin_dashboard.php">Back to Dashboard</a>
        </div>
    </div>

</body>
</html>
