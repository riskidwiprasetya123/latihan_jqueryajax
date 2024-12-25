<?php
include "koneksi.php"; 
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Website</title>
  <link rel="icon" href="img/logo.jpg">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<!-- nav begin -->
<nav class="navbar navbar-expand-lg bg-primary-subtle sticky-top">
  <div class="container">
    <a class="navbar-brand" href="#">KHW NADIA OMARA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
        <li class="nav-item">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#article">Article</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#gallery">Gallery</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#schedule">Schedule</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about">About Me</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php" target="_blank">Login</a>
        </li>
        <button id="themetoggle" class="btn btn-light">
          <i class="bi bi-moon-stars-fill"></i>
        </button>
      </ul>
    </div>
  </div>
</nav>
<!-- nav end -->

<!-- hero begin -->
<section id="hero" class="text-center p-5 bg-primary-subtle text-sm-start">
  <div class="container">
      <div class="d-sm-flex flex-sm-row-reverse align-items-center">
          <img src="https://upload.wikimedia.org/wikipedia/commons/3/34/Nadia_Omara_Photoss.jpg" class=“img-fluid” width=“200”>
          <div>
              <h1 class="fw-bold display-4">Kumpulan Cerita Horor Wawak</h1>
              <h4 class="lead display-6">Berisi banyak kisah horor dari wawak yang menarik dan penuh plot twist</h4>
              <h6>
                <span id="tanggal"></span>
                <span id="jam"></span>
              </h6>
          </div>
      </div>
  </div>
</section>
<!-- hero end -->

<!-- article begin -->
<section id="article" class="text-center p-5">
  <div class="container">
    <h1 class="fw-bold display-4 pb-3">article</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
      <?php
      $sql = "SELECT * FROM article ORDER BY tanggal DESC";
      $hasil = $conn->query($sql); 

      while($row = $hasil->fetch_assoc()){
      ?>
        <div class="col">
          <div class="card h-100">
            <img src="img/<?= $row["gambar"]?>" class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title"><?= $row["judul"]?></h5>
              <p class="card-text">
                <?= $row["isi"]?>
              </p>
            </div>
            <div class="card-footer">
              <small class="text-body-secondary">
                <?= $row["tanggal"]?>
              </small>
            </div>
          </div>
        </div>
        <?php
      }
      ?> 
    </div>
  </div>
</section>
<!-- article end -->
 
<!-- gallery begin -->
<section id="gallery" class="text-center p-5 bg-primary-subtle">
  <div class="container">
      <h1 class="fw-bold display-4 pb-3">Gallery</h1>
      <div id="carouselExample" class="carousel slide">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="https://i.ytimg.com/vi/uMXdeSnaElQ/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLCyyBoWv9E1f41URxZoXgnWGZjxaQ" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="https://i.ytimg.com/vi/U3Xfkiu9a_Q/maxresdefault.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="https://i.ytimg.com/vi/h6Ao95wygg8/maxresdefault.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="https://i.ytimg.com/vi/HQWPBr4nvJE/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLCC7McZTauCKtnljcNNhlx1dR-WoQ" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="https://i.ytimg.com/vi/DDaxqlJqNYE/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLACP2C3eMncy4GID1DtS7bd1nBPGg" class="d-block w-100" alt="...">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
  </div>
</section>
<!-- gallery end -->

<!-- schedule begin -->
    <section id="schedule" class="text-center p-5">
      <div class="container">
        <h1 class="fw-bold display-4 pb-3">Schedule</h1>
        <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center">
          <div class="col">
            <div class="card h-100">
              <div class="card-header bg-danger text-white">SENIN</div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  Etika Profesi<br />16.20-18.00 | H.4.4
                </li>
                <li class="list-group-item">
                  Sistem Operasi<br />18.30-21.00 | H.4.8
                </li>
              </ul>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <div class="card-header bg-danger text-white">SELASA</div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  Pendidikan Kewarganegaraan<br />12.30-13.10 | Kulino
                </li>
                <li class="list-group-item">
                  Probabilitas dan Statistik<br />15.30-18.00 | H.4.9
                </li>
                <li class="list-group-item">
                  Kecerdasan Buatan<br />18.30-21.00 | H.4.11
                </li>
              </ul>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <div class="card-header bg-danger text-white">RABU</div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  Manajemen Proyek Teknologi Informasi<br />15.30-18.00 | H.4.6
                </li>
              </ul>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <div class="card-header bg-danger text-white">KAMIS</div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  Bahasa Indonesia<br />12.30-14.10 | Kulino
                </li>
                <li class="list-group-item">
                  Pendidikan Agama Islam<br />16.20-18.00 | Kulino
                </li>
                <li class="list-group-item">
                  Penambangan Data<br />18.30-21.00 | H.4.9
                </li>
              </ul>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <div class="card-header bg-danger text-white">JUMAT</div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  Pemrograman Web Lanjut<br />10.20-12.00 | D.2.K
                </li>
              </ul>
            </div>
          </div>
          <div class="col">
            <div class="card h-100">
              <div class="card-header bg-danger text-white">SABTU</div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">FREE</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
<!-- schedule end -->

<!-- about me begin -->
<section id="aboutme" class="text-center p-5 bg-primary-subtle">
  <div class="container">
    <div class="d-sm-flex align-items-center justify-content-center">
      <div class="p-3">
        <img
          src="https://i.pinimg.com/736x/9a/f9/b1/9af9b10e5f09ff41769d32eacf0a7de5.jpg"
          class="rounded-circle border shadow"
          width="300"
        />
      </div>
      <div class="p-md-5 text-sm-start">
        <h3 class="lead">A11.2023.15334</h3>
        <h1 class="fw-bold">Riski Dwi Prasetya</h1>
        Program Studi Teknik Informatika<br />
        <a href="https://dinus.ac.id/" class="fw-bold text-decoration-none"
          >Universitas Dian Nuswantoro</a
        >
      </div>
    </div>
  </div>
</section>
<!-- about me end -->

<!-- footer begin -->
<footer class="text-center p-5">
  <div>
      <a href="https://www.instagram.com/nadiaomara/"><i class="bi bi-instagram h2 p-2 text-dark"></i></a>
      <a href="https://x.com/nadiaomaraa"><i class="bi bi-twitter-x h2 p-2 text-dark"></i></a>
      <a href="https://youtube.com/@nadiaomaraa?si=xi5OxfIL8VPrGPJe"><i class="bi bi-youtube h2 p-2 text-dark"></i></a>
  </div>
  <div>
      <strong>Riski Dwi Prasetya & Copy; 2024</strong>
  </div>
</footer>
<!-- footer end -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script type="text/javascript">
  window.setTimeout("tampilWaktu()", 1000);
  function tampilWaktu() {
    var waktu = new Date();
    var bulan = waktu.getMonth() + 1;
    setTimeout("tampilWaktu()", 1000);
    document.getElementById("tanggal").innerHTML =
      waktu.getDate() + "/" + bulan + "/" + waktu.getFullYear();
    document.getElementById("jam").innerHTML =
      waktu.getHours() + ":" + waktu.getMinutes() + ":" + waktu.getSeconds();
  }

  document.getElementById("themetoggle").addEventListener("click",function () {
        var currenTheme = document.documentElement.getAttribute("data-bs-theme");
        var newTheme = currenTheme === "light" ? "dark" : "light";
        document.documentElement.setAttribute("data-bs-theme", newTheme);
        this.innerHTML = newTheme === "light" ? '<i class="bi bi-moon-stars-fill"></i>' : '<i class="bi bi-brightness-high-fill"></i>';
      });
</script>
</body>
</html>