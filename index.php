<?php
  include "connect.php"; 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daily Jurnals Bootstrap</title>
    <link rel="icon" type="image/png" href="https://th.bing.com/th/id/OIP.f48FRGm0mBmqCKrEz8dmxAHaHa?pid=ImgDet&w=195&h=195&c=7&dpr=1,4">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"rel="stylesheet"/>
    <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light custom-navbar py-3 px-5 fixed-top">
      <a class="navbar-brand text-capitalize fw-bold brand-title" href="#">daily jurnals</a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mr-4 fs-navbar">
            <a class="nav-link" href="#home"
              ><i class="bi-houses-fill mr-1"></i>Home</a>
          </li>
          <li class="nav-item mr-4 fs-navbar">
            <a class="nav-link" href="#article"
              ><i class="bi bi-newspaper mr-1"></i>Article</a
            >
          </li>
          <li class="nav-item mr-4 fs-navbar">
            <a class="nav-link" href="#gallery"
              ><i class="bi bi-camera-fill mr-1"></i>Gallery</a
            >
          <li class="nav-item mr-4 fs-navbar">
            <a class="nav-link" href="login.php"
              ><i class="bi bi-person-workspace mr-1"></i>Login</a
            >
          </li>
          <li class="nav-item align-items-center d-flex gap-1">
            <button class="px-3 py-1 border-0 rounded-2 bg-warning" id="btn-normalMode">
              <i class="bi bi-brightness-high-fill"></i>
            </button>
            <button class="px-3 py-1 border-0 rounded-2 bg-dark-subtle" id="btn-darkmode">
              <i class="bi bi-moon-stars-fill"></i>
            </button>
          </li>
        </ul>
      </div>
    </nav>

    <div class="vh-100 flex-column" id="home">
      <div id="homeCarousel" class="carousel slide vh-100" data-bs-ride="carousel">
        <div class="carousel-inner vh-100 bg-white">
          <div class="carousel-item active">
            <img src="https://img-baofun.zhhainiao.com/pcwallpaper_ugc/static/edf87995826affb1a5b5282b452e28f4.jpg?x-oss-process=image%2fresize%2cm_lfit%2cw_960%2ch_540" class="d-block w-100 vh-100" alt="Slide 1"/>
            <div class="carousel-caption d-none d-md-block">
              <h1>Selamat Datang di Daily Jurnal</h1>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="https://images.hdqwalls.com/wallpapers/mount-batur-ad.jpg" class="d-block w-100 vh-100"alt="Slide 2"/>
            <div class="carousel-caption d-none d-md-block">
              <h1>Website daily jurnals</h1>
              <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="https://sncdn.com/imagecache/db/id/2033310/go542722.jpg" class="d-block w-100 vh-100" alt="Slide 3"/>
            <div class="carousel-caption d-none d-md-block">
              <h1>Website yang menggunkan bootstrap</h1>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, ea!</p>
            </div>
          </div>
        </div>
        <button
          class="carousel-control-prev"
          type="button"
          data-bs-target="#homeCarousel"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button
          class="carousel-control-next"
          type="button"
          data-bs-target="#homeCarousel"
          data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    
    <div class="container-fluid p-4" id="article">
      <h3 class="text-capitalize fw-bold pt-5 mt-4 text-center title-custom">my article</h3>
        <div class="row row-cols-1 row-cols-md-4 px-2 py-3 g-4 justify-content-center">
          <?php 
            $sql = "SELECT * FROM article ORDER BY tanggal DESC";
            $result = $conn->query($sql);

            $no = 1;
            while($row = $result->fetch_assoc()){
          ?>
            <div class="col">
                <div class="card card-custom">
                    <img src="img/article/<?= !empty($row["gambar"]) && file_exists('img/article/' . $row["gambar"]) ? htmlspecialchars($row["gambar"]) : 'default.jpg' ?>" class="card-img-top img-card" alt="img Artikel">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-capitalize"><?= $row["judul"] ?></h5>
                        <p class="card-text"><?= $row["isi"] ?></p>
                        <div class="d-flex justify-content-between mt-5 border border-end-0 border-start-0 border-top-0 border-black py-2">
                          <small class="text-muted"><i class="bi bi-person-fill"></i> <?= $row["username"] ?></small>
                          <small class="text-muted"><i class="bi bi-calendar2"></i> <?= date("d M Y", strtotime($row["tanggal"])) ?></small>
                        </div>
                        <a href="#" class="btn btn-primary mt-2">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
          <?php } ?>
        </div>
    </div>

    <div class="container-fluid py-5 px-5" id="gallery">
      <h3 class="text-capitalize fw-bold pt-4 mt-4 text-center title-custom">Gallery</h3>
      <div class="row row-cols-1 row-cols-md-3 g-2 justify-content-center">
        <?php 
            $sql = "SELECT * FROM gallery ORDER BY created_at DESC";
            $result = $conn->query($sql);

            $no = 1;
            while($row = $result->fetch_assoc()){
        ?>
        <div class="col">
          <div class="card h-100 gallery-custom">
            <img src="img/gallery/<?= !empty($row["gambar"]) && file_exists('img/gallery/' . $row["gambar"]) ? htmlspecialchars($row["gambar"]) : 'default.jpg' ?>" class="card-img-top gallery-img-custom" alt="Image 1">
            <div class="overlay bg-dark bg-opacity-50 text-white">
                <h5 class="gallery-title text-capitalize fw-bold mb-2"><?= htmlspecialchars($row["judul"]) ?></h5>
                <div class="d-flex justify-content-between align-items-center">
                  <small class="created-by text-light">By: @<?= htmlspecialchars($row["created_by"]) ?></small>
                  <small class="created-at text-light"><i class="bi bi-calendar2 mr-1"></i><?= date("d M Y", strtotime($row["created_at"])) ?></small>
                </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>

    <footer class="bg-dark text-white text-center py-3">
      <p>&copy;2024 Daily Jurnals. All rights reserved.</p>
    </footer>


    <script type="text/javascript">
      const body = document.body

      document.getElementById('btn-darkmode').onclick = () => {
        body.classList.add('dark-mode')
        
        const navLinks = document.querySelectorAll('.nav-link')
        navLinks.forEach(link => link.classList.add('text-white'))
      }

      document.getElementById('btn-normalMode').onclick = () => {
        body.classList.remove('dark-mode')

        const navLinks = document.querySelectorAll('.nav-link')
        navLinks.forEach(link => link.classList.remove('text-white'))
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
