<?php 

include_once '../helper/helper.php';

baseURL();

// siapkan session
session_start();

// cek apakah user sudah login
if(!isset($_SESSION['user'])){
    Header("Location:login/login.php");
}

// ambil data user_id dalam session
$user_id = $_SESSION['user'];

// lanjutkan query data user_id
$query = mysqli_query(conn(),"SELECT level FROM tbuser WHERE user_id = $user_id");
$level  = mysqli_fetch_assoc($query);

// jika level  === admin maka redirect ke halaman admin
if($level['level'] !== "superadmin"){
    Header('Location:../index.php?page=home&pesan=1');
}


$page = isset($_GET['page']) ? $_GET['page'] : false;

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeCo | Admin Page</title>
    <!-- bootstrap 4 -->
    <link rel="stylesheet" href="../../resource/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="../../resource/css/admin.css">
    <!-- favicon -->
    <link rel="shortcut icon" href="../../resource/img/Weco.png" type="image/x-icon">

</head>
<body>

<div id="header-atas" class="row">

    <div id="image-frame" class="col-md-2 col-sm-6 col-xs-6">
        <a href="../?page=home">
            <img src="<?=BASE_URL?>/resource/img/output-onlinepngtools.png" alt="kopi.png">
        </a>

    </div>

    


    <div class="col-md-10 col-sm-6 col-xs-6" id="white-space-frame">

        <p class="noto-sans"><span>Admin: </span><a class="superadmin-name" href="#"><?= $_SESSION['nama']; ?></a></p>

        <div id="header-title">

            <?php if(isset($_GET['page'])): ?>

                <h3 class="text-center noto-sans-font mt-4 text-brown">Halaman <?= $_GET['page']; ?></h3>
            <?php endif; ?>

        </div>

    </div>

</div>

<div class="row" id="main">

    <div id="sidebar-list-frame" class="col-md-2">

        <ul class="frame-list-sidebar">
        
            <li class="list-sidebar"><a class="noto-sans" href="index.php?page=dashboard">Dashboard</a></li>
            <li class="list-sidebar"><a class="noto-sans" href="index.php?page=produk">Produk Menu</a></li>
            <li class="list-sidebar"><a class="noto-sans" href="index.php?page=user">User Menu</a></li>
            <li class="list-sidebar"><a class="noto-sans" href="index.php?page=kategori">Kategori</a></li>
            <li class="list-sidebar"><a class="noto-sans" href="index.php?page=feedback">User Feedback</a></li>
        
        </ul>

    </div>

    <div class="col-md-10" id="content-frame">

        <?php 
        
            $file_name = "modul/$page/$page.php";

            if(file_exists($file_name)){
                include_once "$file_name";
            }else{
                echo "<div id='error_file'>File tidak ditemukan</div>";
            }
        
        ?>
    
    </div>

</div>



<script src="../../resource/jquery-3.4.1.min.js" ></script>
<script src="../../resource/popper/popper.min.js" ></script>
<script src="../../resource/bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
</body>
</html>



