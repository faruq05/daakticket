<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- stylesheet -->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/media.css">
</head>

<body>
    <!-- header starts========================================= -->
    <!-- search componenet -->
    <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasTopLabel">What are you loooking for ...</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
    <!-- search comp ebds -->

    <div class="header" id="header">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="#"><img src="assets/uploads/logo.png" class="img-fluid" alt="logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Blogs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-search" data-bs-toggle="offcanvas" href="#offcanvasTop" role="button"
                                aria-controls="offcanvasTop">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                        </li>
                        <!-- search -->

                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa-regular fa-user"></i></a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!-- banner starts -->
    <div class="banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="banner-title">
                        <h1>Daak Ticket .</h1>
                        <h2 class="space">Delivering Ideas, Inspiring Minds – A Platform for Knowledge, Stories, and
                            Community
                            Insight"</h2>
                        <a href="blog.php" class="btn btn-cs">Read Our Blogs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- about 0-->
    <div class="about cp60">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="about_title">
                        <h2>About Us</h2>
                        <p class="space">Welcome to DaakTicket – your destination for diverse voices, stories, and
                            insights from
                            around the world. We believe in the power of words to connect, inspire, and inform. Our
                            platform is designed to be a space where anyone can share valuable knowledge, personal
                            stories, and unique perspectives on topics that matter.</p>
                        <div class="ab_btn">
                            <a href="about.php" class="btn btn-cs">Know More About Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <!-- <script src="js/script.js"></script>
    <script src="js/wow.min.js"></script>
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
    </script> -->
</body>

</html>