<!DOCTYPE html>
<html>

<head>
    <title>Reset Password - PT. Damai Indah Golf</title>
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
        var codeReset = '<?= $code ?>';
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
        <div class="login-content" id="reset-page">
            <form action="" method="post" id="reset-form">
                <img src="<?= base_url('assets/login/'); ?>img/avatar.svg">
                <h2 class="title">Reset Password</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>New Password</h5>
                        <input type="password" name="password1" class="input">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Replay Password</h5>
                        <input type="password" name="password2" class="input">
                    </div>
                </div>
                <a href="<?= base_url('Login/'); ?>">Login Page</a>
                <input type="submit" class="btn" value="Reset">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="<?= base_url('assets/login/'); ?>js/main.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/notiflix/'); ?>src/notiflix.js"></script>
    <script type="text/javascript" src="<?= base_url('assets/ajax/'); ?>code_reset.min.js"></script>
</body>

</html>