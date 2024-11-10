<?php include 'header.php'; ?>
<div class="user_access">
    <div class="container">
        <div class="row">

            <!-- login form -->
            <div class="col-md-6">
                <div class="logIn" id="signInForm">
                    <h2>Already a Member? Sign In</h2>
                    <form action="login.php" method="POST">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group position-relative">
                            <label for="signInPassword">Password</label>
                            <input type="password" class="form-control" id="signInPassword" name="password_hash"
                                required>
                            <i class="fa-regular fa-eye-slash toggle-password" data-toggle="#signInPassword"></i>
                        </div>
                        <div class="form-group">
                            <a href="forgot_password.php">Forgot Password?</a>
                        </div>
                        <button type="submit" name="sign_in_submit" class="btn btn-cs mt-2">Sign In</button>
                    </form>
                </div>


                <!-- login php code here -->
                <?php

                $message = "";
                $messageType = "";

                if (isset($_POST["sign_in_submit"])) {
                    $email = $_POST['email'];
                    $password = $_POST['password_hash'];

                    // Query to check if the user exists with the provided email
                    $query_in = "SELECT user_id, username, email, password_hash FROM User WHERE email = '$email'";
                    $result = mysqli_query($conn, $query_in);

                    if (mysqli_num_rows($result) === 1) {
                        $user = mysqli_fetch_assoc($result);

                        // Verify the hashed password
                        if (password_verify($password, $user['password_hash'])) {
                            // Set session variables for the logged-in user
                            $_SESSION['user_id'] = $user['user_id'];
                            $_SESSION['username'] = $user['username'];
                            $_SESSION['email'] = $user['email'];

                            // Set a successful login message
                            $message = "Welcome, " . $_SESSION['username'] . "!";
                            $messageType = "success";
                        } else {
                            // Incorrect password
                            $message = "Incorrect password. Please try again.";

                        }
                    } else {
                        // No user found with the provided email
                        $message = "No account found with that email.";
                        $messageType = "error";
                    }

                    $conn->close();
                }
                ?>

                <!-- logout here -->
                <?php
                // Check if the user is logged in
                if (isset($_SESSION['user_id'])): ?>
                    <!-- Logout Button -->
                    <form action="logout.php" method="POST">
                        <button type="submit" name="logout" class="btn btn-danger mt-2">Logout</button>
                    </form>
                <?php else: ?>
                    <!-- Login or Register Forms Go Here (Already included in your original code) -->
                <?php endif; ?>

                <!-- Display message if available -->
                <?php if (!empty($message)): ?>
                    <div id="toastMessage" data-message="<?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>"
                        data-type="<?php echo $messageType == 'success' ? 'success' : 'danger'; ?>" style="display: none;">
                    </div>
                <?php endif; ?>

                
                <div class="cta mt-5">
                    <img src="assets/uploads/logo.png" class="img-fluid" alt="logo">
                    <h2>Join DaakTicket today and become part of a vibrant community of storytellers, thinkers, and
                        learners.</h2>
                </div>
            </div>

            <!-- registration form -->
            <div class="col-md-6">
                <div class="logIn register-form" id="signUpForm">
                    <h2>New Here? Create a New Account</h2>
                    <form action="login.php" method="POST">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" id="first_name" name="first_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group position-relative">
                            <label for="password_hash">Password</label>
                            <input type="password" id="password" name="password_hash" class="form-control" required>
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
                        <button type="submit" name="sign_up_submit" class="btn btn-cs mt-2">Register</button>
                    </form>
                </div>

                <!-- registration php code here  -->
                <?php
                ob_start();
                $message = "";
                $messageType = "";

                if (isset($_POST["sign_up_submit"])) {
                    $username = $_POST['username'];
                    $firstname = $_POST['first_name'];
                    $lastname = $_POST['last_name'];
                    $email = $_POST['email'];
                    $password = $_POST['password_hash'];
                    $confirmPassword = $_POST['confirmPassword'];

                    // Check if the username already exists
                    $check_query = "SELECT * FROM User WHERE username = '$username'";
                    $check_result = mysqli_query($conn, $check_query);

                    if (mysqli_num_rows($check_result) > 0) {
                        $message = "Username already exists. Please choose a different username.";
                        $messageType = "error";
                    } else {
                        $password_hash = password_hash($password, PASSWORD_DEFAULT);
                        $insert_query = "INSERT INTO User (username, first_name, last_name, email, password_hash) 
                         VALUES ('$username', '$firstname', '$lastname', '$email', '$password_hash')";

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
                ob_end_flush();
                ?>

            </div>

            <!-- Check if there's a message, then create a hidden element to pass data to JavaScript -->
            <?php if (!empty($message)): ?>
                <div id="toastMessage" data-message="<?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>"
                    data-type="<?php echo $messageType == 'success' ? 'success' : 'danger'; ?>" style="display: none;">
                </div>
            <?php endif; ?>

            <!-- Toast Structure -->
            <div aria-live="polite" aria-atomic="true" class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                <div id="toastNotification" class="toast align-items-center" role="alert" aria-live="assertive"
                    aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body"></div>
                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<?php include 'footer.php'; ?>