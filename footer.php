<!-- Share Modal -->
<div class="modal fade" id="shareModal-<?php echo $post['post_id']; ?>" tabindex="-1"
    aria-labelledby="shareModalLabel-<?php echo $post['post_id']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shareModalLabel-<?php echo $post['post_id']; ?>">
                    Share Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center share-social">
                <!-- Share Icons -->
                <div class="d-flex justify-content-around align-items-center">
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('https://daakticket.faruqweb.com/view-post.php?post_id=' . $post['post_id']); ?>"
                        target="_blank" title="Share on Facebook">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <!-- X (Twitter) -->
                    <a href="https://twitter.com/share?url=<?php echo urlencode('https://daakticket.faruqweb.com/view-post.php?post_id=' . $post['post_id']); ?>&text=<?php echo urlencode($post['title']); ?>"
                        target="_blank" title="Share on X">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>
                    <!-- LinkedIn -->
                    <a href="https://www.linkedin.com/shareArticle?url=<?php echo urlencode('https://daakticket.faruqweb.com/view-post.php?post_id=' . $post['post_id']); ?>&title=<?php echo urlencode($post['title']); ?>"
                        target="_blank" title="Share on LinkedIn">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                    <!-- Copy Link -->
                    <div class="copy-link">
                        <form class="copy-form">
                            <input type="hidden"
                                value="https://daakticket.faruqweb.com/view-post.php?post_id=<?php echo $post['post_id']; ?>"
                                readonly>
                            <button type="button" class="copy-button" title="Copy Link"><i
                                    class="fa-solid fa-copy"></i></button>
                        </form>
                    </div>
                    <!-- share to social -->
                    <script>
                        (function () {
                            var copyButton = document.querySelector('.copy-button');
                            var copyInput = document.querySelector('.copy-form input');

                            copyButton.addEventListener('click', function (e) {
                                e.preventDefault();
                                copyInput.select();
                                document.execCommand('copy');
                                alert("Link copied to clipboard!");
                            });
                        })();
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
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
                // session_start();
                if (isset($_POST["subscriber-submit"])) {
                    $email = $_POST['email'];
                    // Check if the subscriber already exists
                    $check_query = "SELECT * FROM subscriber WHERE email = '$email'";
                    $check_result = mysqli_query($conn, $check_query);

                    if (mysqli_num_rows($check_result) > 0) {
                        $_SESSION['message'] = 'You already subsribed with this email address';
                        $_SESSION['messageType'] = 'error';
                    } else {
                        $insert_query = "INSERT INTO subscriber (email) 
                         VALUES ('$email')";

                        $result = mysqli_query($conn, $insert_query);

                        if ($result) {
                            $_SESSION['message'] = 'Thanks for subscribing';
                            $_SESSION['messageType'] = 'success';
                        } else {
                            $_SESSION['message'] = 'Subscription failed, please try again';
                            $_SESSION['messageType'] = 'error';
                        }
                    }
                }
                $conn->close();

                ?>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js"></script>
<script src="assets/js/sidebar-script.js"></script>
<script src="assets/js/script.js"></script>
<script>
<<<<<<< HEAD
    document.addEventListener("DOMContentLoaded", function() {
=======
    document.addEventListener("DOMContentLoaded", function () {
>>>>>>> 284c8231040e7b1ff09e8c8608e3640936917544
        // Initialize Masonry
        var grid = document.querySelector('#masonry-grid');
        new Masonry(grid, {
            itemSelector: '.col-md-4',
            columnWidth: '.col-md-4',
            percentPosition: true
        });
    });
</script>
<?php if (!empty($_SESSION['message'])): ?>
    <script>
        Swal.fire({
            position: "center-middle",
            icon: "<?php echo $_SESSION['messageType']; ?>",
            title: "<?php echo $_SESSION['message']; ?>",
            showConfirmButton: false,
            timer: 3000
        });
    </script>
    <?php
    // Clear message after displaying
    unset($_SESSION['message']);
    unset($_SESSION['messageType']);
    ?>
<?php endif; ?>
<?php if (!empty($_SESSION['message'])): ?>
    <script>
        Swal.fire({
            position: "center-middle",
            icon: "<?php echo $_SESSION['messageType']; ?>",
            title: "<?php echo $_SESSION['message']; ?>",
            showConfirmButton: false,
            timer: 3000
        });
    </script>
    <?php
    // Clear message after displaying
    unset($_SESSION['message']);
    unset($_SESSION['messageType']);
    ?>
<?php endif; ?>


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