<!DOCTYPE html>
<html>

<head>
    <title>Login - PT. Damai Indah Golf</title>
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/LogoDamaiIndahGolf.png" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/login/'); ?>css/style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/notiflix/'); ?>src/notiflix.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <!-- jQuery -->
    <script src="<?= base_url('assets/users-template/'); ?>js/jquery-2.1.0.min.js"></script>
    <script src="<?= base_url('assets/login/'); ?>js/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
        // Root Base
        var rootWebService = '<?= base_url(); ?>';
    </script>
</head>

<body>
    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->
    <img class="wave" src="<?= base_url('assets/login/'); ?>img/wave.png">
    <div class="container">
        <div class="img">
            <img src="<?= base_url('assets/login/'); ?>img/bg.svg">
        </div>
        <div class="login-content" id="login-page">
            <form action="" method="post" id="login-form">
                <img src="<?= base_url('assets/login/'); ?>img/avatar.svg">
                <h2 class="title">Welcome</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Username</h5>
                        <input type="text" name="username" class="input">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" name="password" class="input">
                    </div>
                </div>
                <a href="<?= base_url('ForgotPassword/'); ?>">Forgot Password?</a>
                <input type="submit" class="btn" value="Login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="<?= base_url('assets/login/'); ?>js/main.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/notiflix/'); ?>src/notiflix.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/ajax/'); ?>login.min.js"></script>
</body>

</html>