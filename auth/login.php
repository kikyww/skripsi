<?php 
include '../koneksi.php';

if (isset($_POST['login'])) {
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    $query = "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password'";
    $result = $konek->query($query);

    if ($result->num_rows > 0) {
        $roles = $result->fetch_assoc();
        session_start();
        $_SESSION["id_user"] = true;
        $_SESSION["username"] = $username;
        $_SESSION["nama"] = $roles['nama'];
        $_SESSION["nip"] = $roles['nip'];
        $_SESSION["roles"] = $roles["roles"];

        if ($roles["roles"] == true) {
            header("location:../utilities/dashboard.php");
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
    <title>Login Page</title>
    <link rel="stylesheet" href="../assets/css/main/app.css">
    <link rel="stylesheet" href="../assets/css/pages/auth.css">
    <link rel="shortcut icon" href="../assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png" type="image/png">
</head>

<style>
    #auth-right{
        background-image: url(../assets/images/logo/dashboard.jpg);
        background-repeat: no-repeat;
    }
</style>


<body>
    <div id="auth">
        
<div class="row h-100">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <div class="auth-logo log">
                <h3><img src="../assets/images/logo/bkkbn.png" alt="Logo">DPPKBPM</h3>
            </div>
            <?php if(isset($error)){ ?>
            <div class="alert alert-danger">
                <i class="bi bi-file-excel"></i> Username atau Password Salah!
            </div>
            <?php } ?>
            <form method="POST">
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="username" name="username" class="form-control form-control-xl" placeholder="Username" autocomplete="off">
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" name="password" class="form-control form-control-xl" placeholder="Password" autocomplete="off">
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="login" type="submit">Log in</button>
            </form>
            <div class="text-center mt-5 text-lg fs-4">
                <p><a class="font-bold" href="./forgot.php">Lupa Pasword?</a>.</p>
            </div>
        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div class="d-flex justify-content-center align-items-center" id="auth-right">
            <img src="../assets/images/logo/pemko.png" height="300" alt="logo" />
        </div>
    </div>
</div>

    </div>
</body>

</html>
