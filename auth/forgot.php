<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mazer Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/main/app.css">
    <link rel="stylesheet" href="../assets/css/pages/auth.css">
    <link rel="shortcut icon" href="../assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png" type="image/png">
</head>

<body>
<div id="auth">
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <h1 class="auth-title">Lupa Password</h1>
                <p class="auth-subtitle mb-3">Masukkan Username atau NIP anda.</p>

                <div class="form-group position-relative has-icon-left mb-2">
                    <input type="text" id="username" class="form-control form-control-xl" placeholder="Username atau NIP">
                    <div class="form-control-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                </div>
                <button id="send" class="btn btn-primary btn-block btn-lg shadow-lg mt-3">Send</button>

                <div class="text-center mt-5 text-lg fs-4">
                    <p class='text-gray-600'>Sudah ingat dengan akun anda? <a href="./login.php" class="font-bold">Log in</a>.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('#send').click(function() {
        let username = $('#username').val();

        if (username !== '') {
            const nomorAdmin = '6285787121453'; 
            const pesan = 'Permintaan lupa password :\nUsername / NIP: ' + username; 

            let url = 'https://api.whatsapp.com/send?phone=' + nomorAdmin + '&text=' + encodeURIComponent(pesan);
            window.open(url);
        } else {
            alert('Mohon masukkan username atau NIP');
        }
    });
});
</script>

</body>

</html>
