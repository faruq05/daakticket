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
                        <button type="submit" class="btn btn-cs mt-2">Sign In</button>
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
                    <form action="register.php" method="POST">
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
                        <button type="submit" class="btn btn-cs mt-2">Sign In</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>