<?php
ob_start();
include 'header.php'; ?>
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
                            $_SESSION['message'] = "Welcome, " . $_SESSION['username'] . "!";
                            $_SESSION['messageType'] = 'success';
                            // Redirect to user.php after successful login
                            header('Location: user_dashboard.php');
                            exit();
                        } else {
                            // Incorrect password
                            $_SESSION['message'] = 'Incorrect password. Please try again.';
                            $_SESSION['messageType'] = 'error';
                        }
                    } else {
                        // No user found with the provided email
                        $_SESSION['message'] = 'No account found with that email.';
                        $_SESSION['messageType'] = 'error';
                    }

                    $conn->close();
                }
                ob_end_flush();
                ?>


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
                if (isset($_POST["sign_up_submit"])) {
                    $username = $_POST['username'];
                    $firstname = $_POST['first_name'];
                    $lastname = $_POST['last_name'];
                    $email = $_POST['email'];
                    $password = $_POST['password_hash'];
                    $confirmPassword = $_POST['confirmPassword'];

                    // if the username already exists
                    $check_username_query = "SELECT * FROM User WHERE username = '$username'";
                    $check_username_result = mysqli_query($conn, $check_username_query);

                    //  if the email already exists
                    $check_email_query = "SELECT * FROM User WHERE email = '$email'";
                    $check_email_result = mysqli_query($conn, $check_email_query);

                    if (mysqli_num_rows($check_username_result) > 0) {
                        $_SESSION['message'] = "Username already exists. Please choose a different username.";
                        $_SESSION['messageType'] = 'error';
                    } elseif (mysqli_num_rows($check_email_result) > 0) {
                        $_SESSION['message'] = "Email already exists. Please use a different email address.";
                        $_SESSION['messageType'] = 'error';
                    } else {
                        $password_hash = password_hash($password, PASSWORD_DEFAULT);
                        $insert_query = "INSERT INTO User (username, first_name, last_name, email, password_hash) 
                         VALUES ('$username', '$firstname', '$lastname', '$email', '$password_hash')";

                        $result = mysqli_query($conn, $insert_query);

                        if ($result) {
                            $_SESSION['message'] = "User has been registered successfully";
                            $_SESSION['messageType'] = 'success';
                        } else {
                            $_SESSION['message'] = "Failed to register user!";
                            $_SESSION['messageType'] = 'error';
                        }
                    }
                    $conn->close();
                }
                ob_end_flush();
                ?>

            </div>

        </div>
    </div>
</div>

<?php include 'footer.php'; ?>