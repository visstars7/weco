
<?php 

include_once '../helper/helper.php';
$pesan = isset($_GET['pesan']) ? "<script>alert('maaf, data user ditemukan')</script>" : "";

echo $pesan;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login || WeCo</title>

    <!-- bootstrap 4 -->
    <link rel="stylesheet" href="../../resource/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="../../resource/css/login.css">
    <!-- favicon -->
    <link rel="shortcut icon" href="../../resource/img/Weco.png" type="image/x-icon">

</head>
<body>


    <div class="header-top">

        <img id="image-wave-top" src="../../resource/img/wave 1.svg" alt="wave.png">

    </div>

    <section id="frame-login">

        <div class="login-form">

            <div class="header-form">

                <h3 class="ubuntu" ><span>We.</span>Co Login</h3>

            </div>

            <form action="login_controller.php" method="post">

                <div class="element-form">

                    <input class="input-form" type='email' name='email' id='email' placeholder='Masukan email disini' required>

                </div>

                <div class="element-form">

                    <input class="input-form" type='password' name='password' id='password' placeholder='Masukan password disini' required>

                </div>

                <div class="row justify-content-center">

                    <div class="element-form">
                        <a href="../?page=home" class="btn btn-secondary button-submit ubuntu">Kembali</a>
                    </div>

                    <div class="element-form">
                        <button name="submit" class="button-submit ubuntu">Sumbit</button>
                    </div>

                    <div class="element-form">
                        <a href="../register/register.php" class=" btn btn-secondary button-submit ubuntu" >Register</a>
                    </div>

                </div>

            </form>

        </div>

    </section>

<script src="../../resource/jquery-3.4.1.min.js" ></script>
<script src="../../resource/popper/popper.min.js" ></script>
<script src="../../resource/bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>

</body>
</html>