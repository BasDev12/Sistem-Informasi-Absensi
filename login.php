<?php
    session_start();
    if (isset($_SESSION["login"])) {
        header("Location: index.php");
        exit;
    }
    require 'koneksi.php';

    if (isset($_POST["login"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $result = mysqli_query($koneksi, "SELECT * FROM dosen WHERE email ='$email'");

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row["password"])) {
                $_SESSION["login"] = true;
                $_SESSION['dosen_id'] = $row["id_dosen"];
                $_SESSION['dosen_user_email'] = $email;
                $_SESSION['dosen_user_name'] = $row["nama"];
                $_SESSION['dosen_user_foto'] = $row["foto"];
                $_SESSION['dosen_user_last_login'] = $row["last_login"];
                $_SESSION['role'] = $row["role"]; // Simpan role dalam session

                // Redirect berdasarkan role
                if ($row["role"] == "admin") {
                    header("Location: index.php");
                } elseif ($row["role"] == "user") {
                    header("Location: dosen/dosen_dashboard.php");
                } else {
                    header("Location: index.php");
                }
                exit;
            }
        }
        $error = true;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/style.css">
    <title>Login Admin</title>
    <script>
        function sendMessage() {
            let userMessage = document.getElementById("userMessage").value;
            let chatBox = document.getElementById("chatBox");
            if(userMessage.trim() !== "") {
                chatBox.innerHTML += "<p><strong>Anda:</strong> " + userMessage + "</p>";
                
                // Simulasi respon otomatis
                setTimeout(function() {
                    let botResponse = "<p><strong>Bot:</strong> Terima kasih atas pesan Anda!</p>";
                    chatBox.innerHTML += botResponse;
                }, 1000);
                
                document.getElementById("userMessage").value = "";
            }
        }

        function sendWhatsApp() {
            let userMessage = document.getElementById("userMessage").value;
            if(userMessage.trim() !== "") {
                let phoneNumber = "6285397828095"; // Ganti dengan nomor tujuan
                let whatsappURL = https://api.whatsapp.com/send?phone=${phoneNumber}&text=${encodeURIComponent(userMessage)};
                window.open(whatsappURL, '_blank');
            }
        }
    </script>
</head>
<body class="login">
    <div class="container">
        <div class="row justify-content-center form-login mt-5">
            <div class="col-md-6">
                <form action="" class="panel" method="post">
                    <div class="text-center mb-4">
                        <img src="logo.png" alt="Logo" width="150">
                    </div>
                    <h3 class="mb-4 text-center text-uppercase">Login </h3>
                    <?php if( isset($error) ) :?>
                    <div class="alert alert-danger mr-5 ml-5 radius" role="alert">
                    Email / Password salah
                    </div>
                    <?php endif; ?>
                    <div class="form-group ml-5 mr-5">
                        <input type="text" name="email" id="email" class="form-control form-control-lg radius" placeholder="Email">
                    </div>
                    <div class="form-group ml-5 mr-5">
                        <input type="password" name="password" id="password" class="form-control form-control-lg radius" placeholder="Password">
                    </div>
                    <div class="form-group mt-4 ml-5 mr-5">
                        <button type="submit" class="btn btn-info btn-login block radius" name="login">Login</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <h3 class="text-center">Chatbox</h3>
                <div id="chatBox" class="border p-3" style="height: 200px; overflow-y: auto;"></div>
                <div class="form-group mt-3">
                    <input type="text" id="userMessage" class="form-control" placeholder="Ketik pesan...">
                </div>
                <button onclick="sendMessage()" class="btn btn-primary">Kirim</button>
                <button onclick="sendWhatsApp()" class="btn btn-success">Kirim ke WhatsApp</button>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.min.js" ></script>
</body>
</html>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/style.css">
    <title>Login Admin</title>
    <script>
        function sendMessage() {
            let userMessage = document.getElementById("userMessage").value;
            let chatBox = document.getElementById("chatBox");
            if(userMessage.trim() !== "") {
                chatBox.innerHTML += "<p><strong>Anda:</strong> " + userMessage + "</p>";
                
                // Simulasi respon otomatis
                setTimeout(function() {
                    let botResponse = "<p><strong>Bot:</strong> Terima kasih atas pesan Anda!</p>";
                    chatBox.innerHTML += botResponse;
                }, 1000);
                
                document.getElementById("userMessage").value = "";
            }
        }

        function sendWhatsApp() {
            let userMessage = document.getElementById("userMessage").value;
            if(userMessage.trim() !== "") {
                let phoneNumber = "6285397828095"; // Ganti dengan nomor tujuan
                let whatsappURL = https://api.whatsapp.com/send?phone=${phoneNumber}&text=${encodeURIComponent(userMessage)};
                window.open(whatsappURL, '_blank');
            }
        }
    </script>
</head>

    </div>

    <script src="js/bootstrap.min.js" ></script>
</body>
</html>