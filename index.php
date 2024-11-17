<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BarBerBuy | Home</title>

    <!-- Bootstrap and Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <img src="assets/barber.jpg" alt="Barber" style="width: 80px; height: auto;">
            <span class="fs-4">BarBerBuy</span>
        </a>
        <?php if ($_SESSION): ?>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pasien/pasien.php">Pasien</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dokter/dokter.php">Dokter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kamar/kamar.php">Kamar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal">Logout</a>
                </li>
            </ul>
        <?php else: ?>
            <div class="col-md-3 text-end">
                <a href="login.php"><span class="nav-link">Login</span></a>
                <a href="signup.php"><span class="nav-link">Sign-up</span></a>
            </div>
        <?php endif; ?>
    </header>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="logout.php" class="btn btn-primary">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <main>
        <div id="myCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/barber1.jpg" alt="Dokter Kompetibel">
                    <div class="carousel-caption">
                        <h1>Dokter Kompetibel</h1>
                        <p>Klinik dengan dokter yang memiliki pengalaman tinggi dan berpendidikan.</p>
                        <p><a class="btn btn-primary btn-lg" href="dokter/dokter.php">Read more</a></p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/barber2.webp" alt="Fasilitas Mewah">
                    <div class="carousel-caption">
                        <h1>Fasilitas Mewah</h1>
                        <p>Dilengkapi dengan kamar yang mewah serta fasilitas lengkap.</p>
                        <p><a class="btn btn-primary btn-lg" href="kamar/kamar.php">Learn more</a></p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>About Us</h3>
                    <p>Welcome to BarberBuy, where style and quality come together. Our skilled barbers are here to provide you with personalized haircuts, sharp beard trims, and an exceptional grooming experience. At BarberBuy, we blend classic techniques with modern trends in a comfortable, stylish space. Sit back, relax, and let us bring out the best in your look. Thank you for trusting us with your style!

                    </p>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <footer>
            <p>&copy; 2021-2024 From Abuy To Abuy. All rights reserved.</p>
        </footer>
    </main>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
</body>

</html>