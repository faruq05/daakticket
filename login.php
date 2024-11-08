<?php include 'header.php'; ?>

<div class="user_access">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="logIn" id="signInForm">
                    <h2>Already a Member? Sign In</h2>
                    <form action="login.php" method="POST">
                        <div class="form-group">
                            <label for="signInUsername">Username</label>
                            <input type="text" class="form-control" id="signInUsername" name="username" required>
                        </div>
                        <div class="form-group position-relative">
                            <label for="signInPassword">Password</label>
                            <input type="password" class="form-control" id="signInPassword" name="password" required>
                            <i class="fa-regular fa-eye-slash toggle-password" data-toggle="#signInPassword"></i>
                        </div>
                        <div class="form-group">
                            <a href="#">Forgot Password?</a>
                        </div>
                        <button type="submit" name="sign_in_submit" class="btn btn-cs mt-2">Sign In</button>
                    </form>
                </div>
                <div class="cta mt-5">
                    <img src="assets/uploads/logo.png" class="img-fluid" alt="logo">
                    <h2>Join DaakTicket today and become part of a vibrant community of storytellers, thinkers, and
                        learners.</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="logIn register-form" id="signUpForm">
                    <h2>New Here? Create a New Account</h2>
                    <form action="login.php" method="POST">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" id="firstName" name="firstName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="lastName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group position-relative">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                            <i class="fa-regular fa-eye-slash toggle-password" data-toggle="#password"></i>
                        </div>
                        <div class="form-group position-relative">
                            <label for="confirmPassword">Retype Password</label>
                            <input type="password" id="confirmPassword" name="confirmPassword" class="form-control"
                                required>
                            <i class="fa-regular fa-eye-slash toggle-password" data-toggle="#confirmPassword"></i>
                        </div>

                        <div id="passwordCriteria">
                            <p id="lengthCriteria">At least 8 characters</p>
                            <p id="uppercaseCriteria">At least one uppercase letter</p>
                            <p id="numberCriteria">At least one number</p>
                            <p id="specialCriteria">At least one special character</p>
                            <p id="matchCriteria">Passwords must match</p>
                        </div>
                        <button type="submit" name="sign_up_submit" class="btn btn-cs mt-2">Sign In</button>
                    </form>
                </div>
                <?php
                $message = "";
                $messageType = "";

                if (isset($_POST["sign_up_submit"])) {
                    $username = $_POST['username'];
                    $firstName = $_POST['firstName'];
                    $lastName = $_POST['lastName'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $confirmPassword = $_POST['confirmPassword'];

                    // Check if the username already exists
                    $check_query = "SELECT * FROM User WHERE username = '$username'";
                    $check_result = mysqli_query($conn, $check_query);

                    if (mysqli_num_rows($check_result) > 0) {
                        $message = "Username already exists. Please choose a different username.";
                        $messageType = "error";
                    } else {
                        $password_hash = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security
                        $insert_query = "INSERT INTO User (username, first_name, last_name, email, password_hash) 
                         VALUES ('$username', '$first_name', '$last_name', '$email', '$password_hash')";

                        $result = mysqli_query($conn, $insert_query);

                        if ($result) {
                            $message = "User has been registered successfully";
                            $messageType = "success";
                        } else {
                            $message = "Failed to register user!";
                            $messageType = "error";
                        }
                    }
                    $conn->close();
                }
                ?>

            </div>

            <!-- Bootstrap Toast for Notifications -->
            <div aria-live="polite" aria-atomic="true" class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                <div id="toastNotification"
                    class="toast align-items-center text-bg-<?php echo $messageType == 'success' ? 'success' : 'danger'; ?>"
                    role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            <?php echo $message; ?>
                        </div>
                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>