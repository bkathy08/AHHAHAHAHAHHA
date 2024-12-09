<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer  Money</title>
</head>
<body>
<form action="transfer.php" method="POST">

        <label for="toPhone"> Phone Number:</label>
        <input type="text" name="toPhone" required><br><br>
        <label for="amount">Amount:</label>
        <input type="number" name="amount" step="0.01" required><br><br>
        <button type="submit">Transfer</button>
    </form>
    
<?php
// Database connection
$conn = mysqli_connect($servername,$phone_number, $amount, $balance, $transfer_db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to transfer money
function transferMoney($fromPhone, $toPhone, $amount) {
    global $conn;

    // Check for invalid amount
    if ($amount <= 0) {
        return "Invalid amount.";
    }


    // Get recipient's account
    $recipientQuery = "SELECT * FROM users WHERE phone = '$toPhone'";
    $recipientResult = mysqli_query($conn, $recipientQuery);
    $recipient = mysqli_fetch_assoc($recipientResult);

    if (!$recipient) {
        return "Recipient not found.";
    }

    // Update balances
    $newSenderBalance = $sender['balance'] - $amount;
    $newRecipientBalance = $recipient['balance'] + $amount;

    $updateSenderQuery = "UPDATE users SET balance = $newSenderBalance WHERE phone = '$fromPhone'";
    $updateRecipientQuery = "UPDATE users SET balance = $newRecipientBalance WHERE phone = '$toPhone'";

    if (mysqli_query($conn, $updateSenderQuery) && mysqli_query($conn, $updateRecipientQuery)) {
        return "Transaction successful! Transferred $amount to $toPhone.";
    } else {
        return "Transaction failed: " . mysqli_error($conn);
    }
}

// Example usage
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fromPhone = $_POST['fromPhone'];
    $toPhone = $_POST['toPhone'];
    $amount = $_POST['amount'];

    echo transferMoney($fromPhone, $toPhone, $amount);
}

mysqli_close($conn);
?>
</body>
</html>
