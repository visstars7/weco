<?php 

include_once '../helper/helper.php';

$pesan = isset($_GET['pesan']) ? $_GET['pesan'] : false;
$nama_dpn = isset($_GET['nama_depan']) ? $_GET['nama_depan'] :false;
$nama_blg = isset($_GET['nama_belakang']) ? $_GET['nama_belakang'] :false;
$phone = isset($_GET['phone']) ? $_GET['phone'] :false;
$email = isset($_GET['email']) ? $_GET['email'] :false;
$alamat = isset($_GET['alamat']) ? $_GET['alamat'] :false;

// error case
switch ($pesan) {
    case '4':
        echo "<script>alert('Database tidak terkoneksi')</script>";
        break;
    
    case '1':
        echo "<script>alert('Email sudah digunkan')</script>";
        break;
    case '2':
        echo "<script>alert('Password tidak sama')</script>";
        break;
    case '3':
        echo "<script>alert('Gagal memasukkan data')</script>";
        break;
}

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
    <link rel="stylesheet" href="../../resource/css/register.css">
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

                <h3 class="ubuntu" ><span>We.</span>Co Register</h3>

            </div>

            <form action="register_controller.php" method="post">
                
                <div class="element-form">

                    <input class="input-form" type='text' name='nama_depan' id='nama_depan' placeholder='Masukan nama depan disini' value="<?=$nama_dpn?>" required>

                </div>

                <div class="element-form">

                    <input class="input-form" type='text' name='nama_belakang' id='nama_belakang' placeholder='Masukan nama belakang disini' value="<?=$nama_blg?>" required>

                </div>

                <div class="element-form">

                    <input class="input-form" type='number' name='phone' id='phone' placeholder='Masukan nomor telepon disini' value="<?=$phone?>" required>

                </div>
                
                <div class="element-form">

                    <input class="input-form" type='email' name='email' id='email' placeholder='Masukan nama email disini' value="<?=$email?>" required>

                </div>

                <div class="element-form">

                    <textarea class="input-form" name="alamat" id="alamat" placeholder="Masukan alamat disini"><?= $alamat ?></textarea required>

                </div>

                <div class="element-form">

                    <input class="input-form" type='password' name='password' id='password' placeholder='Masukan password disini' required>

                </div>

                <div class="element-form">

                    <input class="input-form" type='password' name='password2' id='password2' placeholder='Masukan kembali password disini' required>

                </div>

                <div class="row justify-content-center">

                    <div class="element-form">
                        <a href="../?page=home" class="btn btn-secondary ubuntu" >Kembali</a>
                    </div>

                    <div class="element-form">
                        <button onclick="return alert('yakin submit?')" name="submit" class="btn btn-secondary button-submit btn-md ubuntu" >Sumbit</button>
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