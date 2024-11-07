<?php include 'header.php'; ?>


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
            <button class="btn btn-cs btn-srch" type="submit">Search</button>
        </form>
    </div>
</div>
<!-- search comp ebds -->

<div class="header" id="header">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="assets/uploads/logo.png" class="img-fluid" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
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
                </div>
            </div>
            <!-- about icon -->
            <div class="col-md-2">
                <div class="about_icon">
                    <a href="">
                        <img src="assets/uploads/science.svg" class="img-fluid" alt="sicence-icon">
                        <h4 class="text-center">Technology</h4>
                    </a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="about_icon">
                    <a href="">
                        <img src="assets/uploads/health.svg" class="img-fluid" alt="health-icon">
                        <h4 class="text-center">Health</h4>
                    </a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="about_icon">
                    <a href="">
                        <img src="assets/uploads/food.svg" class="img-fluid" alt="food-icon">
                        <h4 class="text-center">Food</h4>
                    </a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="about_icon">
                    <a href="">
                        <img src="assets/uploads/education.svg" class="img-fluid" alt="education-icon">
                        <h4 class="text-center">Education</h4>
                    </a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="about_icon">
                    <a href="">
                        <img src="assets/uploads/travel.svg" class="img-fluid" alt="travel-icon">
                        <h4 class="text-center">Travel</h4>
                    </a>
                </div>
            </div>
            <div class="col-md-2">
                <div class="about_icon">
                    <a href="">
                        <img src="assets/uploads/more.svg" class="img-fluid" alt="more-icon">
                        <h4 class="text-center">And Many More</h4>
                    </a>
                </div>
            </div>
            <div class="ab_btn mt-5">
                <a href="about.php" class="btn btn-cs">Know More About Us</a>
            </div>
        </div>
    </div>
</div>

<!-- blog starts -->
<div class="blogs cp60">
    <div class="container">
        <div class="row gy-4">
            <div class="about_title">
                <h2>Featured Blogs</h2>
            </div>
            <div class="col-md-4">
                <div class="blog_box">
                    <a href="">
                        <img src="assets/uploads/rocket-catcher-elon-musk.jpg" class="img-fluid"
                            alt="rocket_catcher_elon_musk">
                    </a>
                    <div class="post_title">
                        <div class="author_box d-flex align-items-center pb-2">
                            <i class="fa-solid fa-pen-nib"></i>
                            <p class="ps-2">Tanjid vai</p>
                        </div>
                        <a href="">
                            <h3>SpaceX Starship's Bold Leap: A Game-Changer or a Risk Too Far?</h3>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="blog_box">
                    <a href="">
                        <img src="assets/uploads/rocket-catcher-elon-musk.jpg" class="img-fluid"
                            alt="rocket_catcher_elon_musk">
                    </a>
                    <div class="post_title">
                        <div class="author_box d-flex align-items-center pb-2">
                            <i class="fa-solid fa-pen-nib"></i>
                            <p class="ps-2">Tanjid vai</p>
                        </div>
                        <a href="">
                            <h3>SpaceX Starship's Bold Leap: A Game-Changer or a Risk Too Far?</h3>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="blog_box">
                    <a href="">
                        <img src="assets/uploads/rocket-catcher-elon-musk.jpg" class="img-fluid"
                            alt="rocket_catcher_elon_musk">
                    </a>
                    <div class="post_title">
                        <div class="author_box d-flex align-items-center pb-2">
                            <i class="fa-solid fa-pen-nib"></i>
                            <p class="ps-2">Tanjid vai</p>
                        </div>
                        <a href="">
                            <h3>SpaceX Starship's Bold Leap: A Game-Changer or a Risk Too Far?</h3>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="blog_box">
                    <a href="">
                        <img src="assets/uploads/rocket-catcher-elon-musk.jpg" class="img-fluid"
                            alt="rocket_catcher_elon_musk">
                    </a>
                    <div class="post_title">
                        <div class="author_box d-flex align-items-center pb-2">
                            <i class="fa-solid fa-pen-nib"></i>
                            <p class="ps-2">Tanjid vai</p>
                        </div>
                        <a href="">
                            <h3>SpaceX Starship's Bold Leap: A Game-Changer or a Risk Too Far?</h3>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="blog_box">
                    <a href="">
                        <img src="assets/uploads/rocket-catcher-elon-musk.jpg" class="img-fluid"
                            alt="rocket_catcher_elon_musk">
                    </a>
                    <div class="post_title">
                        <div class="author_box d-flex align-items-center pb-2">
                            <i class="fa-solid fa-pen-nib"></i>
                            <p class="ps-2">Tanjid vai</p>
                        </div>
                        <a href="">
                            <h3>SpaceX Starship's Bold Leap: A Game-Changer or a Risk Too Far?</h3>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="blog_box">
                    <a href="">
                        <img src="assets/uploads/rocket-catcher-elon-musk.jpg" class="img-fluid"
                            alt="rocket_catcher_elon_musk">
                    </a>
                    <div class="post_title">
                        <div class="author_box d-flex align-items-center pb-2">
                            <i class="fa-solid fa-pen-nib"></i>
                            <p class="ps-2">Tanjid vai</p>
                        </div>
                        <a href="">
                            <h3>SpaceX Starship's Bold Leap: A Game-Changer or a Risk Too Far?</h3>
                        </a>
                    </div>
                </div>
            </div>
            <div class="ab_btn mt-5">
                <a href="about.php" class="btn btn-cs">View All Blogs</a>
            </div>
        </div>
    </div>
</div>
<!-- blog ends -->

<?php include 'footer.php'; ?>