<?php
session_start();
include "connect.php";  

if (!isset($_SESSION['username'])) {
    header("location:login.php"); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/png" href="https://static.vecteezy.com/system/resources/previews/019/194/935/non_2x/global-admin-icon-color-outline-vector.jpg">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }
        body {
            background-color: #eaf5fb;
            transition: background-color 0.4s, color 0.4s
        }
        ::-webkit-scrollbar {
            display: none;
        }
        #content {
          margin-top: 100px
        }
        .custom-navbar {
            border-bottom: 1px solid black;
            background-color: rgba(255, 255, 255, 30%);
            backdrop-filter: blur(10px); 
            -webkit-backdrop-filter: blur(10px);
        }
        .brand-title {
            font-size: 1.8rem;
            font-weight: 600;
        }
        .fs-navbar {
            font-size: 18px;
            font-weight: 600;
        }
        .user-photo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        .nav-item.dropdown {
            margin-right: 100px;
            /* position: relative; */
        }
    </style>
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
          <ul class="navbar-nav ml-auto align-items-center">
            <li class="nav-item mr-3 fs-navbar">
              <a class="nav-link" href="admin.php?page=dashboard"
                ><i class="bi bi-houses-fill mr-1"></i>Dashboard</a>
            </li>
            <li class="nav-item mr-2 fs-navbar">
              <a class="nav-link" href="admin.php?page=article"
                ><i class="bi bi-newspaper mr-1"></i>Article</a
              >
            </li>
            <li class="nav-item mr-2 fs-navbar">
              <a class="nav-link" href="admin.php?page=gallery"
                ><i class="bi bi-camera mr-1"></i>Gallery</a
              >
            </li>
            <li class="nav-itemdropdown">
                <a class="nav-link fw-bold d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://i.pinimg.com/736x/be/b5/eb/beb5eb6ff44309338ca9db4540ca4dc8.jpg" alt="User Photo" class="user-photo me-2">
                    @<?= $_SESSION['username']?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end mr-4">
                    <li><a class="dropdown-item" href="#">Pengaturan</a></li>
                    <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                </ul>
            </li>
          </ul>
        </div>
      </nav>

      <section id="content" class="container-fluid">
        <div class="p-2 container-fluid"">
            <?php if (isset($_GET['page'])): ?>
                <h4 class="lead display-6 pb-2 border-bottom border-danger-subtle">
                    <?= ucfirst($_GET['page']) ?>
                </h4>
                <?php include($_GET['page'] . ".php"); ?>
            <?php else: ?>
                <h4 class="lead display-6 pb-2 border-bottom border-danger-subtle">Dashboard</h4>
                <?php include("dashboard.php"); ?>
            <?php endif; ?>
        </div>
      </section>
      
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy;2024 Daily Jurnals. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>