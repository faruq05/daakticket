<?php
include 'header.php';
include 'db.php';
session_start();
$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$sql = "SELECT * FROM user
        WHERE reset_token_hash = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("token has expired");
}

?>

<div class="user_access forgot-pass p-0">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-2 col-xl-4"></div>
            <div class="col-md-8 col-xl-4 align-items-center">
                <div class="logIn" id="forgot_password">
                    <h2>Reset Password</h2>
                    <form action="process-reset-password.php" method="POST">
                        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

                        <div class="form-group position-relative">
                            <label for="password">Enter New Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                            <i class="fa-regular fa-eye-slash toggle-password" data-toggle="#password"></i>
                        </div>

                        <div class="form-group position-relative">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" id="confirmPassword" name="password_confirmation"
                                class="form-control" required>
                            <i class="fa-regular fa-eye-slash toggle-password" data-toggle="#confirmPassword"></i>
                        </div>

                        <!-- Password Criteria Display -->
                        <div id="passwordCriteria" style="display: none; margin-top: 1em;">
                            <p id="lengthCriteria" class="invalid">At least 8 characters</p>
                            <p id="uppercaseCriteria" class="invalid">At least one uppercase letter</p>
                            <p id="numberCriteria" class="invalid">At least one number</p>
                            <p id="specialCriteria" class="invalid">At least one special character</p>
                            <p id="matchCriteria" class="invalid">Passwords must match</p>
                        </div>

                        <button type="submit" name="confirm_password_submit" class="btn btn-cs mt-2">Submit</button>
                    </form>
                    <script src="assets/js/script.js"></script>
                </div>
                <div class="back-login text-center mt-3">
                    <a href="login.php"><i class="fa-solid fa-arrow-right-to-bracket pe-2"></i>Back to Login</a>
                </div>
            </div>
            <div class="col-md-2  col-xl-4"></div>



        </div>

    </div>
</div>