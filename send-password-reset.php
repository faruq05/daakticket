<?php
include 'db.php';
$email = $_POST['email'];
$token = bin2hex(random_bytes(16));
$token_hash = hash("sha256", $token);
$expiry = date("Y-m-d H:i:s", time() + 60 * 30);
$sql = "UPDATE user SET reset_token_hash = ?, reset_token_expires_at = ? WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $token_hash, $expiry, $email);
$stmt->execute();
// Check if the update was successful
if ($stmt->affected_rows > 0) {
    $message = "Password reset link has been sent.";
    $messageType = "success";
} else {
    $message = "No user found with this email address";
    $messageType = "error";
}

$stmt->close();
$conn->close();
?>

<!-- Check if there's a message, then create a hidden element to pass data to JavaScript -->
<?php if (!empty($message)): ?>
    <div id="toastMessage" data-message="<?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>"
        data-type="<?php echo $messageType == 'success' ? 'success' : 'danger'; ?>" style="display: none;">
    </div>
<?php endif; ?>

<!-- Toast Structure -->
<div aria-live="polite" aria-atomic="true" class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="toastNotification" class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body"></div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>