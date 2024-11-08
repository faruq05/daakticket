<?php include 'header.php'; ?>

<div class="user_access forgot-pass p-0">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-2 col-xl-4"></div>
            <div class="col-md-8 col-xl-4 align-items-center">
                <div class="logIn" id="forgot_password">
                    <h2>Forgot Password</h2>
                    <form action="send-password-reset.php" method="POST">
                        <div class="form-group">
                            <label for="email">Enter your email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <button type="submit" name="forgot_password_submit" class="btn btn-cs mt-2">Submit</button>
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