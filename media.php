<?php
include 'header.php';
include 'sidebar.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all media records from the media table
$query = "SELECT * FROM media ORDER BY uploaded_at DESC";
$result = mysqli_query($conn, $query);

?>

<div class="main dashboard">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12 cp60" id="profile">
                <div class="dash">
                    <h1 class="text-center mt-4">Media Gallery</h1>
                    <p class="text-center">Explore all uploaded media files.</p>

                    <div class="gallery">
                    <?php
                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($media = mysqli_fetch_assoc($result)) {
                                $file_path = $media['file_path'];

                                echo '<div class="gallery-item">';
                                echo "<img src='$file_path' alt='Media' class='img-fluid'>";
                                echo '</div>';
                            }
                        } else {
                            echo "<p class='text-center'>No media files found.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>