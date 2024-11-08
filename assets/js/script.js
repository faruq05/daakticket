document.addEventListener("DOMContentLoaded", function () {
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirmPassword");
    const passwordCriteria = document.getElementById("passwordCriteria");

    // Criteria Elements
    const lengthCriteria = document.getElementById("lengthCriteria");
    const uppercaseCriteria = document.getElementById("uppercaseCriteria");
    const numberCriteria = document.getElementById("numberCriteria");
    const specialCriteria = document.getElementById("specialCriteria");
    const matchCriteria = document.getElementById("matchCriteria");

    // Show criteria when typing in the password field
    password.addEventListener("focus", () => {
        passwordCriteria.style.display = "block";
    });

    // Helper function to toggle password visibility
    function setupPasswordToggle() {
        document.querySelectorAll(".toggle-password").forEach(icon => {
            icon.addEventListener("click", function () {
                const targetSelector = this.getAttribute("data-toggle");
                const passwordField = document.querySelector(targetSelector);

                if (passwordField.getAttribute("type") === "password") {
                    passwordField.setAttribute("type", "text");
                    this.classList.replace("fa-eye-slash", "fa-eye");
                } else {
                    passwordField.setAttribute("type", "password");
                    this.classList.replace("fa-eye", "fa-eye-slash");
                }
            });
        });
    }

    // Validate password criteria in real-time
    function validatePassword() {
        const passwordValue = password.value;

        // At least 8 characters
        if (passwordValue.length >= 8) {
            lengthCriteria.classList.add("valid");
        } else {
            lengthCriteria.classList.remove("valid");
        }

        // At least one uppercase letter
        if (/[A-Z]/.test(passwordValue)) {
            uppercaseCriteria.classList.add("valid");
        } else {
            uppercaseCriteria.classList.remove("valid");
        }

        // At least one number
        if (/\d/.test(passwordValue)) {
            numberCriteria.classList.add("valid");
        } else {
            numberCriteria.classList.remove("valid");
        }

        // At least one special character
        if (/[!@#$%^&*(),.?":{}|<>]/.test(passwordValue)) {
            specialCriteria.classList.add("valid");
        } else {
            specialCriteria.classList.remove("valid");
        }

        // Check if passwords match
        if (passwordValue && passwordValue === confirmPassword.value) {
            matchCriteria.classList.add("valid");
        } else {
            matchCriteria.classList.remove("valid");
        }
    }

    // Event listeners for validation
    password.addEventListener("input", validatePassword);
    confirmPassword.addEventListener("input", validatePassword);

    // Initialize password toggle
    setupPasswordToggle();
});


// Display the toast if there's a message from PHP
const message = "<?php echo $message; ?>";
if (message) {
    const toastElement = document.getElementById('toastNotification');
    const toast = new bootstrap.Toast(toastElement);
    toast.show();
}