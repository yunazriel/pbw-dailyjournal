<?php
    session_start();
    include "connect.php";

    $error = "";

    if (isset($_SESSION['username'])) { 
        header("location:admin.php"); 
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? "";
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT username FROM user WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $hasil = $stmt->get_result();
    $row = $hasil->fetch_array(MYSQLI_ASSOC);

    if (!empty($row)) {
        $_SESSION['username'] = $row['username'];
        header("location:admin.php");
    } else {
        $error = "Username atau password salah!";
    }

    $stmt->close();
    $conn->close();
    } 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <title>Document</title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Martian+Mono:wght@100..800&family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap');
            * {
                padding: 0;
                margin: 0;
                font-family: "Source Sans 3";
            }
            .container-auth {
                background-color: #fff;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .card-auth {
                width: 55vh;
                padding: 20px;
                border-radius: 20px;
                background-color: rgb(246, 246, 246);
                
            }
            .title-card {
                text-align: center;
            }
            .register-link {
                margin-top: 15px;
                font-size: 14px;
                color: #555555;
                text-align: center;
            }

            .register-link a {
                color: #4caf50;
                text-decoration: none;
            }

            .register-link a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="container-auth">
            <div class="card-auth">
                <div class="title-card">
                    <h1>Login</h1>
                    <p>Please login to access your home page</p>
                    <?php if (!empty($error)) { ?>
                        <div class="container">
                            <p class="text-danger fst-italic"><?= htmlspecialchars($error) ?></p>
                        </div>
                    <?php } ?>
                </div>
                <form method="post">
                    <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="text" class="form-control" name="username">
                    </div>
                    <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                    </div>
                    <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                    <p class="register-link"> Don't have an account? <a href="">Register here</a></p>
                </form>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>