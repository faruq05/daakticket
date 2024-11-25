<?php
include 'db.php';
session_start();
$token = $_POST["token"];

$token_hash = hash("sha256", $token);

$sql = "SELECT * FROM user
        WHERE reset_token_hash = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token_hash);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user === null) {
    $_SESSION['message'] = "Token not found.";
    $_SESSION['messageType'] = "error";
    header("Location: forgot_password.php");
    exit;
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    $_SESSION['message'] = "Token has expired.";
    $_SESSION['messageType'] = "error";
    header("Location: forgot_password.php");
    exit;
}

if (strlen($_POST["password"]) < 8) {
    $_SESSION['message'] = "Password must be at least 8 characters.";
    $_SESSION['messageType'] = "error";
    header("Location: reset_password.php?token=$token");
    exit;
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    $_SESSION['message'] = "Password must contain at least one letter.";
    $_SESSION['messageType'] = "error";
    header("Location: reset_password.php?token=$token");
    exit;
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
    $_SESSION['message'] = "Password must contain at least one number.";
    $_SESSION['messageType'] = "error";
    header("Location: reset_password.php?token=$token");
    exit;
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    $_SESSION['message'] = "Passwords must match.";
    $_SESSION['messageType'] = "error";
    header("Location: reset_password.php?token=$token");
    exit;
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$sql = "UPDATE user
        SET password_hash = ?,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $password_hash, $user["user_id"]);
$stmt->execute();

// Set success message and redirect to login page
$_SESSION['message'] = "Password updated successfully. You can now log in.";
$_SESSION['messageType'] = "success";
header("Location: login.php");
exit;
?>