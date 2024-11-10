<!-- footer starts-->
<div class="footer cp60" id="footer">
    <div class="container">
        <div class="row justify-content-space-between">
            <div class="col-md-6">
                <div class="contact_title">
                    <h3>
                        Subscribe now and let the DaakTicket come to you!
                    </h3>
                    <p>Don’t miss out on the latest insights, stories, and tips shared by our vibrant community!
                    </p>
                </div>
            </div>
            <div class="col-md-5">
                <div class="subscribe-form">
                    <form action="index.php" method="POST">
                        <input type="email" id="email" name="email" placeholder="Enter your email address"
                            class="form-control" required>
                        <button type="submit" class="btn btn-cs" name="subscriber-submit">
                            Subscribe <i class="fa-regular fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
                <!-- subscriber php here -->
                <?php
                include 'db.php';
                $message = "";
                $messageType = "";
                if (isset($_POST["subscriber-submit"])) {
                    $email = $_POST['email'];
                    // Check if the subscriber already exists
                    $check_query = "SELECT * FROM subscriber WHERE email = '$email'";
                    $check_result = mysqli_query($conn, $check_query);

                    if (mysqli_num_rows($check_result) > 0) {
                        $message = "You already subsribed with this email address";
                        $messageType = "error";
                    } else {
                        $insert_query = "INSERT INTO subscriber (email) 
                         VALUES ('$email')";

                        $result = mysqli_query($conn, $insert_query);

                        if ($result) {
                            $message = "Thanks for subscribing";
                            $messageType = "success";
                        } else {
                            $message = "Subscription failed, please try again";
                            $messageType = "error";
                        }
                    }
                }
                $conn->close();

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

            <div class="col-md-6 pt-5">
                <div class="social_icon">
                    <a href="facebook.com"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="facebook.com"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="facebook.com"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-md-6 pt-5">
                <div class="copyright text-end">
                    <p>
                        &copy; 2024 DaakTicket. All Rights Reserved. Developed By <a href="">Group 05</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="assets/js/script.js"></script>

<!-- <script src="js/wow.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <script>
        $(document).ready(function () {
            $(".owl-carousel").owlCarousel(
                {
                    items: 1,
                    loop: true,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    smartSpeed: 500,
                    margin: 20,
                    nav: true,
                    dots: false,
                    touchDrag: true,
                    mouseDrag: true,
                    autoplayHoverPause: true,
                    navText: ["<i class='fa-solid fa-arrow-left'></i>", "<i class='fa-solid fa-arrow-right'></i>"],
                    responsive: {
                        0: {
                            items: 1,
                        },
                        425: {
                            items: 1,
                        },
                        767: {
                            items: 1,
                        },
                        768: {
                            items: 1,
                        },


                    }
                }
            );

        });
    </script>  -->
</body>

</html>