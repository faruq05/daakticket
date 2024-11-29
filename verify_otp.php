<?php
ob_start();
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_otp = $_POST['otp'];
    $user_id = $_SESSION['user_id'];

    if (!$user_id) {
        $_SESSION['message'] = 'Session expired. Please log in again.';
        $_SESSION['messageType'] = 'error';
        header('Location: login.php');
        exit();
    }

    $query = "SELECT user_otp, reset_token_expires_at FROM User WHERE user_id = $user_id";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) === 1) {
        $user_data = mysqli_fetch_assoc($result);
        $stored_otp_hash = $user_data['user_otp'];
        $otp_expiry = $user_data['reset_token_expires_at'];

        if (new DateTime() > new DateTime($otp_expiry)) {
            $_SESSION['message'] = 'OTP has expired. Please log in again to request a new OTP.';
            $_SESSION['messageType'] = 'error';
            header('Location: login.php');
            exit();
        }

        if (password_verify($user_otp, $stored_otp_hash)) {
            $_SESSION['otp_verified'] = true;
            // Redirect based on the user's role
            if ($_SESSION['role_id'] == 1001) {
                $_SESSION['message'] = "Welcome, Admin " . $_SESSION['username'] . "!";
                $_SESSION['messageType'] = 'success';
                header('Location: admin_dashboard.php');
            } else {
                $_SESSION['message'] = "Welcome, " . $_SESSION['username'] . "!";
                $_SESSION['messageType'] = 'success';
                header('Location: user_dashboard.php');
            }
            exit();
        } else {
            $_SESSION['message'] = 'Invalid OTP. Please try again.';
            $_SESSION['messageType'] = 'error';
        }
    } else {
        $_SESSION['message'] = 'An error occurred. Please try again.';
        $_SESSION['messageType'] = 'error';
    }
}
ob_end_flush(); ?>



<div class="user_access forgot-pass p-0">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-2 col-xl-4"></div>
            <div class="col-md-8 col-xl-4 align-items-center">
                <div class="logIn" id="forgot_password">
                    <h2>2 Factor Authentication</h2>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="otp">Enter your OTP</label>
                            <input type="text" name="otp" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-cs mt-2">Verify</button>
                    </form>
                </div>
                <div class="back-login text-center mt-3">
                    <a href="login.php"><i class="fa-solid fa-arrow-right-to-bracket pe-2"></i>Back to Login</a>
                </div>
            </div>
            <div class="col-md-2  col-xl-4"></div>



        </div>

    </div>
</div>
<?php include 'footer.php'; ?>