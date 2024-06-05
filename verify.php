<?php
$email = $_GET['email'];
$token = $_GET['token'];
require_once "database.php";

$sql = "UPDATE users SET is_verified = 1 WHERE email = ? AND verification_code = ?";
$stmt = mysqli_stmt_init($conn);

if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "ss", $email, $token);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Email verified successfully. You can now login.";
    } else {
        echo "Invalid verification link.";
    }

    mysqli_stmt_close($stmt);
} else {
    die("Something went wrong");
}
?>