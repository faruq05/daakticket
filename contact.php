<?php include 'header.php'; ?>
<div class="contactpg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12 text-center">
                <h2>Contact Us</h2>
                <ul class="breadcrumb pt-2">
                    <li><a href="index.php">Home </a></li>
                    <li class="active"><i class="fa-solid fa-angle-right ps-2 pe-2"></i>Contact Us</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- form contact -->
<div class="contactpg_form cp60 ">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2>Get in Touch With Us</h2>
                <form action="sendmail.php" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" required
                            placeholder="Enter your name ...">
                    </div>
                    <div class="form-group">

                        <input type="email" class="form-control" id="email" name="email" required
                            placeholder="Enter your email ...">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="subject" name="subject" required
                            placeholder="What are you looking for ...">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="message" name="message" rows="5" required
                            placeholder="Write your message..."></textarea>
                    </div>
                    <input type="submit" class="btn btn-cs" name="submit-contact-form" id="submit-contact-form"
                        value="Send Message">
                </form>

                

            </div>
            <div class="col-md-6">
                <div class="about_img">
                    <img src="assets/uploads/about-blog.webp" class="img-fluid" alt="about_blog">
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>